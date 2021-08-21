<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use Gate;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class PagesController extends Controller
{
    public function homepage(): View
    {
        $meals = Meal::with('media')->take(6)->get();

        return view('homepage', compact('meals'));
    }

    public function adminDashboard(): View
    {
        abort_if(Gate::denies('admin_access'), 403);

        $users = User::count();
        $recipes = Meal::count();
        $ingredients = Order::count();

        return view('admin.dashboard', compact('users', 'recipes', 'ingredients'));
    }
}
