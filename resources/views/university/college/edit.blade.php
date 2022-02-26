  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$page_title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">{{__('Home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('university.college.index')}}">{{__('College')}}</a></li>
              <li class="breadcrumb-item active">{{$page_title}}</li>
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
                <a href="{{route('university.college.index')}}" class="btn btn-block btn-outline-secondary">{{__('back')}}</a>
            </div>
          </div>
          <form class="needs-validation" action="{{route('university.college.update',$college->id)}}" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->  
          @if ($errors->any())
              @foreach ($errors as $error)
                  {{$error}}
              @endforeach             
          @endif
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputName1">{{__('Name College')}}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$college->name) }}" id="exampleInputName1" placeholder="{{__('Enter Name')}}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message }}
                        </div>
                    @enderror
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputName1">{{__('College Number')}}</label>
                    <input type="text" class="form-control @error('college_number') is-invalid @enderror" name="college_number" value="{{ old('college_number',$college->college_number) }}" id="exampleInputName1" placeholder="{{__('Enter College Number')}}" required>
                    @error('college_number')
                        <div class="invalid-feedback">
                            {{$message }}
                        </div>
                    @enderror
                </div>
              </div>          
            </div>
            <!-- /.row -->
            <!-- /.row -->
          </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
          </div>
          </form>
        </div>
      </div>
    </section>
  </div>