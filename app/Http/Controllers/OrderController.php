<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\WalletDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function orders(){
        $orders = Order::where('user_id',Auth::id())->with('meal','meal.media')->get()->groupBy(['common_order_number']);
        return view('order_list',compact('orders'));
    }

    public function saveOrder(Request $request){
        $common_order_number = env('ORDER_PREFIX').Carbon::now()->timestamp;
        $payment_type = $request->get('payment_type');
        $carts = Cart::where('user_id',Auth::id())->get();
        $total_amount = $carts->sum(function ($query){
            return $query->price * $query->qty;
        });
        DB::beginTransaction();
        try {
            foreach ($carts as $cart){
                $orderData = [
                    'payment_type'=>$payment_type,
                    'meal_id'=>$cart->meal_id,
                    'qty'=>$cart->qty,
                    'total_price'=>$total_amount,
                    'common_order_number'=>$common_order_number,
                    'order_number'=>$this->uniqueOrderNum(),
                    'user_id'=>Auth::id(),
                    'status'=>1,
                ];
                if($payment_type == 3){
                    $rzp_id = $request->get('rzp_id');
                    $orderData['rzp_id']=$rzp_id;
                }
                $order = Order::create($orderData);
                $cart->delete();
            }
            if($payment_type == 2){
                $wallet = Wallet::where('user_id',Auth::id())->first();
                if($wallet->total_amount >= $total_amount){
                    $wallet_detail = WalletDetail::create([
                        'wallet_id'=>$wallet->id,
                        'common_order_number'=>$common_order_number,
                        'credited'=>false,
                        'amount'=>$total_amount,
                    ]);
                    $wallet->total_amount = $wallet->total_amount - $total_amount;
                    $wallet->save();
                }else{
                    return redirect('cart')->with(['message'=>'Insufficient amount in your wallet']);
                }
            }
            DB::commit();
            return redirect('orders');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::info($exception);
            return redirect('cart')->with(['message'=>'Something went wrong, try again']);
        }
    }

    private function uniqueOrderNum(){
        $randomString = Str::random(6);
        $orders = Order::where('order_number',$randomString)->first();
        if(isset($orders)){
            return $this->uniqueOrderNum();
        }else{
            return $randomString;
        }
    }
}
