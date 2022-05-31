<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $page_title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ $page_title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-city"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Number of Departments</span>
                      <span class="info-box-number">{{$count_department}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                
                <!-- /.col -->
      
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
      
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Number of User in college</span>
                      <span class="info-box-number">{{$count_all_users_college}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
              </div>
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('All College') }} </h3>
                            <div class="card-tools">
                                <!-- Collapse Button -->
                                @can('add college')
                                <a href="{{ route('university.college.add') }}"
                                    class="btn btn-block btn-outline-primary">{{ __('Add College') }}</a>
                                @endcan
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('College') }}</th>
                                        <th>{{ __('College Number') }}</th>
                                        <th>{{ __('Dean College') }}</th>
                                        
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($colleges as $college)
                                        <tr>
                                            <td></td>
                                            <td>{{ $college->name }}</td>
                                            <td>{{ $college->college_number }}</td>
                                            <td>{{ $college->user->name }}</td>

                                            <td>
                                                @can('edit college')
                                                <a href="{{ route('university.college.edit', $college->id) }}"
                                                    type="button" class="btn btn-outline-warning"><i
                                                        class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('delete college')
                                                <a href="{{ route('university.college.delete', $college->id) }}"
                                                    type="button" class="btn btn-outline-danger"><i
                                                        class="fas fa-trash"></i></a>
                                                @endcan
                                                        
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
            </div> --}}
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>


