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
      <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    @if (session('lang') == 'en')
                {{ __('English') }}
            @else
                {{ __('Arabic') }}
            @endif
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="#">
    </a></li>
    <li><a class="dropdown-item" href="#"><a href="{{ url()->current() . '?lang=en' }}"
                class="dropdown-item @if (session('lang') == 'en') active @endif">
                {{ __('English') }}
            </a></li>
            <a href="{{ url()->current() . '?lang=ar' }}"
                class="dropdown-item @if (session('lang') == 'ar') active @endif">
                {{ __('Arabic') }}
            </a>
  </ul>
</div>

      
      {{-- <li class="nav-item">
        <a class="nav-link"data-slide="true" href="#">
         <div class="custom-control  custom-switch" >
          <input type="checkbox" class="custom-control-input" id="customSwitch1" @if ($theme == 'dark-mode')
          checked
          @endif>
          <label class="custom-control-label" for="customSwitch1"></label>
        </div>
        </a>
      </li> --}}
        
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