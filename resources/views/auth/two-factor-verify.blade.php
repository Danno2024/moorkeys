<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Two-Factor Authentication</h2>
        <p class="text-gray-600 mt-2">Enter the 6-digit code from your authenticator app.</p>
    </div>
    <form method="POST" action="{{ route('2fa.verify') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Authentication Code</label>
            <input type="text" name="code" maxlength="6" inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-center text-2xl tracking-widest" required>
            @error('code')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">Verify</button>
    </form>
    <p class="text-center mt-4"><a href="{{ route('2fa.recovery') }}" class="text-sm text-indigo-600 hover:underline">Use a recovery code instead</a></p>
</x-guest-layout>
