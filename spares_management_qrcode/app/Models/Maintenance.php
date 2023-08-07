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
        'jumior_approval',
        'senior_approval',
        'maintenance_completed',
    ];

    
    public function machine(){
        return $this->belongsTo(Machines::class, 'machine_id');
    }

    public function spare(){
        return $this->belongsTo(Spares::class, 'spare_id');
    }    
}
