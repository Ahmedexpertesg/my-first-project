<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
     use HasFactory;

    protected $fillable = [
        'image_path',
        'subtitle',
        'title',
        'button1_text',
        'button1_link',
        'button2_text',
        'button2_link',
    ];
}
