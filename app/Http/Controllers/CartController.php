<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart_list(){
        $carts = Cart::with('meal','meal.media')->where('user_id',Auth::id())->get();
        return view('cart',compact('carts'));
    }

    public function save_cart($meal_id,Request $request){
        $meal = Meal::find($meal_id);
        if($meal->stocks){
            if(isset($meal)){
                $cart = Cart::where('user_id',Auth::id())->where('meal_id',$meal_id)->first();
                if($cart){
                    $cart->qty = $cart->qty +1;
                    $cart->save();
                }else{
                    Cart::create([
                        'meal_id'=>$meal_id,
                        'price'=>$meal->price,
                        'user_id'=>Auth::id()
                    ]);
                }
            }
            return redirect('cart');
        }else{
            session()->flash('fail','Sorry, stock is not available');
            return redirect('recipes');
        }
    }

    public function edit_cart($cart_id,$action,Request $request){
        $cart = Cart::where('user_id',Auth::id())->where('id',$cart_id)->first();
        if(isset($cart)){
            if($action == 'add'){
                if($cart->meal->stocks && $cart->qty <= 5){
                    $cart->qty = $cart->qty + 1;
                    $cart->save();
                }else{
                    session()->flash('fail','Sorry, stock is not available');
                }
            }elseif($action == 'minus'){
                if($cart->qty == 1){
                    $cart->delete();
                }else{
                    $cart->qty = $cart->qty -1;
                    $cart->save();
                }
            }
        }
        return redirect('cart');
    }

    public function cart_remove($cart_id){
        $cart = Cart::find($cart_id);
        if(isset($cart)){
            $cart->delete();
        }
        return redirect('cart');
    }
}
