<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Meal extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    static public $categories = [
        'breakfast'=>1,'lunch'=>2,'snacks'=>3
    ];

    protected $fillable = [
        'name',
        'stocks',
        'price',
        'timing_from',
        'timing_to',
        'description',
        'slug',
        'category'
    ];
}
