<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Edit Name') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden p-6">
                <form method="post" action="{{ route('wallets.update', $wallet) }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-600">New Wallet Name</label>
                        <input type="text" class="form-input mt-1 p-2 border rounded-md w-full" id="name" name="name" value="{{ $wallet->name }}" required>
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-200 text-black rounded-md px-4 py-2 hover:bg-blue-600">Update Wallet Name</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
