@extends('layouts.app')

@section('content')
<p class="font-bold mb-5 dark:text-gray-200">
    Top meals
</p>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-5">
    @foreach ($meals as $meal)
        <a href="{{ secure_url('recipes/'.$meal->id) }}">
            <div class="w-full h-full rounded-md shadow-md bg-white dark:bg-gray-700">
                <div>
                    @if ($meal->getMedia()->count() > 0)
                        <img src="{{ $meal->getFirstMediaUrl('default', 'thumb') }}" class="w-full h-32 object-cover rounded-t-md" alt="{{ $meal->name }}">
                    @else
                        <img src="https://via.placeholder.com/640x360.png?text=No+Image" class="w-full h-32 object-cover rounded-t-md" alt="No image available">
                    @endif
                </div>
                <div class="p-4 rounded-b-md dark:text-gray-200">
                    <p class="mb-2">
                        {{ $meal->name }}
                    </p>

                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection
