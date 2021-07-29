<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealsController extends Controller
{
    public function meals(){
        $meals = Meal::with('media')->get();
        return view('meals.list',compact('meals'));
    }
}
