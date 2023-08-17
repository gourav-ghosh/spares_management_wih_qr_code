<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Machines;
use App\Models\Maintenance;
use App\Models\Media;
use App\Models\Spares;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Session;

class MaintenanceController extends Controller
{
    public function add_maintenance_get(Request $request)
    {
        if (Auth::check()) {
            $machines = Machines::orderBy('machine_name')->get();
            $spares = Spares::orderBy('spare_name')->get();
            return view('maintenance.add_record', [
                'machines' => $machines,
                'spares' => $spares
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => ['Login to add a new maintenace record']]);
        }
    }

    public function maintenance_dashboard(Request $request)
    {
        if (Auth::check()) {

            if ($request->input('rows_per_page')) {
                $per_page = $request->input('rows_per_page');
                if ($per_page != Session::get('rows_per_page')) {
                    $request['page'] = "1";
                }
            } else {
                $per_page = 10;
            }
            $maintenances_count = Maintenance::all()->count();
            $maintenances = Maintenance::with(['machine.medias', 'spare.medias'])
                // ->whereHas('machine')
                ->orderBy('updated_at', 'DESC')->paginate($per_page);
            // return $maintenances;

            if ($request) {
                Session::put('filters', $request->all());
            }
            Session::put('rows_per_page', $per_page);
            return view('maintenance.dashboard', [
                'maintenances' => $maintenances,
                'maintenances_count' => $maintenances_count,
                'per_page' => $per_page,
                'filters' => $request->all()
            ]);
        } else {
            return redirect('/login')->back()->withErrors(['error' => ['Login to add access maintenance dashboard']]);
        }
    }
    public function add_maintenance_post(Request $request)
    {
        // return $request;
        if (Auth::check()) {
            $maintenance = new Maintenance;
            if ($request->get('spare_id')) {
                $maintenance->spare_id = $request->get('spare_id');
            }
            if ($request->get('machine_id')) {
                $maintenance->machine_id = $request->get('machine_id');
            }
            $maintenance->defect = $request->get('defect');
            $maintenance->save();
            if ($request->get('spare_id')) {
                $spare_detail = Spares::where('id', $request->get('spare_id'))->first();
            }
            if ($request->get('machine_id')) {
                $machine_detail = Machines::where('id', $request->get('machine_id'))->first();
            }
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
                        if ($request->get('machine_id')) {
                            $save_image->machine_id = $request->get('machine_id');
                        }
                        if ($request->get('spare_id')) {
                            $save_image->spare_id = $request->get('spare_id');
                        }
                        $save_image->created_by = Auth::id();
                        $save_image->media_type = 'image';
                        $save_image->name = $imageName;
                        $save_image->path = $file_name;
                        $save_image->thumbnail_name = 'thumbnail_' . $imageName;
                        $save_image->thumbnail_path = $thumb_file_name;
                        $save_image->for_status = "defect";
                        $save_image->save();
                    }

                    if (in_array($check_extension, $check_video)) {

                        $videoName = time() . rand(1, 999) . '.' . $file->extension();
                        $file->move(public_path('storage/uploaded_video'), $videoName);
                        $path = public_path('storage/uploaded_video');
                        $file_name = "/storage/uploaded_video/" . $videoName;

                        $save_video = new Media;
                        if ($request->get('machine_id')) {
                            $save_video->machine_id = $request->get('machine_id');
                        }
                        if ($request->get('spare_id')) {
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
        } else {
            return redirect()->back()->withErrors(['error' => ['Login to add a maintenance details']]);
        }
    }
    public function maintenance_details($id)
    {
        $maintenance_detail = Maintenance::where('id', $id)->with('machine.medias', 'spare.medias')
            ->first();
        if ($maintenance_detail) {
            // return $maintenance_detail;
            return view('maintenance.details', [
                'maintenance_detail' => $maintenance_detail,
            ]);
        } else {
            return redirect()->back()->withErrors(['eror' => ['Maintenance details not found, please contact your senior or admin.']]);
        }
    }
    public function update_maintenance_get($id)
    {
        $maintenance = Maintenance::where('id', $id)->first();
        return view('maintenance.update_form', [
            'maintenance' => $maintenance,
        ]);
    }
    public function update_maintenance_post(Request $request, $id)
    {
        $maintenance = Maintenance::where('id', $id)->first();
        $medias = $request->images;
        if ($medias) {
            foreach ($medias as $key => $file) {
                $check_extension = $file->extension();
                $check_image = array('jpeg', 'png', 'jpg');

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
                    if ($maintenance->machine_id) {
                        $save_image->machine_id = $maintenance->machine_id;
                    }
                    if ($maintenance->spare_id) {
                        $save_image->spare_id = $maintenance->spare_id;
                    }
                    $save_image->created_by = Auth::id();
                    $save_image->media_type = 'image';
                    $save_image->name = $imageName;
                    $save_image->path = $file_name;
                    $save_image->thumbnail_name = 'thumbnail_' . $imageName;
                    $save_image->thumbnail_path = $thumb_file_name;
                    $save_image->for_status = "maintenance";
                    $save_image->save();
                }
            }
        }
        $maintenance->maintenance_completed = Carbon::now();
        $maintenance->junior_approval = Auth::id();
        $maintenance->save();
        if ($maintenance->machine_id) {
            $machine = Machines::where('id', $maintenance->machine_id)->first();
            $machine->last_maintenance_date = Carbon::today();
            if ($request->get('due_maintenance_date')) {
                $machine->due_maintenance_date = $request->get('due_maintenance_date');
            }
            $machine->save();
        }
        if ($maintenance->spare_id) {
            $spare = Spares::where('id', $maintenance->spare_id)->first();
            $spare->last_maintenance_date = Carbon::today();
            if ($request->get('due_maintenance_date')) {
                $spare->due_maintenance_date = $request->get('due_maintenance_date');
            }
            $spare->save();
        }
        return redirect('/dashboard/maintenance')->with('message', 'Maintenance record updated successfully');
    }
}