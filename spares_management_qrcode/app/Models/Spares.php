<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spares extends Model
{
    use HasFactory;
    protected $fillable = [
        'spare_id',
        'spare_name',
        'spare_type',
        'spare_storage',
        'department',
        'parent_machine',
        'description',
        'last_installation_date',
        'last_maintenance_date',
        'due_maintenance_date',
        'operation_start_date',
    ];

    public function medias(){
        return $this->hasMany(Media::class, 'spare_id');
    }

    public function maintenances(){
        return $this->hasMany(Maintenance::class, 'spare_id')->orderBy('created_at', 'DESC');
    }
    public function parent_machines(){
        return $this->hasMany(Machines::class, 'id');
    }
}
