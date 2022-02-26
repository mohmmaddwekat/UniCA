
   
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$page_title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Home')}}</a></li>
              <li class="breadcrumb-item active">{{$page_title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card " >
              <div class="card-header">
                <h3 class="card-title">{{__('All Actors')}} </h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    @if (auth('admin')->user()->can('create','App/Models/Admin/Actor'))
                        <a href="{{route('admin.actor.add')}}" class="btn btn-block btn-outline-primary">{{__('Add Actor')}}</a>
                    @endif
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                 <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Movies')}}</th>
                            <th>{{__('Series')}}</th>
                            <th>{{__('Jobs')}}</th>
                            <th>{{__('Image')}}</th>
                            <th>{{__('Birthday')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                      @foreach ($actors as $actor)
                      @php  
                        $orgDate = $actor->birthday;  
                        $createDate = new DateTime($orgDate);
                        $newDate = $createDate->format('Y-m-d');
                      @endphp
                          <tr>
                            <td></td>
                            <td>{{$actor->name}}</td>
                            <td>@foreach ($actor->movies as $movie)
                                <span>{{$movie->name}},</span>
                            @endforeach</td>
                            <td>@foreach ($actor->series as $oneSeries)
                                <span>{{$oneSeries->name}},</span>
                            @endforeach</td>
                            <td>@foreach ($actor->job as $oneJob)
                                <span>{{$oneJob->name}},</span>
                            @endforeach</td>
                            <td>
                              @if ($actor->image)
                                  <img src="{{url("/assets/uploads/$actor->image")}}" alt="" srcset="" width="70px" height="100px"></td>
                              @else
                                  <img src="{{url("/assets/img/image-placeholder.png")}}" alt="" srcset="" width="70px" height="100px"></td>
                              @endif
                            <td>{{$newDate}}</td>
                             <td>
                               
                              @if (auth('admin')->user()->can('update',$actor))
                                  <a href="{{route('admin.actor.edit',$actor->id)}}" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                              @endif 
                              @if (auth('admin')->user()->can('delete',$actor))                            
                                <a href="{{route('admin.actor.delete',$actor->id)}}" type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                              @endif  
                            </td>
                        </tr>
                      @endforeach
                        
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>


