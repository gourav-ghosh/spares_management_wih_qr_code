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
        'department',
        'parent_machine',
        'description',
        'last_installation_date',
        'last_maintenance_date',
        'due_maintenance_date',
        'operation_start_date',
    ];
}
