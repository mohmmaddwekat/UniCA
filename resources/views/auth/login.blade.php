<!DOCTYPE html>
<html>
<head>
<link href ="/assets/css/welcome.css" rel = "stylesheet">
<link href ="/assets/css/app.css" rel ="stylesheet">
</head>
    

<body class="bodyLogin">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
            <img src="{{ url('/assets/img/background3.jpeg') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
                <a class="navbar-brand" href="#page-top">UniCA</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                    @auth
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/login') }}">{{ __('Dashboard') }}</a></li>

                    @else
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/login') }}">{{ __('Log In') }}</a></li>

                        @if (Route::has('student.register'))
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/') }}">{{ __('Home Page') }}</a></li>
                        @endif
                    @endauth
                        @endif
                    </ul>
                </div>
            </div>
    </nav>
<!-- Masthead-->
<br><br><br><br><br>
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
            <div class="flex">
                @if (Route::has('student.register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('student.register') }}">
                        {{ __('Register') }}
                    </a>
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
</html>