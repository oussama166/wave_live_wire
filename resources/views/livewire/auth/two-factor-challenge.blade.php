<div class="max-w-md h-screen mx-auto  flex items-center justify-center">
    <form wire:submit.prevent="authenticate" class="space-y-6 max-w-2xl bg-white shadow-md rounded-lg p-6">
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700">
                Two-Factor Authentication Code
            </label>
            <input
                wire:model="code"
                id="code"
                type="text"
                required
                autofocus
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Enter your 2FA code"
            >
            @error('code')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                Authenticate
            </button>
        </div>
    </form>
</div>
