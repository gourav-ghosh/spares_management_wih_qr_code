<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Machines;
use App\Models\Media;
use App\Models\Spares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Session;

class SparesController extends Controller
{
    public function add_spare_get(Request $request)
    {
        if (Auth::check())
        {
            $machines = Machines::orderBy('machine_name')->get();
            // return $machines;
            return view('spares.add_spare', [
                'machines' => $machines,
                'spare' => null
            ]);
        }
        else
        {
            return redirect()->back()->withErrors(['error' => ['Login to add a new spare']]);
        }
    }
    public function spare_dashboard(Request $request)
    {
        if(Auth::check())
        {
            $search = $request->get('search');
            if($request->input('rows_per_page')){
                $per_page = $request->input('rows_per_page');
                if($per_page != Session::get('rows_per_page')){
                    $request['page'] = "1";
                }
            } else{
                $per_page = 10;
            }
            $spares_count = Spares::all()->count();
            $spares = Spares::with(['medias'])
                ->orderBy('created_at')
                ->when($search, function ($query) use ($search) {
                    $query->where('spare_id', 'like', '%'.strtolower($search).'%')
                        ->orWhere('spare_name', 'like', '%'.strtolower($search).'%')
                        ->orWhere('spare_type', 'like', '%'.strtolower($search).'%')
                        ->orWhere('department', 'like', '%'.strtolower($search).'%')
                        ->orWhere('description', 'like', '%'.strtolower($search).'%');
                        // ->orWhere('', 'like', '%'.strtolower($search).'%');
                })
                ->paginate($per_page);
            
            if($request){
                Session::put('filters', $request->all());
            }
            Session::put('rows_per_page', $per_page);
            return view('spares.dashboard', [
                'spares' => $spares,
                'spares_count' => $spares_count,
                'per_page' => $per_page,
                'search' => $search,
                'place' => null,
                'filters' => $request->all()
            ]);
        }
        else
        {
            return redirect('/login')->back()->withErrors(['error' => ['Login to add access spares dashboard']]);
        }
    }
    public function add_spare_post(Request $request)
    {
        if(Auth::check())
        {
            if($request->get('id'))
            {
                $spare = Spares::where('id', $request->get('id'))->first();
                $spare->spare_id = $request->get('spare_id');
                $spare->spare_name = $request->get('spare_name');
                $spare->spare_type = $request->get('spare_type');
                $spare->department = $request->get('department');
                if($request->get('spare_storage'))
                {
                    $spare->spare_storage = $request->get('spare_storage');
                }
                if($request->get('parent_machine'))
                {
                    if($request->get('parent_machine') != 'other')
                    {
                        $spare->parent_machine = $request->get('parent_machine');
                    }
                }
                if($request->get('last_installation_date'))
                {
                    $spare->last_installation_date = $request->get('last_installation_date');
                }
                if($request->get('last_maintenance_date'))
                {
                    $spare->last_maintenance_date = $request->get('last_maintenance_date');
                }
                if($request->get('due_maintenance_date'))
                {
                    $spare->due_maintenance_date = $request->get('due_maintenance_date');
                }
                if($request->get('operation_start_date'))
                {
                    $spare->operation_start_date = $request->get('operation_start_date');
                }
                
                if($request->get('description'))
                {
                    $spare->description = $request->get('description');
                }
                $spare->save();
            }
            else
            {
                $spare = new Spares;
                $spare->spare_id = $request->get('spare_id');
                $spare->spare_name = $request->get('spare_name');
                $spare->spare_type = $request->get('spare_type');
                $spare->department = $request->get('department');
                if($request->get('spare_storage'))
                {
                    $spare->spare_storage = $request->get('spare_storage');
                }
                if($request->get('parent_machine'))
                {
                    if($request->get('parent_machine') != 'other')
                    {
                        $spare->parent_machine = $request->get('parent_machine');
                    }
                }
                if($request->get('last_installation_date'))
                {
                    $spare->last_installation_date = $request->get('last_installation_date');
                }
                if($request->get('last_maintenance_date'))
                {
                    $spare->last_maintenance_date = $request->get('last_maintenance_date');
                }
                if($request->get('due_maintenance_date'))
                {
                    $spare->due_maintenance_date = $request->get('due_maintenance_date');
                }
                if($request->get('operation_start_date'))
                {
                    $spare->operation_start_date = $request->get('operation_start_date');
                }
                
                if($request->get('description'))
                {
                    $spare->description = $request->get('description');
                }
                $spare->save();
            }
            $spare_detail=Spares::where('spare_id', $request->get('spare_id'))->first();
            $medias = $request->media;
            if($medias)
            {
                foreach($medias as $key => $file)
                {
                    $check_extension = $file->extension();
                    $check_image = array('jpeg', 'png', 'jpg');
                    $check_video = array('mp4', 'avi', 'mkv');
                    
                    // return $file->extension();
                    if(in_array($check_extension, $check_image))
                    {
                        $imageName = time().rand(1,999).'.'.$file->extension();
                        $file->move(public_path('storage/uploads'), $imageName);
                        $path = public_path('storage/uploads');
                        $manager = new ImageManager();
                        $thumb_path = public_path('storage/uploads/thumbnail');
                        $thumb_name = 'thumbnail_'.$imageName;
                        $imageMin = $manager->make(public_path('storage/uploads').'/'.$imageName)->resize(400, 400)->save($thumb_path.'/'.$thumb_name);
                        $file_name= "/storage/uploads/" . $imageName;
                        $thumb_file_name= "/storage/uploads/thumbnail/" .'thumbnail_' . $imageName;

                        $save_image = new Media;
                        $save_image->spare_id = $spare_detail->id;
                        $save_image->created_by = Auth::id();
                        $save_image->media_type = 'image';
                        $save_image->name = $imageName;
                        $save_image->path = $file_name;
                        $save_image->thumbnail_name = 'thumbnail_'.$imageName;
                        $save_image->thumbnail_path = $thumb_file_name;
                        $save_image->for_status = "detail";
                        $save_image->save();
                    }

                    if(in_array($check_extension, $check_video)){
                        
                        $videoName = time().rand(1,999).'.'.$file->extension();  
                        $file->move(public_path('storage/uploaded_video'), $videoName);
                        $path = public_path('storage/uploaded_video');
                        $file_name= "/storage/uploaded_video/" . $videoName;
                        
                        $save_video = new Media;
                        $save_video->spare_id = $spare_detail->id;
                        $save_video->created_by = Auth::id();
                        $save_video->media_type = 'video';
                        $save_video->name = $videoName;
                        $save_video->path = $file_name;
                        $save_video->for_status = "detail";
                        $save_video->save();
                    }
                }
            }
            if($request->get('id'))
            {
                return redirect('/spare/'.$spare_detail->id)->with('message', 'Spare details updated successfully');
            }
            else
            {
                return redirect('/spare/'.$spare_detail->id)->with('message', 'Spare details added successfully');
            }
        }
        else
        {
            return redirect()->back()->withErrors(['error' => ['Login to add a mechine details']]);
        }
    }
    public function spare_details($id)
    {
        $spare_detail = Spares::where('id', $id)->with(['medias', 'maintenances', 'parent_machines.medias'])->first();
        $parent_machines = Machines::with('medias')->where('id', $spare_detail->parent_machine)->get();
        if($spare_detail)
        {    
            // return $spare_detail;
            return view('spares.details', [
                'spare_detail' =>$spare_detail,
                'parent_machines' =>$parent_machines,
            ]);
        }
        else
        {
            return redirect()->back()->withErrors(['eror' => ['Spare details not found, please contact your senior or admin.']]);
        }
    }
    public function spare_dashboard_storage(Request $request, $place)
    {
        if(Auth::check())
        {
            if($request->input('rows_per_page')){
                $per_page = $request->input('rows_per_page');
                if($per_page != Session::get('rows_per_page')){
                    $request['page'] = "1";
                }
            } else{
                $per_page = 10;
            }
            $spares_count = Spares::where('spare_storage', $place)->count();
            $spares = Spares::with(['medias'])->where('spare_storage', $place)->orderBy('created_at')->paginate($per_page);
            
            if($request){
                Session::put('filters', $request->all());
            }
            Session::put('rows_per_page', $per_page);
            return view('spares.dashboard', [
                'spares' => $spares,
                'spares_count' => $spares_count,
                'per_page' => $per_page,
                'place' => $place,
                'filters' => $request->all()
            ]);
        }
        else
        {
            return redirect('/login')->back()->withErrors(['error' => ['Login to add access spares storage dashboard']]);
        }
    }
    public function update_spare_get($id)
    {
        if(Auth::check())
        {
            $spare = Spares::where('id', $id)->first();
            $machines = Machines::orderBy('machine_name')->get();
            if($spare)
            {
                return view('spares.add_spare', [
                    'spare' => $spare,
                    'machines' => $machines
                ]);
            }
            else
            {
                return redirect('/add_spare');
            }
        }
        else
        {
            return redirect()->back()->withErrors(['eror' => ["You don't have the access to edit the details."]]);
        }
    }
}
