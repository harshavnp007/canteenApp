@extends('admin.layout')

@section('title', 'All Users')

@section('admin.content')
<div class="w-full p-4 bg-white border-b border-gray-200 rounded-t-md dark:bg-gray-700">
    <p class="font-bold dark:text-gray-200">
        All Users
    </p>
</div>
<div class="p-4">
    <table class="w-full dark:text-gray-200">
        <thead>
            <tr class="hidden lg:table-row border-b">
                <th class="text-left px-4 py-2 w-1/3">
                    Name
                </th>
                <th class="text-left px-4 py-2 w-1/3">
                    Email
                </th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($loop->odd)
                    <tr class="hover:bg-green-700 hover:bg-opacity-10">
                @else
                    <tr class="bg-green-700 bg-opacity-5 hover:bg-opacity-10">
                @endif
                    <td class="block lg:table-cell px-4 py-2">
                        {{ $user->name }}
                    </td>
                    <td class="block lg:table-cell px-4 py-2">
                        {{ $user->email }}
                    </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection