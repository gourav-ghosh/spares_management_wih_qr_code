<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machines extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'machine_name',
        'machine_type',
        'department',
        'description',
        'last_maintenance_date',
        'due_maintenance_date',
        'operation_start_date',
    ];

    public function medias()
    {
        return $this->hasMany(Media::class, 'machine_id');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'machine_id')->orderBy('created_at', 'DESC');
    }

    public function spares()
    {
        return $this->belongsTo(Spares::class, 'parent_machine');
    }
}