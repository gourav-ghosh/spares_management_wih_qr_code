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
        'last_maintenance_date',
        'due_maintenance_date',
        'operation_start_date',
    ];
}
