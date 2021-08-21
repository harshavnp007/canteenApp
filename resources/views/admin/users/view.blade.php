@extends('admin.layout')

@section('title', 'All Users')

@section('admin.content')
    <div class="w-full flex justify-between p-4 bg-white border-b border-gray-200 rounded-t-md dark:bg-gray-700">
        <p class="font-bold dark:text-gray-200">
            {{$user->name}}
        </p>
        <p>Wallet Balance: <i class="fa fa-rupee"></i> {{$wallet->total_amount}}</p>
    </div>
    <div class="p-4">
        <table class="w-full dark:text-gray-200">
            <thead>
            <tr class="hidden lg:table-row border-b">
                <th class="text-left px-4 py-2 w-1/4">
                    Amount
                </th>
                <th class="text-left px-4 py-2 w-1/4">
                    Credit/Debit
                </th>
                <th class="text-left px-4 py-2 w-1/4">
                    Order Number/Rzp Id
                </th>
                <th class="text-left px-4 py-2 w-1/4">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($walletDetails as $walletDetail)
                @if ($loop->odd)
                    <tr class="hover:bg-green-700 hover:bg-opacity-10">
                @else
                    <tr class="bg-green-700 bg-opacity-5 hover:bg-opacity-10">
                @endif
                        <td class="block lg:table-cell px-4 py-2">
                            <i class="fa fa-rupee"></i> {{ $walletDetail->amount }}
                        </td>
                        <td class="block lg:table-cell px-4 py-2">
                            {{ $walletDetail->credited ? 'Created' : 'Debited' }}
                        </td>
                        <td class="block lg:table-cell px-4 py-2 {{ !$walletDetail->credited ? 'text-red-400' : ''}}">
                            {{ $walletDetail->credited ? $walletDetail->rzp_id : $walletDetail->common_order_number }}
                        </td>
                        <td class="block lg:table-cell px-4 py-2">
                            {{\Carbon\Carbon::parse($walletDetail->created_at)->format('d-m-Y')}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="bg-gray-300 h-24 d-block">

    </div>
    <div class="w-full flex justify-between p-4 bg-white border-b border-gray-200 rounded-t-md dark:bg-gray-700">
        <p class="font-bold dark:text-gray-200">
            Orders
        </p>
        <p>Total Orders: {{$orders->groupBy('common_order_number')->count()}}</p>
    </div>
    <div class="p-4">
        <table class="w-full dark:text-gray-200">
            <thead>
            <tr class="hidden lg:table-row border-b">
                <th class="text-left px-4 py-2 w-1/4">
                    Order Number
                </th>
                <th class="text-left px-4 py-2 w-1/4">
                    Item
                </th>
                <th class="text-left px-4 py-2 w-1/4">
                    Status
                </th>
                <th class="text-left px-4 py-2 w-1/4">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders->groupBy('common_order_number') as $common_order_number=>$commonOrder)
                <tr class="bg-red-800 bg-opacity-5 hover:bg-opacity-10">
                   <td colspan="3">{{$common_order_number}}</td>
                   <td><i class="fa fa-rupee"></i>{{$commonOrder->first()->total_price}}</td>
                </tr>
                @foreach($commonOrder as $order)
                    @if ($loop->odd)
                        <tr class="hover:bg-green-700 hover:bg-opacity-10">
                    @else
                        <tr class="bg-green-700 bg-opacity-5 hover:bg-opacity-10">
                            @endif
                            <td class="block lg:table-cell px-4 py-2">
                                #{{ $order->order_number }}
                            </td>
                            <td class="block lg:table-cell px-4 py-2">
                                {{ $order->meal->name }}  ({{ $order->qty }})
                            </td>
                            <td class="block lg:table-cell px-4 py-2">
                                @if($order->status == 1)
                                   Order Pending
                                @elseif($order->status == 2)
                                    Order Success
                                @elseif($order->status == 3)
                                    Order Rejected
                                @endif
                            </td>
                            <td class="block lg:table-cell px-4 py-2">
                                {{Carbon\Carbon::parse($order->created_at)->format('d-m-Y')}}
                            </td>
                        </tr>
                @endforeach
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection
