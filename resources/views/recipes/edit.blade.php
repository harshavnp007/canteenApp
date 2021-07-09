@extends('layouts.app')

@section('content')
    <div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700">
        <div class="w-full p-4 border-b border-gray-200">
            <p class="font-bold dark:text-gray-200">
                Edit Meal
            </p>
        </div>
        <div class="p-3">
            @foreach($errors->all() as $error)
                <span class="text-xl">{{$error}}</span>
            @endforeach
            <form action="{{secure_url('recipes/'.$meal->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="space-y-4">
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="name" class="dark:text-gray-200 self-center">
                            Name
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="text" name="name" id="name" value="{{ $meal->name }}" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                            @error('name')
                            <p class="text-red-500 italic text-xs font-light">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="stocks" class="dark:text-gray-200 self-center">
                            Stock Available?
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="checkbox" name="stocks" id="stocks" {{ $meal->stocks ? 'checked' : ''}} class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-20 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                            @error('stocks')
                            <p class="text-red-500 italic text-xs font-light">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="price" class="dark:text-gray-200 self-center">
                            Price per meal
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="number" min="1" name="price" id="price" value="{{ $meal->price }}" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                            @error('price')
                            <p class="text-red-500 italic text-xs font-light">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div class=" md:space-x-6">
                        @if ($meal->getMedia()->count() > 0)
                            <div class="w-full h-full rounded-xl">
                                <img src="{{ $meal->getFirstMediaUrl() }}" alt="">
                            </div>
                        @endif

                        <label for="image" class="dark:text-gray-200 self-top">
                            Image
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="file" name="image">
                        </div>
                    </div>
                </div>

                <div class="md:space-y-2 mt-10">
                    <label class="dark:text-gray-200 self-center">
                        Available Between
                    </label>
                    @error('timing_from')
                    <p class="text-red-500 italic text-xs font-light">
                        {{ $message }}
                    </p>
                    @enderror
                    <div class="flex space-x-4">
                        <label for="timing_from">
                            <span class="block">Starts From</span>
                            <input type="time" name="timing_from" id="timing_from" value="{{$meal->timing_from}}">
                        </label>
                        <label for="timing_to">
                            <span class="block">Ends At</span>
                            <input type="time" name="timing_to" id="timing_to" value="{{$meal->timing_to}}">
                        </label>
                    </div>
                </div>
                <div class="md:space-y-2">
                    <label for="instruction" class="dark:text-gray-200 self-center">
                        Description
                    </label>
                    <div>
                        <textarea name="description" id="instruction" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full h-64 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">{!! $meal->description !!}</textarea>
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="w-full lg:w-auto rounded shadow-md py-2 px-4 bg-green-700 text-white hover:bg-green-500">
                        Update Meal
                    </button>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function changeLevel($current)  {
            switch($current) {
                case 'no':
                    return 'may';
                    break;
                case 'may':
                    return 'yes';
                    break;
                case 'yes':
                    return 'no';
                    break;
            }
        }
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#instruction' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', '|',  'undo', 'redo', '|', 'bulletedList', 'numberedList' ],
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
