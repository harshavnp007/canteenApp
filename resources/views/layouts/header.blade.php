<header class="lg:fixed">
    <div class="w-full bg-green-700 p-3 text-white lg:w-72 lg:h-screen" x-data="{open: false}">
        <div class="flex justify-between items-center lg:mb-20 lg:mt-10">
            <a href="{{ route('homepage') }}" class="flex text-lg font-bold lg:text-center lg:w-full lg:flex-col">
                <i class="fas fa-pizza-slice pr-3 self-center lg:pr-0 lg:text-3xl lg:pb-3"></i>
                {{env('APP_NAME') ?? 'DS BOJANA'}}
            </a>
            <div class="text-lg lg:hidden">
                <button class="border border-gray-100 px-2 rounded-lg duration-300 ease-in-out transition text-center hover:bg-white hover:text-green-700" @click="open = !open" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="hidden lg:block mt-3" x-bind:class="{'hidden': !open}" @click.away="open = false">
            <nav class="flex flex-col">
                <a
                    href="{{ route('homepage') }}"
                    @if (request()->routeIs('homepage*'))
                        class="w-full p-3 mb-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                    @else
                        class="w-full p-3 mb-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2"
                    @endif
                >
                    <i class="fas fa-home"></i>
                    <span>
                        Home
                    </span>
                </a>
                <a href="{{\Illuminate\Support\Facades\Auth::user()->hasRole('User') ? route('recipes.index') : route('adminRecipe') }}"
                    @if (request()->routeIs('recipes*') || request()->is('admin-recipe'))
                        class="w-full p-3 mb-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                    @else
                        class="w-full p-3 mb-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2"
                    @endif
                >
                    <i class="fas fa-hamburger"></i>
                    <span>
                        Meals
                    </span>
                </a>
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('User'))
                <a
                    href="{{ secure_url('cart') }}"
                    @if (request()->is('cart'))
                    class="w-full p-3 mb-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                    @else
                    class="w-full p-3 mb-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2"
                    @endif
                >
                    <span class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 mr-2 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span>
                            Your Basket
                        </span>
                    </span>
                </a>
                @endif
                @can('meal_create')
                    @if (request()->routeIs('adminRecipe'))
                        <a
                            href="{{ route('recipes.create') }}"
                            @if (request()->routeIs('recipes.create'))
                                class="w-full py-2 pl-8 pr-3 mb-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                            @else
                                class="w-full py-2 pl-8 pr-3 mb-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2"
                            @endif
                        >
                            <i class="fas fa-plus"></i>
                            <span>
                                Create Meal
                            </span>
                        </a>
                    @endif
            
                @endcan
                @can ('admin_access')
                <a
                        href="{{ route('admin.dashboard') }}"
                        @if (request()->routeIs('admin'))
                            class="w-full p-3 mb-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                        @else
                            class="w-full p-3 mb-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2"
                        @endif
                    >
                        <i class="fas fa-tachometer-alt"></i><span>
                            Statistics
                        </span>
                    </a>
       
                @endcan
            </nav>
            <div class="w-full font-bold lg:hidden" x-data="{ open: false }" @click.away="open = false">
                <div class="flex justify-between p-3 items-center" @click="open = !open">
                    <p>
                        {{ Auth::user()->name }}
                    </p>
                    <button aria-label="Profile Menu">
                        <i
                            class="fas text-center cursor-pointer"
                            :class="{ 'fa-angle-down': !open, 'fa-angle-up': open }"
                        ></i>
                    </button>
                </div>
                <div class="w-full font-bold text-green-700 bg-white rounded-lg space-x-2" :class="{ 'hidden': !open }">
                    <div class="flex flex-col text-left">
                        <a href="{{ route('profile') }}" class="px-3 py-2">
                            Profile
                        </a>
                        <a href="{{ route('profile.settings.account') }}" class="px-3 py-2">
                            Settings
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-2 font-bold w-full text-left" aria-label="Logout">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
