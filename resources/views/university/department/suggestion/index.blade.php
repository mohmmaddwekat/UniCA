
   
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
              <li class="breadcrumb-item"><a href="">{{__('Home')}}</a></li>
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
                <h3 class="card-title">{{__('All Departments')}} </h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                        <a href="{{route('university.department.add')}}" class="btn btn-block btn-outline-primary">{{__('Add Department')}}</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                 <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Head of Department')}}</th>
                            <th>{{__('College')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                      @foreach ($departments as $department)
                      @php  
                        $orgDate = $department->birthday;  
                        $createDate = new DateTime($orgDate);
                        $newDate = $createDate->format('Y-m-d');
                      @endphp
                          <tr>
                            <td></td>
                            <td>{{$department->name}}</td>
                            <td>{{$department->head_of_department}}</td>
                            <td>{{$department->college->name}}</td>
                             <td>
                               
                                <a href="{{route('university.department.edit',$department->id)}}" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a> 
                                <a href="{{route('university.department.delete',$department->id)}}" type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
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


