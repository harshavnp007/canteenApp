@extends('layouts.guest')

@section('content')
    <div class="container my-12 mx-auto px-4 md:px-12">
        <h1 class="text-center text-2xl mb-10 font-bold uppercase">Meals</h1>
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
        @foreach($meals as $meal)
            <!-- Column -->
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg">
                        <div class="relative">
                            @if ($meal->getMedia()->count() > 0)
                                <img alt="{{$meal->name}}" class="block m-auto h-auto" src="{{ $meal->getFirstMediaUrl('default', 'thumb') }}">
                            @else
                                <img alt="{{$meal->name}}" class="block m-auto h-auto" src="https://via.placeholder.com/640x360.png?text=No+Image">
                            @endif
                            <span class="text-white absolute capitalize bottom-0 left-0 px-2 py-1 block bg-gradient-to-r from-gray-800">
                                {{array_search($meal->category,\App\Models\Meal::$categories)}}
                            </span>
                        </div>
                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black" href="#">
                                    <span class="text-bold">{{$meal->name}}</span>
                                    <span class="block text-gray-800"> ₹ {{$meal->price}}</span>
                                </a>
                            </h1>
                            @auth
                                <div class="">
                                    @if($meal->stocks)
                                        @if($meal->cart_info_count <= 0)
                                            <form action="{{secure_url('cart/'.$meal->id)}}" method="post">
                                                @csrf
                                                <x-button type="submit">
                                                    <span class="flex items-center space-x-2">
                                                        <span>Add</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 ml-2 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                        </svg>
                                                    </span>
                                                </x-button>
                                            </form>
                                        @else
                                            <x-nav-link href="{{secure_url('cart')}}">View Basket</x-nav-link>
                                        @endif
                                    @else
                                        <x-button type="button" disabled>Out of Stock</x-button>
                                    @endif
                                </div>
                            @endauth
                        </header>
                    </article>
                    <!-- END Article -->
                </div>
                <!-- END Column -->
            @endforeach
        </div>
    </div>
@endsection
