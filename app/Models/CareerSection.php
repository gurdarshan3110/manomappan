<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'section_title',
        'section_content',
        'section_image',
        'section_order'
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
