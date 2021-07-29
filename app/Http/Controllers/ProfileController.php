<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletDetail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function profile(): View
    {
        return view('user.profile.index');
    }

    public function wallet(): View
    {
        $wallet = Wallet::where('user_id',\Illuminate\Support\Facades\Auth::id())->first();
        $walletDetails = WalletDetail::where('wallet_id',$wallet->id)->get();
        return view('user.wallet',compact('wallet','walletDetails'));
    }

    public function add_money_wallet(Request $request){
        $rzp_id= $request->get('rzp_id');
        $amount= $request->get('amount');
        if(isset($rzp_id) && $amount > 0){
            $wallet = Wallet::where('user_id',\Illuminate\Support\Facades\Auth::id())->first();
            WalletDetail::create([
               'wallet_id'=>$wallet->id,
               'credited'=>true,
               'amount'=>$amount,
               'rzp_id'=>$rzp_id
            ]);
            $wallet->total_amount = $wallet->total_amount+50;
            $wallet->save();
        }
        return redirect()->route('wallet');
    }

    public function accountSettings(): View
    {
        return view('user.profile.account');
    }

    public function securitySettings(): View
    {
        return view('user.profile.security');
    }

    public function update(UpdateAccountRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->email != $request['email'])  {
            $user->update([
                'email_verified_at' => null,
            ]);
        }

        $user->update($request->only('name', 'email'));

        return redirect(route('profile.settings.account'))->with('profileStatus', 'Account Successfully Updated');
    }

    public function password(ChangePasswordRequest $request): RedirectResponse
    {
        $user = Auth::User();

        $user->update([
            'password' => Hash::make($request['password'])
        ]);

        return redirect(route('profile.settings.account'))->with('passwordStatus', 'Password Changed Successfully');
    }
}
