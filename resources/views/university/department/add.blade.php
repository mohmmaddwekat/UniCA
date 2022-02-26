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
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.actor.index')}}">{{__('Actor')}}</a></li>
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
                <a href="{{route('admin.actor.index')}}" class="btn btn-block btn-outline-secondary">{{__('back')}}</a>
            </div>
          </div>
          <form class="needs-validation" action="{{route('admin.actor.save')}}" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
              
          @if ($errors->any())
              @foreach ($errors as $error)
                  {{$error}}
              @endforeach
          @else
              
          @endif
          
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputName1">{{__('Name Actor')}}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="exampleInputName1" placeholder="{{__('Enter Name')}}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message }}
                        </div>
                    @enderror
                    
                </div>
                <div class="form-group">
                  <label>{{__('Movies')}}</label>
                  <select class="form-control  selectpicker @error('movies') is-invalid @enderror" name="movies[]" multiple data-selected-text-format="count" data-live-search="true">
                    @foreach ($movies as $movie)
                        <option value="{{$movie->id}}"@if (old('movies')&& in_array($movie->id,old('movies')))
                          selected
                        @endif>{{$movie->name}}</option>
                    @endforeach
                  </select>
                  @error('movies')
                        <div class="invalid-feedback">
                            {{$message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label>{{__('Series')}}</label>
                  <select class="form-control  selectpicker @error('series') is-invalid @enderror" name="series[]" multiple data-selected-text-format="count" data-live-search="true">
                    @foreach ($series as $oneSeries)
                      <option value="{{$oneSeries->id}}"@if (old('series')&& in_array($oneSeries->id,old('series')))
                          selected
                        @endif>{{$oneSeries->name}}</option>
                    @endforeach
                  </select>
                  @error('series')
                        <div class="invalid-feedback">
                            {{$message }}
                        </div>
                    @enderror
                </div>
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputFile">{{__('Image')}}</label>
                    <div class="input-group">
                        <input type="file" name="image" accept="image/*" onchange="readURL(this);" class="custom-file-input  @error('image') is-invalid @enderror" id="exampleInputFile">
                        <label class="path custom-file-label" for="exampleInputFile">{{__('Choose Image')}}</label> 
                        @error('image')
                            <div class="invalid-feedback">
                                {{$message }}
                            </div>
                        @enderror
                    </div>
                    <img id="blah" src="#" alt="" width="70px" height="100px" />
                </div>
                <div class="form-group">
                  <label>{{__('Jobs')}}</label>
                  <select class="form-control  selectpicker @error('jobs') is-invalid @enderror" name="jobs[]" multiple data-selected-text-format="count" data-live-search="true">
                    @foreach ($jobs as $job)
                        <option value="{{$job->id}}"@if (old('jobs')&& in_array($job->id,old('jobs')))
                          selected
                        @endif>{{$job->name}}</option>
                    @endforeach
                  </select>
                  @error('jobs')
                        <div class="invalid-feedback">
                            {{$message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label>{{__('Birthday')}}</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input id="datepicker" type="date"  data-date-format="mm-dd-yyyy"  class="form-control datepicker @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" id="exampleInputName1" required>
                    @error('birthday')
                        <div class="invalid-feedback">
                            {{$message }}
                        </div>
                    @enderror 
                  </div>
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