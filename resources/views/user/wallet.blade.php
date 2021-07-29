@extends('user.profile.layout')

@section('user.content')
    <div class="bg-white rounded-md dark:bg-gray-700" x-data="{showAmount:false,amount:0}">
        <div class="w-full p-4 border-b border-gray-200 ">
            <p class="font-bold dark:text-gray-200">
                User Wallet
            </p>
        </div>
        <div class="p-4">
            <div class="flex flex-col w-full">
                <div class="flex justify-between">
                    <h3 class="font-bold text-xl mb-6">Balance Amount : {{$wallet->total_amount}} Rs</h3>
                    <div class="flex-inline space-x-4">
                        <div x-show="!showAmount">
                            <button type="button" x-on:click="showAmount = true" class="text-xs bg-blue-400 rounded-lg text-white px-2 py-3">Add Amount</button>
                        </div>
                        <input type="number" x-show="showAmount" min="1" x-model="amount" placeholder="Enter the amount" class="h-8 rounded-lg" name="wallet_amount" id="wallet_amount">
                        <button onclick="runRzp()" x-show="showAmount" x-bind:disabled="amount <= 0" type="button" class="text-xs bg-blue-400 rounded-lg text-white px-2 py-3">Add Amount</button>
                    </div>
                </div>
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sl Num
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Order num / rzp id
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($walletDetails as $detail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                # {{$loop->index}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 {{$detail->credited ? 'text-green-500' : 'text-red-500'}}">Rs. {{$detail->credited ? '+' : '-'}} {{$detail->amount}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{$detail->credited ? $detail->rzp_id : $detail->common_order_number}}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{Carbon\Carbon::parse($detail->created_at)->format('d-m-Y')}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="walletForm" action="{{secure_url('add/wallet/money')}}" method="post">
        @csrf
        <input type="hidden" name="rzp_id" id="rzp_id_input">
        <input type="hidden" name="amount" id="form_wallet_amount">
    </form>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function runRzp(){
            let amountEntered = 0;
            var options = {
                "key": "rzp_test_cQrgAh2ZjZwXPA", // Enter the Key ID generated from the Dashboard
                "amount":  document.getElementById('wallet_amount').value * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "{{env('APP_NAME')}}",
                "description": "Wallet Money",
                "image": "https://example.com/your_logo",
                "handler": function (response){
                    let form = document.getElementById('walletForm');
                    let input = document.getElementById('rzp_id_input');
                    let inputAmount = document.getElementById('wallet_amount');
                    let amountFiled = document.getElementById('form_wallet_amount');
                    input.value = response.razorpay_payment_id
                    amountFiled.value = inputAmount.value
                    form.submit();
                },
                "prefill": {
                    "name": "{{\Illuminate\Support\Facades\Auth::user()->name}}",
                    "email": "{{\Illuminate\Support\Facades\Auth::user()->email}}",
                },
                "notes": {
                    "address": "Deposit money to wallet"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                alert(response.error.code);
                alert(response.error.description);
                alert(response.error.source);
                alert(response.error.step);
                alert(response.error.reason);
                alert(response.error.metadata.order_id);
                alert(response.error.metadata.payment_id);
            });
            rzp1.open();
            e.preventDefault();
        }
    </script>
@endsection
