<!DOCTYPE html>
<html>
<head>
<link href ="/assets/css/welcome.css" rel = "stylesheet">
<link href ="/assets/css/app.css" rel ="stylesheet">
</head>

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
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/student-register') }}">{{ __('Register') }}</a></li>

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
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="loginLogo" src="/assets/img/background3.jpeg"></img>
            </a>
        </x-slot>



        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register.password.email') }}">
            <a href="/"><- {{ __('Back') }}</a>
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <br>
            <div class="flex">
                <x-button class="ml-3 text-light">
                    <span class=" text-light">{{ __('Register') }}</span>
                </x-button>
                
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
</html>