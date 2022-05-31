<link href ="/assets/css/app.css" rel = "stylesheet">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">{{__('Home')}}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">



 
      <!-- Language Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" href="#">
            @if (session('lang') == 'en')
                {{ __('English') }}
            @else
                {{ __('Arabic') }}
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
            <a href="{{ url()->current() . '?lang=en' }}"
                class="dropdown-item @if (session('lang') == 'en') active @endif">
                {{ __('English') }}
            </a>
            <a href="{{ url()->current() . '?lang=ar' }}"
                class="dropdown-item @if (session('lang') == 'ar') active @endif">
                {{ __('Arabic') }}
            </a>
        </div>
    </li>
        
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-sign-in-alt"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
                  <!-- Authentication -->
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <i class="fas fa-user-circle"></i>
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
         
         
          
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->