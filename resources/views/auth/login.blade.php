<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div style="display: flex;">
            <div style="width:50%; text-align: center; background-color:rgb(229, 89, 34); margin-top:20px">
                <a href="{{ url('auth/google') }}">Continue with Google</a>
            </div>
            
            <div style="width:50%; text-align: center; background-color:rgb(47, 14, 212); margin-top:20px">
                <a href="{{ url('auth/facebook') }}">Login with Facebook</a>
            </div>
        </div>

        <div style="display: flex;">
            <div style="width:50%; text-align: center; background-color:rgb(187, 210, 219); margin-top:20px">
                <a href="{{ url('auth/github') }}">Login with Github</a>
            </div>
            <div style="width:50%; text-align: center; background-color:rgb(3, 87, 120); margin-top:20px">
                <a href="{{ url('auth/linkedin') }}">Login with LinkedIn</a>
            </div>
        </div>
        <div style="text-align: center; background-color:rgb(5, 120, 166); margin-top:20px">
            <a href="{{ url('auth/facebook') }}">Login with Twitter</a>
        </div>
    </form>
    {{--  <div class="text-center my-4">
        <hr class="my-2">
        <span class="text-center font-bold">Or</span>
        <div class="w-3/5 mx-auto mt-4">
            <a href="{{ route('google-auth') }}">
                <span class="text-sm text-left ml-4">Continue with Google</span>
            </a>
        </div>
    </div>  --}}
</x-guest-layout>
