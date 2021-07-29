<div class="flex flex-col lg:flex-row lg:space-x-6">
    <div class="flex w-full lg:w-4/5 order-2 lg:order-1">
    @if($meals->count() > 0)
    @foreach($meals as $meal)
        <!-- Column -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/2">
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
    {{ $meals->links() }}
    @else
        <div class="text-center text-xl font-bold">
            Sorry no matching food found...
        </div>
    @endif
    </div>
    <div class="w-full lg:w-1/5 order-1 mb-3 lg:mb-0" x-data="{open: false}">
        <div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700">
            <div class="flex justify-between p-4 border-b border-gray-200">
                <p class="font-bold dark:text-gray-200 self-center">
                    Filter
                </p>
                <div class="lg:hidden">
                    <button class="border border-gray-100 px-2 pt-1 rounded-lg dark:text-gray-200" @click="open = !open">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <hr>
            <div class="px-4 py-2">
                <label for="price">Price</label>
                <select name="price_filter" id="price" wire:model="price_filter" class="w-full border-gray-500 rounded">
                    <option value="0">Choose an Option</option>
                    <option value="desc">High to low</option>
                    <option value="asc">Low to High</option>
                </select>
            </div>
            <hr>
            <div class="px-4 py-2">
                <label for="price">Category</label>
                <select name="" id="price" wire:model="filter_category" class="w-full border-gray-500 rounded">
                    <option value="0">Choose an Option</option>
                    @foreach(\App\Models\Meal::$categories as $label=>$category)
                        <option value="{{$category}}">{{$label}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
