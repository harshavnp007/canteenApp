<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    static public $paymentType = [
      'cod'=>1,'wallet'=>2,'online'=>3
    ];

    protected $fillable = [
        'payment_type','meal_id','qty','total_price','common_order_number','order_number','user_id','status','rzp_id','wallet_detail_id','each_price' // 1 => Pending; 2 => Success; 3 => Failure;
    ];

    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
}
