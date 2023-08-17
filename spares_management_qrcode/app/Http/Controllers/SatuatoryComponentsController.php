<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Satuatory_Components;
use App\Models\Spares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Session;

class SatuatoryComponentsController extends Controller
{
    public function add_satuatory_get(Request $request)
    {
        if (Auth::check()) {
            return view('satuatory_components.add_satuatory', [
                'satuatory' => null
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => ['Login to add a new Satuatory Components']]);
        }
    }
    public function add_satuatory_post(Request $request)
    {
        if (Auth::check()) {
            if ($request->get('id')) {
                $satuatory = Satuatory_Components::where('id', $request->get('id'))->first();
                $satuatory->product_id = $request->get('product_id');
                $satuatory->product_name = $request->get('product_name');
                $satuatory->type = $request->get('type');
                if ($request->get('certification_status')) {
                    $satuatory->certification_status = true;
                } else {
                    $satuatory->certification_status = false;
                }
                if ($request->get('last_calibration_date')) {
                    $satuatory->last_calibration_date = $request->get('last_calibration_date');
                }
                if ($request->get('calibration_due_date')) {
                    $satuatory->calibration_due_date = $request->get('calibration_due_date');
                }
                if ($request->get('details')) {
                    $satuatory->details = $request->get('details');
                }
                $satuatory->save();
            } else {
                $satuatory = new Satuatory_Components;
                $satuatory->product_id = $request->get('product_id');
                $satuatory->product_name = $request->get('product_name');
                $satuatory->type = $request->get('type');
                if ($request->get('certification_status')) {
                    $satuatory->certification_status = true;
                } else {
                    $satuatory->certification_status = false;
                }
                if ($request->get('last_calibration_date')) {
                    $satuatory->last_calibration_date = $request->get('last_calibration_date');
                }
                if ($request->get('calibration_due_date')) {
                    $satuatory->calibration_due_date = $request->get('calibration_due_date');
                }
                if ($request->get('details')) {
                    $satuatory->details = $request->get('details');
                }
                $satuatory->save();
            }
            $satuatory_detail = Satuatory_Components::where('product_id', $request->get('product_id'))->first();
            $medias = $request->media;
            if ($medias) {
                foreach ($medias as $key => $file) {
                    $check_extension = $file->extension();
                    $check_image = array('jpeg', 'png', 'jpg');

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
                        $save_image->satuatory_id = $satuatory_detail->id;
                        $save_image->created_by = Auth::id();
                        $save_image->media_type = 'image';
                        $save_image->name = $imageName;
                        $save_image->path = $file_name;
                        $save_image->thumbnail_name = 'thumbnail_' . $imageName;
                        $save_image->thumbnail_path = $thumb_file_name;
                        $save_image->for_status = "detail";
                        $save_image->save();
                    }
                }
            }
            if ($request->get('id')) {
                return redirect('/satuatory/' . $satuatory_detail->id)->with('message', 'Satuatory details updated successfully');
            } else {
                return redirect('/satuatory/' . $satuatory_detail->id)->with('message', 'Satuatory details added successfully');
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['Login to add a machine details']]);
        }
    }
    public function satuatory_dashboard(Request $request)
    {
        if (Auth::check()) {
            $search = $request->get('search');
            if ($request->input('rows_per_page')) {
                $per_page = $request->input('rows_per_page');
                if ($per_page != Session::get('rows_per_page')) {
                    $request['page'] = "1";
                }
            } else {
                $per_page = 10;
            }
            $satuatorys_count = Satuatory_Components::all()->count();
            $satuatorys = Satuatory_Components::with(['medias'])
                ->orderBy('updated_at')
                ->when($search, function ($query) use ($search) {
                    $query->where('product_id', 'like', '%' . strtolower($search) . '%')
                        ->orWhere('product_name', 'like', '%' . strtolower($search) . '%')
                        ->orWhere('type', 'like', '%' . strtolower($search) . '%')
                        // ->orWhere('product_id', 'like', '%'.strtolower($search).'%')
                        ->orWhere('details', 'like', '%' . strtolower($search) . '%');
                })
                ->paginate($per_page);

            if ($request) {
                Session::put('filters', $request->all());
            }
            Session::put('rows_per_page', $per_page);
            return view('satuatory_components.dashboard', [
                'satuatorys' => $satuatorys,
                'satuatorys_count' => $satuatorys_count,
                'per_page' => $per_page,
                'search' => $search,
                'filters' => $request->all()
            ]);
        } else {
            return redirect('/login')->back()->withErrors(['error' => ['Login to access satuatory components dashboard']]);
        }
    }
    public function satuatory_details($id)
    {
        $satuatory_detail = Satuatory_Components::where('id', $id)->with(['medias'])->first();
        if ($satuatory_detail) {
            // return $satuatory_detail;
            return view('satuatory_components.details', [
                'satuatory_detail' => $satuatory_detail,
            ]);
        } else {
            return redirect()->back()->withErrors(['eror' => ['Satuatory component details not found, please contact your senior or admin.']]);
        }
    }
    public function update_satuatory_get($id)
    {
        if (Auth::check()) {
            $satuatory = Satuatory_Components::where('id', $id)->first();
            if ($satuatory) {
                return view('satuatory_components.add_satuatory', [
                    'satuatory' => $satuatory,
                ]);
            } else {
                return redirect('/add_satuatory');
            }
        } else {
            return redirect()->back()->withErrors(['eror' => ["You don't have the access to edit the details."]]);
        }
    }
}