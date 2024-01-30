<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transfer Money') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('transaction.store') }}" method="post">
                        @csrf

                        <div class="mb-4">
                            <label for="from_wallet_id" class="block text-sm font-medium text-gray-600">From Account</label>
                            <select name="from_wallet_id" id="from_wallet_id" class="mt-1 p-2 border rounded-md w-full">
                                <!-- Add options for source accounts dynamically -->
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}">({{ $wallet->balance }} {{ $wallet->currency_code }} {{ $wallet->name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="to_wallet_id" class="block text-sm font-medium text-gray-600">To Account</label>
                            <select name="to_wallet_id" id="to_wallet_id" class="mt-1 p-2 border rounded-md w-full">
                                <!-- Add options for destination accounts dynamically -->
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}">({{ $wallet->balance }} {{ $wallet->currency_code }} {{ $wallet->name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-600">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="mt-1 p-2 border rounded-md w-full">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-200 text-black rounded-md px-4 py-2">Transfer Money</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
