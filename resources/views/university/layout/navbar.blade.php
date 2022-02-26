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



      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 {{__('Notifications')}}</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">{{__('See All Notifications')}}</a>
        </div>
      </li>
      <!-- Language Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            {{-- @if (session('lang')=='en')
            <i class="flag-icon flag-icon-us"></i>
            @else
            <i class="flag-icon flag-icon-eg mr-2"></i>
            @endif --}}
            <i class="flag-icon flag-icon-eg mr-2"></i>
          <i class="flag-icon flag-icon-us"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="" class="dropdown-item active">
            <i class="flag-icon flag-icon-us mr-2"></i> {{__('English')}}
          </a>
          <a href="" class="dropdown-item">
            <i class="flag-icon flag-icon-eg mr-2"></i> {{__('Arabic')}}
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link"data-slide="true" href="#">
         <div class="custom-control  custom-switch" >
          <input type="checkbox" class="custom-control-input" id="customSwitch1" @if ($theme == 'dark-mode')
          checked
          @endif>
          <label class="custom-control-label" for="customSwitch1"></label>
        </div>
        </a>
      </li>
        
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-sign-in-alt"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="" class="dropdown-item">
            <i class="fas fa-user-circle"></i>
            <span class="float-right text-muted text-sm">{{__('Logout')}}</span>
          </a>
         
          
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->