<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('student.registerform')}}">{{__('Profile')}}</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <div class="card-tools">
              <!-- Collapse Button -->
              <a href="{{route('student.registerform')}}" class="btn btn-block btn-outline-secondary">{{__('back')}}</a>
          </div>
          @if (session('error'))
          <div class="alert alert-danger alert-dismissible">    
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-ban"></i>{{__('Error')}}</h5>
            {{session('error')}} 
          </div>
        @endif
        @if (session('success'))        
          <div class="alert alert-success alert-dismissible">    
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>{{__('Success')}}</h5>
            {{session('success')}} 
          </div>
        @endif
        </div>
    
        <form action="{{ route('student.register.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @include('student.register',[
        ])
    </form>
      </div>
    </div>
  </section>
</div>
                            

