<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'path',
        'thumbnail_name',
        'thumbnail_path',
        'media_type',
        'machine_id',
        'spare_id',
        'created_by',
        'comment',
        'commented_by',
    ];
}
