<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Session;

class ToolsController extends Controller
{
    public function add_tool_get(Request $request)
    {
        if (Auth::check()) {
            return view('tools.add_tool', [
                'tool' => null,
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => ['Login to add a new tool']]);
        }
    }
    public function add_tool_post(Request $request)
    {
        if (Auth::check()) {
            if ($request->get('id')) {
                $tool = Tools::where('id', $request->get('id'))->first();
                $tool->tool_id = $request->get('tool_id');
                $tool->tool_name = $request->get('tool_name');
                $tool->machine = $request->get('machine');
                $tool->location = $request->get('location');
                $tool->specification = $request->get('specification');
                $tool->last_inspection_date = $request->get('last_inspection_date');
                $tool->inspection_due_date = $request->get('inspection_due_date');
                $tool->save();
            } else {
                $tool = new Tools;
                $tool->tool_id = $request->get('tool_id');
                $tool->tool_name = $request->get('tool_name');
                $tool->machine = $request->get('machine');
                $tool->location = $request->get('location');
                $tool->specification = $request->get('specification');
                $tool->last_inspection_date = $request->get('last_inspection_date');
                $tool->inspection_due_date = $request->get('inspection_due_date');
                $tool->save();
            }

            $tools = Tools::where('tool_id', $request->get('tool_id'))->first();
            $medias = $request->media;
            if ($medias) {
                foreach ($medias as $key => $file) {
                    $check_extension = $file->extension();
                    $check_image = array('jpeg', 'png', 'jpg');
                    $check_video = array('mp4', 'avi', 'mkv');

                    // return $file->extension();
                    if (in_array($check_extension, $check_image)) {
                        $imageName = time() . rand(1, 999) . '.' . $file->extension();
                        $file->move(public_path('storage/uploads'), $imageName);
                        $path = public_path('storage/uploads');
                        $manager = new ImageManager();
                        $thumb_path = public_path('storage/uploads/thumbnail');
                        $thumb_name = 'thumbnail_' . $imageName;
                        $imageMin = $manager->make(public_path('storage/uploads') . '/' . $imageName)->resize(400, 400)->save($thumb_path . '/' . $thumb_name);
                        $file_name = "/storage/uploads/" . $imageName;
                        $thumb_file_name = "/storage/uploads/thumbnail/" . 'thumbnail_' . $imageName;

                        $save_image = new Media;
                        $save_image->tool_id = $tools->id;
                        $save_image->created_by = Auth::id();
                        $save_image->media_type = 'image';
                        $save_image->name = $imageName;
                        $save_image->path = $file_name;
                        $save_image->thumbnail_name = 'thumbnail_' . $imageName;
                        $save_image->thumbnail_path = $thumb_file_name;
                        $save_image->for_status = "detail";
                        $save_image->save();
                    }

                    if (in_array($check_extension, $check_video)) {

                        $videoName = time() . rand(1, 999) . '.' . $file->extension();
                        $file->move(public_path('storage/uploaded_video'), $videoName);
                        $path = public_path('storage/uploaded_video');
                        $file_name = "/storage/uploaded_video/" . $videoName;

                        $save_video = new Media;
                        $save_video->tool_id = $tools->id;
                        $save_video->created_by = Auth::id();
                        $save_video->media_type = 'video';
                        $save_video->name = $videoName;
                        $save_video->path = $file_name;
                        $save_video->for_status = "detail";
                        $save_video->save();
                    }
                }
            }
            if ($request->get('id')) {
                return redirect('/tool/' . $tools->id)->with('message', 'Tool details updated successfully');
            } else {
                return redirect('/tool/' . $tools->id)->with('message', 'Tool details added successfully');
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['Login to add a tool details']]);
        }
    }
    public function tool_details($id)
    {
        $tool_detail = Tools::where('id', $id)
            ->with(['medias'])
            ->first();
        if ($tool_detail) {
            return view('tools.details', [
                'tool_detail' => $tool_detail
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => ['Tool detail not found']]);
        }
    }
    public function tool_dashboard(Request $request)
    {
        if (Auth::check()) {
            $search = $request->get('search');
            if ($search) {
                $department = 'all';
            }
            if ($request->input('rows_per_page')) {
                $per_page = $request->input('rows_per_page');
                if ($per_page != Session::get('rows_per_page')) {
                    $request['page'] = "1";
                }
            } else {
                $per_page = 10;
            }
            $tools_count = Tools::all()->count();
            $tools = Tools::with('medias')
                ->when($search, function ($query) use ($search) {
                    $query->where('machine_id', 'like', '%' . strtolower($search) . '%')
                        ->orWhere('machine_name', 'like', '%' . strtolower($search) . '%')
                        ->orWhere('machine_type', 'like', '%' . strtolower($search) . '%')
                        ->orWhere('department', 'like', '%' . strtolower($search) . '%')
                        ->orWhere('description', 'like', '%' . strtolower($search) . '%');
                    // ->orWhere('', 'like', '%'.strtolower($search).'%');
                })
                ->orderBy('updated_at', 'DESC')
                ->paginate($per_page);
            if ($request) {
                Session::put('filters', $request->all());
            }
            Session::put('rows_per_page', $per_page);
            return view('tools.dashboard', [
                'tools' => $tools,
                'tools_count' => $tools_count,
                'per_page' => $per_page,
                'search' => $search,
                'filters' => $request->all(),
            ]);
        } else {
            return redirect('/login')->withErrors(['error' => ['Login to access tools dashboard']]);
        }
    }
    public function update_tool_get($id)
    {
        if (Auth::check()) {
            $tool = Tools::where('id', $id)->first();
            if ($tool) {
                return view('tools.add_tool', [
                    'tool' => $tool
                ]);
            } else {
                return redirect('/add_tool');
            }
        } else {
            return redirect()->back()->withErrors(['eror' => ["You don't have the access to edit the details."]]);
        }
    }
}