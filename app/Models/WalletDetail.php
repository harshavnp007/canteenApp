<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletDetail extends Model
{
    use HasFactory;

    protected $fillable = [
      'wallet_id',
      'common_order_number',
      'credited',
        'amount',
        'rzp_id'
    ];
}
