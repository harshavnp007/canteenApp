<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\WalletDetail;
use Gate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::role('user')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        return redirect()->route('admin.users.index');
    }

    public function show($user_id)
    {
        $user = User::find($user_id);
        $orders = Order::where('user_id',$user->id)->with('meal')->get();
        $wallet = Wallet::where('user_id',$user->id)->first();
        $walletDetails = null;
        if(isset($wallet)){
            $walletDetails = WalletDetail::where('wallet_id',$wallet->id)->get();
        }
        return view('admin.users.view',compact('user','orders','wallet','walletDetails'));
    }

    public function edit(User $user): View
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function approve($email): RedirectResponse
    {
        $email = Crypt::decrypt($email);

        $user = User::where('email', $email)->first();
        $user->update([
            'approved' => 1,
        ]);

        return redirect()->route('admin.users.index');
    }

    public function adminRecipe(){
        $user = Auth::user();
        if(!$user->hasRole('User')){
            $meals = Meal::with('media')->get();
            return view('admin.meal',compact('meals'));
        }
        return abort(403);
    }

}
