<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Machines;
use App\Models\Maintenance;
use App\Models\Media;
use App\Models\Spares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;

class MaintenanceController extends Controller
{
    public function add_maintenance_get(Request $request)
    {
        if (Auth::check())
        {
            $machines = Machines::orderBy('machine_name')->get();
            $spares = Spares::orderBy('spare_name')->get();
            return view('maintenance.add_record', [
                'machines' => $machines,
                'spares'   =>  $spares
            ]);
        }
        else
        {
            return redirect()->back()->withErrors(['error' => ['Login to add a new maintenace record']]);
        }
    }

    public function maintenance_dashboard(Request $request)
    {
        if(Auth::check())
        {
            $maintenances = Maintenance::orderBy('created_at')->get();
            return view('maintenance.dashboard', [
                'maintenances' => $maintenances,
            ]);
        }
        else
        {
            return redirect('/login')->back()->withErrors(['error' => ['Login to add access maintenance dashboard']]);
        }
    }
    public function add_maintenance_post(Request $request)
    {
        // return $request;
        if(Auth::check())
        {
            $maintenance = new Maintenance;
            if($request->get('spare_id'))
            {
                $maintenance->spare_id = $request->get('spare_id');
            }
            if($request->get('machine_id'))
            {
                $maintenance->machine_id = $request->get('machine_id');
            }
            $request->defect = $request->get('defect');
            $maintenance->save();
            if($request->get('spare_id'))
            {
                $spare_detail = Spares::where('id', $request->get('spare_id'))->first();
            }
            if($request->get('machine_id'))
            {
                $machine_detail = Machines::where('id', $request->get('machine_id'))->first();
            }
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
                        if($request->get('machine_id'))
                        {
                            $save_image->machine_id = $request->get('machine_id');
                        }
                        if($request->get('spare_id'))
                        {
                            $save_image->spare_id = $request->get('spare_id');
                        }
                        $save_image->created_by = Auth::id();
                        $save_image->media_type = 'image';
                        $save_image->name = $imageName;
                        $save_image->path = $file_name;
                        $save_image->thumbnail_name = 'thumbnail_'.$imageName;
                        $save_image->thumbnail_path = $thumb_file_name;
                        $save_image->for_status = "defect";
                        $save_image->save();
                    }

                    if(in_array($check_extension, $check_video)){
                        
                        $videoName = time().rand(1,999).'.'.$file->extension();  
                        $file->move(public_path('storage/uploaded_video'), $videoName);
                        $path = public_path('storage/uploaded_video');
                        $file_name= "/storage/uploaded_video/" . $videoName;
                        
                        $save_video = new Media;
                        if($request->get('machine_id'))
                        {
                            $save_video->machine_id = $request->get('machine_id');
                        }
                        if($request->get('spare_id'))
                        {
                            $save_video->spare_id = $request->get('spare_id');
                        }
                        $save_video->created_by = Auth::id();
                        $save_video->media_type = 'video';
                        $save_video->name = $videoName;
                        $save_video->path = $file_name;
                        $save_video->for_status = "defect";
                        $save_video->save();
                    }
                }
            }
            return redirect('/dashboard/maintenance')->with('message', 'New maintenance record added successfully');
        }
        else
        {
            return redirect()->back()->withErrors(['error' => ['Login to add a maintenance details']]);
        }
    }   
    public function maintenance_details($id)
    {
        $maintenance_detail = Maintenance::where('id', $id)->with('machine.medias', 'spare.medias')
        // ->whereHas('machine', function ($query) {
        //     $query->whereHas('medias', function ($query) {
        //         $query->where('for_status', 'defect');
        //     });
        // })
        // ->whereHas('spare', function ($query) {
        //     $query->whereHas('medias', function ($query) {
        //         $query->where('for_status', 'defect');
        //     });
        // })
        ->first();
        if($maintenance_detail)
        {
            // return $maintenance_detail;
            return view('maintenance.details', [
                'maintenance_detail' => $maintenance_detail,
            ]);
        }
        else
        {
            return redirect()->back()->withErrors(['eror' => ['Maintenance details not found, please contact your senior or admin.']]);
        }
    }
}
