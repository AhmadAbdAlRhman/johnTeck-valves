<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificates extends Model
{
    use HasFactory;
    protected $table = 'Certificates';
    // Define which attributes can be mass assigned
    protected $fillable = [
        'image',
        'pdf'
    ];

    // If you don't want to use timestamps, disable them
    public $timestamps = true;
}
