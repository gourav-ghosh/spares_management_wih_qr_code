<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'machine_id',
        'spare_id',
        'defect',
        'operator_approval',
        'incharge_approval',
        'maintenance_completed',
    ];
}
