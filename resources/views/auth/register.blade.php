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
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div>
                <x-label for="type_username_id" :value="__('Id')" />

                <x-input id="type_username_id" class="block mt-1 w-full" type="text" name="type_username_id" :value="old('type_username_id')" required autofocus />
            </div>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <br>

            <div class="flex">
            <x-button class="ml-4">
                <a href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </x-button>
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
</div>
</body>
