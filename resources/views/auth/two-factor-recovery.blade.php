<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Recovery Code</h2>
        <p class="text-gray-600 mt-2">Enter one of your recovery codes.</p>
    </div>
    <form method="POST" action="{{ route('2fa.recovery.verify') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Recovery Code</label>
            <input type="text" name="recovery_code" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-center" required>
            @error('recovery_code')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">Verify</button>
    </form>
</x-guest-layout>
