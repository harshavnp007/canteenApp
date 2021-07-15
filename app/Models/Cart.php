<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_id','price','qty','user_id'
    ];

    public function meal(){
        return $this->belongsTo(Meal::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

//    public function orders(){
//        return $this->hasMany(Order::class,'product_id')->where('status',2);
//    }
}
