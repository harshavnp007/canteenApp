<div class="flex flex-col lg:flex-row lg:space-x-6">
    <div class="w-full lg:w-4/5 order-2 lg:order-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-5">
            @foreach ($meals as $meal)
                <a href="{{ secure_url('recipes/'.$meal->id) }}">
                    <div class="w-full h-full rounded-md shadow-md bg-white dark:bg-gray-700">
                        <div>
                            @if ($meal->getMedia()->count() > 0)
                                <img src="{{ $meal->getFirstMediaUrl('default', 'thumb') }}" class="w-full h-32 object-cover rounded-t-md" alt="{{ $meal->name }}">
                            @else
                                <img src="https://via.placeholder.com/640x360.png?text=No+Image" class="w-full max-h-32 object-cover rounded-t-md" alt="No image available">
                            @endif
                        </div>
                        <div class="p-4 rounded-b-md dark:text-gray-200 space-y-2">
                            <p>
                                {{ $meal->name }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        {{ $meals->links() }}
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
        </div>
    </div>
</div>
