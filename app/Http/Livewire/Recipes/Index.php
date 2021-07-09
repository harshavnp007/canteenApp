<?php

namespace App\Http\Livewire\Recipes;

use App\Models\Meal;
use App\Models\Recipe;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $search;
    Public $allRecipes;

    public function render()
    {
        $meals = Meal::paginate(15);
        return view('livewire.recipes.index', compact('meals'));
    }
}
