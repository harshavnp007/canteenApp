@extends('layouts.app')

@section('content')
<div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700">
    <div class="w-full p-4 border-b border-gray-200">
        <p class="font-bold dark:text-gray-200">
            Create New Meal
        </p>
    </div>
    <div class="p-3">
        @foreach($errors->all() as $error)
            <span class="text-xl">{{$error}}</span>
        @endforeach
        <form action="{{secure_url('recipes')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                    <label for="name" class="dark:text-gray-200 self-center">
                        Name
                    </label>
                    <div class="w-full md:col-span-4">
                        <input type="text" name="name" id="name" value="{{ Request::old('name') }}" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
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
                        <input type="checkbox" name="stocks" id="stocks" checked class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-20 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
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
                        <input type="number" min="1" name="price" id="price" value="{{ Request::old('price') }}" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                        @error('price')
                            <p class="text-red-500 italic text-xs font-light">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                    <label for="image" class="dark:text-gray-200 self-top">
                        Image
                    </label>
                    <div class="w-full md:col-span-4">
                        <input type="file" name="image">
                    </div>
                    </div>
                </div>

                <div class="md:space-y-2">
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
                            <input type="time" name="timing_from" id="timing_from" >
                        </label>
                        <label for="timing_to">
                            <span class="block">Ends At</span>
                            <input type="time" name="timing_to" id="timing_to" >
                        </label>
                    </div>
                </div>
                <div class="md:space-y-2">
                    <label for="instruction" class="dark:text-gray-200 self-center">
                        Description
                    </label>
                    <div>
                        <textarea name="description" id="instruction" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full h-64 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">{!! old('instruction') !!}</textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full lg:w-auto rounded shadow-md py-2 px-4 bg-green-700 text-white hover:bg-green-500">
                        Add Meal
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
