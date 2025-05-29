<x-guest-layout>
<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('Nhập OTP xác thực tài khoản') }}
</div>

<form method="POST" action="{{ route('verify.store') }}">
    @csrf

    <div>
        <x-input-label for="code" :value="__('Mã OTP')" />
        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus />
        <x-input-error :messages="$errors->get('code')" class="mt-2" />
    </div>

    <div class="flex justify-end mt-4">
        <x-primary-button>
            {{ __('Xác nhận') }}
        </x-primary-button>
    </div>
</form>
</x-guest-layout>
