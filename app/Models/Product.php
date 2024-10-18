<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    // Define which attributes can be mass assigned
    protected $fillable = [
        'EnglishName',
        'EnglishDescription',
        'ArabicName',
        'ArabicDescription',
        'TurkishName',
        'TurkishDescription',
        'image',
        'pdf'
    ];

    // If you don't want to use timestamps, disable them
    public $timestamps = true;
}
