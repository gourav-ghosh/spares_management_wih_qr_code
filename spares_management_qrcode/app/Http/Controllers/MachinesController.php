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

class MachinesController extends Controller
{
    public function add_machine_get(Request $request)
    {
        if (Auth::check())
        {
            return view('machines.add_machine');
        }
        else
        {
            return redirect()->back()->withErrors(['error' => ['Login to add a new machine']]);
        }
    }
    public function machine_dashboard(Request $request, $department)
    {
        if(Auth::check())
        {
            if($department == 'all')
            {
                $department_options = ['mcl', 'ccl', 'mechanical_maintenance'];
            }
            else
            {
                $department_options[] = $department;
            }
            if($request->input('rows_per_page')){
                $per_page = $request->input('rows_per_page');
                if($per_page != Session::get('rows_per_page')){
                    $request['page'] = "1";
                }
            } else{
                $per_page = 10;
            }
            $machines_count = Machines::all()->count();
            $machines = Machines::with(['medias'])->whereIn('department', $department_options)->orderBy('created_at', 'DESC')->paginate($per_page);
            
            if($request){
                Session::put('filters', $request->all());
            }
            Session::put('rows_per_page', $per_page);
            return view('machines.dashboard', [
                'machines' => $machines,
                'machines_count' => $machines_count,
                'per_page' => $per_page,
                'department' => $department,
                'filters' => $request->all()
            ]);
        }
        else
        {
            return redirect('/login')->back()->withErrors(['error' => ['Login to add access Machines dashboard']]);
        }
    }
    public function add_machine_post(Request $request)
    {
        if(Auth::check())
        {
            $machine = new Machines;
            $machine->machine_id = $request->get('machine_id');
            $machine->machine_name = $request->get('machine_name');
            $machine->machine_type = $request->get('machine_type');
            $machine->department = $request->get('department');
            if($request->get('last_maintenance_date'))
            {
                $machine->last_maintenance_date = $request->get('last_maintenance_date');
            }
            if($request->get('due_maintenance_date'))
            {
                $machine->due_maintenance_date = $request->get('due_maintenance_date');
            }
            if($request->get('operation_start_date'))
            {
                $machine->operation_start_date = $request->get('operation_start_date');
            }
            if($request->get('description'))
            {
                $machine->description = $request->get('description');
            }
            $machine->save();
            $machine_detail=Machines::where('machine_id', $request->get('machine_id'))->first();
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
                        $save_image->machine_id = $machine_detail->id;
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
                        $save_video->machine_id = $machine_detail->id;
                        $save_video->created_by = Auth::id();
                        $save_video->media_type = 'video';
                        $save_video->name = $videoName;
                        $save_video->path = $file_name;
                        $save_video->for_status = "detail";
                        $save_video->save();
                    }
                }
            }
            return redirect('/machine/'.$machine_detail->id)->with('message', 'Machine details added successfully');
        }
        else
        {
            return redirect()->back()->withErrors(['error' => ['Login to add a mechine details']]);
        }
    }
    public function machine_details($id)
    {
        $machine_detail = Machines::where('id', $id)->with(['medias', 'maintenances'])->first();
        if($machine_detail)
        {
            $spares = Spares::where('parent_machine', $id)->with('medias')->get();
            // return $spares;
            return view('machines.details', [
                'machine_detail' => $machine_detail,
                'spares' => $spares,
            ]);
        }
        else
        {
            return redirect()->back()->withErrors(['eror' => ['Machine details not found, please contact your senior or admin.']]);
        }
    }
}
