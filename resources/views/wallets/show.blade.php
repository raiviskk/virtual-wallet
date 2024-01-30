<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Wallet Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Back to Wallets Button -->
                <div class="p-6 justify-between items-center bg-gray-100 border-b border-gray-200">
                    <a href="{{ route('wallets.index') }}" class="text-blue-600 hover:underline">Back to Wallets</a>
                </div>

                <!-- Account Information Section -->
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <div>
                        <p class="text-gray-700 text-lg mb-2">
                            <span class="font-semibold">Wallet name:</span> {{ $wallet->name }}
                        </p>
                        <p class="text-gray-700 text-lg mb-2">
                            <span class="font-semibold">Balance:</span> {{ $wallet->balance }} {{ $wallet->currency_code }}
                        </p>

                        <!-- Edit Wallet Name Button -->
                        <a href="{{ route('wallets.edit', $wallet) }}" class="btn btn-primary border rounded-md px-2 py-1 bg-blue-200">Edit Wallet Name</a>

                        <!-- Delete Wallet Form -->
                        <form method="post" action="{{ route('wallets.destroy', $wallet) }}" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger border rounded-md px-2 py-1 bg-red-400" onclick="return confirm('Are you sure you want to delete this wallet?')">Delete Wallet</button>
                        </form>
                    </div>
                </div>

                <!-- Transactions Section -->
                <div class="p-6 mt-4">
                    <h3 class="text-xl font-semibold mb-6 flex justify-between items-center">
                        <span>Transactions</span>
                        <span class="flex items-center space-x-2">
                            <span class="bg-green-200 p-2 rounded-md">
                                Total In: {{ $wallet->transactions->where('direction', 'in')->sum('amount') }} {{ $wallet->currency_code }}
                            </span>
                            <span class="bg-red-200 p-2 rounded-md">
                                Total Out: {{ $wallet->transactions->where('direction', 'out')->sum('amount') }} {{ $wallet->currency_code }}
                            </span>
                        </span>
                    </h3>
                    <div class="divide-y divide-gray-300">
                        @foreach ($wallet->transactions->reverse() as $transaction)
                            <!-- Transaction Entry -->
                            <div class="py-4 @if($transaction->fraudulent) bg-red-200 @endif">
                                <p class="text-gray-700 text-lg mb-1">
                                    <span class="font-semibold">Amount:</span> {{ $transaction->amount }} {{ $wallet->currency_code }}
                                    <span class="font-semibold">Direction:</span> {{ $transaction->direction }}
                                </p>
                                <p class="text-gray-600"><span class="font-semibold">When:</span> {{ $transaction->timestamp }}</p>

                                <!-- Delete Transaction Form -->
                                <form method="post" action="{{ route('transactions.destroy', $transaction) }}" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger border rounded-md px-2 py-1 bg-red-400 text-sm" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete Transaction</button>
                                </form>

                                <!-- Mark as Fraudulent Form -->
                                <form method="post" action="{{ route('transactions.markAsFraudulent', $transaction) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger border rounded-md px-2 py-1 bg-red-400 text-sm" onclick="return confirm('Are you sure you want to mark this transaction as fraudulent?')">Mark as Fraudulent</button>
                                </form>

                                <!-- Display message for fraudulent transaction -->
                                @if($transaction->fraudulent)
                                    <p class="text-red-600 font-semibold mt-2">This transaction is marked as fraudulent.</p>
                                @endif
                            </div>

                            <!-- Light line between transactions -->
                            <div class="border-t border-gray-300"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
