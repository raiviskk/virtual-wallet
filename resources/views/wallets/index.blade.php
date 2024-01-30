<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Wallets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse ($wallets as $wallet)
                        <div class="card mb-3 border-2 border-gray-300 rounded p-4">
                            <h5 class="text-xl font-semibold mb-2">{{ $wallet->name }}</h5>
                            <p class="text-gray-600 mb-2">
                                <strong>Balance:</strong> {{ $wallet->balance }} |
                                <strong>Currency:</strong> {{ $wallet->currency_code }} |
                                <strong>Opened At:</strong> {{ $wallet->opened_at }}
                            </p>
                            <p class="text-gray-700 mb-2">
                                <strong>Total Incoming:</strong> {{ $wallet->transactions->where('direction', 'in')->sum('amount') }} {{ $wallet->currency_code }} |
                                <strong>Total Outgoing:</strong> {{ $wallet->transactions->where('direction', 'out')->sum('amount') }} {{ $wallet->currency_code }}
                            </p>

                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('wallets.show', $wallet->id) }}" class="bg-blue-200 text-black px-4 py-2 rounded-md hover:bg-blue-600">More Details</a>

                                <!-- Buttons for actions -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('wallets.edit', $wallet) }}" class="bg-blue-200 text-black px-4 py-2 rounded-md hover:bg-green-600">Edit Name</a>

                                    <form method="post" action="{{ route('wallets.destroy', $wallet) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this wallet?')">Delete Wallet</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info" role="alert">
                            No wallets found for the user.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
