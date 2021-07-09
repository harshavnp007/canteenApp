<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Recipe;
use App\Models\Allergen;
use App\Models\TempFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRecipeRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('meal_access'), 403);
        return view('recipes.index');
    }

    public function create(): View
    {
        abort_if(Gate::denies('meal_create'), 403);
        return view('recipes.create');
    }

    public function store(StoreRecipeRequest $request): RedirectResponse
    {
        $meal = Meal::create([
            'name' => $request['name'],
            'stocks' => $request['stocks'] == 'on',
            'price' => $request->has('price'),
            'timing_from' => Carbon::createFromFormat('H:i',$request['timing_from']),
            'timing_to' => Carbon::createFromFormat('H:i',$request['timing_to']),
            'description' => $request['description'],
            'slug'=>Str::slug($request['name'])
        ]);

        if ($request->hasFile('image')) {
            $meal->addMedia($request->image)->toMediaCollection();
        }
        return redirect('recipes');
    }

    public function show($recipeId): View
    {
        abort_if(Gate::denies('meal_show'), 403);
        $meal = Meal::find($recipeId);
        return view('recipes.show', compact('meal'));
    }

    public function edit($recipeid): View
    {
        abort_if(Gate::denies('meal_edit'), 403);
        $meal = Meal::find($recipeid);
        return view('recipes.edit', compact('meal'));
    }

    public function update(UpdateRecipeRequest $request, $mealid): RedirectResponse
    {
        $meal = Meal::find($mealid);
        if ($meal->getMedia()) {
            $mediaItems = $meal->getMedia()->first();
            $mediaItems->delete();
            $meal->addMedia($request->image)->toMediaCollection();
        }

        $meal->name = $request->get('name');
        $meal->stocks = $request->get('stocks') == 'on';
        $meal->price = $request->get('price');
        $meal->timing_from =Carbon::createFromFormat('H:i',$request->get('timing_from'));
        $meal->timing_to =Carbon::createFromFormat('H:i',$request->get('timing_to'));
        $meal->description = $request->get('description');
        $meal->save();
        return redirect('recipes');
    }

    public function destroy(Recipe $recipe): RedirectResponse
    {
        abort_if(Gate::denies('meal_delete'), 403);

        $recipe->delete();

        return redirect()->back();
    }

    public function liked(): View
    {
        abort_if(Gate::denies('meal_access'), 403);

        $recipes = Auth()->user()->likedRecipes()->paginate(15);

        return view('recipes.liked', compact('recipes'));
    }

    public function like(Recipe $recipe): RedirectResponse
    {
        abort_if(Gate::denies('meal_access'), 403);

        Auth()->user()->likedRecipes()->attach($recipe->id);

        return redirect()->route('recipes.show', $recipe);
    }

    public function unlike(Recipe $recipe): RedirectResponse
    {
        abort_if(Gate::denies('meal_access'), 403);

        DB::table('likes')->where('recipe_id', $recipe->id)->where('user_id', Auth()->id())->delete();

        return redirect()->route('recipes.show', $recipe);
    }
}
