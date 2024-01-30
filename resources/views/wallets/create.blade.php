<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Wallet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('wallets.store') }}" method="post" class="space-y-4">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-600">Wallet Name</label>
                            <input type="text" class="form-input mt-1 block w-full border rounded-md p-2" id="name" name="name" required>
                        </div>

                        <div class="mb-4">
                            <label for="currency_code" class="block text-sm font-medium text-gray-600">Currency</label>
                            <select name="currency_code" id="currency_code" class="mt-1 p-2 border rounded-md w-full">
                                <!-- Add options for currencies dynamically if needed -->
                                <option value="USD">US Dollar</option>
                                <option value="EUR">Euro</option>
                                <option value="JPY">Japanese Yen</option>
                                <option value="GBP">British Pound Sterling</option>
                                <option value="CHF">Swiss Franc</option>
                            </select>
                        </div>

                        <!-- Add other form fields here -->

                        <div>
                            <button type="submit" class="bg-blue-200 text-black rounded-md px-4 py-2 hover:bg-blue-400">Create Wallet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
