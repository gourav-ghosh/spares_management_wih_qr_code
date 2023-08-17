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
        'for_status',
        'media_type',
        'machine_id',
        'spare_id',
        'tool_id',
        'satuatory_id',
        'created_by',
        'comment',
        'commented_by',
    ];

    public function machine()
    {
        return $this->belongsTo(Machines::class, 'machine_id');
    }

    public function spare()
    {
        return $this->belongsTo(Spares::class, 'spare_id');
    }

    public function tool()
    {
        return $this->belongsTo(Tools::class, 'tool_id');
    }
    public function satuatory()
    {
        return $this->belongsTo(Satuatory_Components::class, 'satuatory_id');
    }

}