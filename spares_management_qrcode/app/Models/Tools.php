<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    use HasFactory;
    protected $fillable = [
        'tool_id',
        'tool_name',
        'machine',
        'safety_status',
        'location',
        'specification',
        'last_inspection_date',
        'inspection_due_date',
    ];
    public function medias()
    {
        return $this->hasMany(Media::class, 'tool_id');
    }
}