<link href ="/assets/css/app.css" rel ="stylesheet">

<body class="bodyLogin">
<div class="loginContainer">
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="loginLogo" src="/assets/img/background3.jpeg"></img>
            </a>
        </x-slot>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="m-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

                        <!-- type_username_id Address -->
                        <div>
                            <x-label for="id" :value="__('key')" />
                            <x-input id="key" class="block mt-1 w-full" type="text" name="key" :value="old('key')" required autofocus />
                        </div>

            <!-- type_username_id Address -->
            <div>
                <x-label for="id" :value="__('Id')" />
                <x-input id="type_username_id" class="block mt-1 w-full" type="text" name="type_username_id" :value="old('type_username_id')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>
            </div>
            <br>

            <div class="flex">
                @if (Route::has('student.register'))
                <x-button class="ml-3">
                    <a href="{{ route('student.register') }}">
                        {{ __('Register') }}
                    </a>
                </x-button>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
</div>
</body>
