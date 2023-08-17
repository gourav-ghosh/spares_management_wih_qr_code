<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuatory_Components extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_name',
        'type',
        'certification_status',
        'calibration_due_date',
        'last_calibration_date',
        'details',
    ];
    public function medias()
    {
        return $this->hasMany(Media::class, 'satuatory_id');
    }
}