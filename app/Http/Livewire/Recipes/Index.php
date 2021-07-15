<?php

namespace App\Http\Livewire\Recipes;

use App\Models\Meal;
use App\Models\Recipe;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $search;
    Public $allRecipes;
    public $filter_category = 0;
    public $price_filter = 0;

    public function render()
    {
        $meals = Meal::orderBy('price','desc');
        Log::info($this->price_filter);
        if($this->price_filter != 0){
            $meals->orderBy('price',$this->price_filter);
        }
        if($this->filter_category != 0){
            $meals->where('category',$this->filter_category);
        }
        $meals = $meals->paginate(10);
        return view('livewire.recipes.index', compact('meals'));
    }
}
