<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MachinesController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\SparesController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\SatuatoryComponentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* <----------Auth Routes------------> */
Route::get('/', function () {
    return view('auth.welcome');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login_post');
Route::get('/reset_password', [AuthController::class, 'reset_password'])->name('reset_password');
Route::post('/reset_password', [AuthController::class, 'reset_password_post'])->name('reset_password_post');
Route::get('/add_user', [AuthController::class, 'add_user'])->name('add_user');
Route::post('/add_user', [AuthController::class, 'add_user_post'])->name('add_user_post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

/* <----------Machines Routes------------> */
Route::get('/add_machine', [MachinesController::class, 'add_machine_get'])->name('add_machine_get');
Route::post('/add_machine', [MachinesController::class, 'add_machine_post'])->name('add_machine_post');
Route::get('/machine/{id}', [MachinesController::class, 'machine_details'])->name('machine_details');
Route::get('/dashboard/machines/{department}', [MachinesController::class, 'machine_dashboard'])->name('machine_dashboard');
Route::get('/update_machine/{id}', [MachinesController::class, 'update_machine_get'])->name('update_machine_get');



/* <----------Spares Routes------------> */
Route::get('/add_spare', [SparesController::class, 'add_spare_get'])->name('add_spare_get');
Route::post('/add_spare', [SparesController::class, 'add_spare_post'])->name('add_spare_post');
Route::get('/spare/{id}', [SparesController::class, 'spare_details'])->name('spare_details');
Route::get('/dashboard/spares', [SparesController::class, 'spare_dashboard'])->name('spare_dashboard');
Route::get('/update_spare/{id}', [SparesController::class, 'update_spare_get'])->name('update_spare_get');



/* <----------tools Routes------------> */
Route::get('/add_tool', [ToolsController::class, 'add_tool_get'])->name('add_tool_get');
Route::post('/add_tool', [ToolsController::class, 'add_tool_post'])->name('add_tool_post');
Route::get('/tool/{id}', [ToolsController::class, 'tool_details'])->name('tool_details');
Route::get('/dashboard/tools', [ToolsController::class, 'tool_dashboard'])->name('tool_dashboard');
Route::get('/update_tool/{id}', [ToolsController::class, 'update_tool_get'])->name('update_tool_get');



/* <----------Satuatory Routes------------> */
Route::get('/add_satuatory', [SatuatoryComponentsController::class, 'add_satuatory_get'])->name('add_satuatory_get');
Route::post('/add_satuatory', [SatuatoryComponentsController::class, 'add_satuatory_post'])->name('add_satuatory_post');
Route::get('/satuatory/{id}', [SatuatoryComponentsController::class, 'satuatory_details'])->name('satuatory_details');
Route::get('/dashboard/satuatories', [SatuatoryComponentsController::class, 'satuatory_dashboard'])->name('satuatory_dashboard');
Route::get('/update_satuatory/{id}', [SatuatoryComponentsController::class, 'update_satuatory_get'])->name('update_satuatory_get');


/* <----------Maintenance Routes------------> */
Route::get('/add_maintenance', [MaintenanceController::class, 'add_maintenance_get'])->name('add_maintenance_get');
Route::post('/add_maintenance', [MaintenanceController::class, 'add_maintenance_post'])->name('add_maintenance_post');
Route::get('/maintenance/{id}', [MaintenanceController::class, 'maintenance_details'])->name('maintenance_details');
Route::get('/dashboard/maintenance', [MaintenanceController::class, 'maintenance_dashboard'])->name('maintenance_dashboard');
Route::get('/update_maintenance/{id}', [MaintenanceController::class, 'update_maintenance_get'])->name('update_maintenance_get');
Route::post('/update_maintenance/{id}', [MaintenanceController::class, 'update_maintenance_post'])->name('update_maintenance_post');

/* <----------Spares Storage Routes------------> */
Route::get('/dashboard/spares/{place}', [SparesController::class, 'spare_dashboard_storage'])->name('spare_dashboard_storage');


// Route::get('/test', function () {
//     return view('qr_test');
// });