<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="text-center mb-3">
                <h6 class="text-gray-600 text-lg font-bold">Sign in with</h6>
            </div>
            <div class="flex justify-center mt-4">
                <a href="{{ route('social.oauth', 'google') }}" class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs">
                    <img src="{{ asset('/assets/images/auth/google.svg') }}" alt="google" class="w-5 mr-1">
                    Google
                </a>
                <a href="#" class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs">
                    <img src="{{ asset('/assets/images/auth/twitter.svg') }}" alt="google" class="w-5 mr-1">
                    Twitter
                </a>
            </div>
            <div class="text-gray-600 text-center mt-3 text-lg font-bold">Or Sign in with credentials</div>
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>

        <!-- Register Page Link -->
        <div class="text-center mt-3">
            @if(Route::has('register'))
                <a href="{{ route('register') }}">
                    {{ __("Don't have an account?") }}
                </a>
            @endif
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
