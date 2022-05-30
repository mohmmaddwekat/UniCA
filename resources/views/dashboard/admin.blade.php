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
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-address-book"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Number of Roles</span>
                      <span class="info-box-number">
                        {{$statisticOne}}
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-address-book"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Number of Permission</span>
                      <span class="info-box-number">{{$statisticTwo}}</span>
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
                    <span class="info-box-icon bg-primary elevation-1"><i class="fa-solid fa-city"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Number of University</span>
                      <span class="info-box-number">{{$statisticThree}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Number of other User</span>
                      <span class="info-box-number">{{$statisticFour}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('All University') }} </h3>
                            <div class="card-tools">
                                <!-- Collapse Button -->
                                @can('add universities')
                                <a href="{{ route('admin.universities.create') }}"
                                    class="btn btn-block btn-outline-primary">{{ __('Add University') }}</a>
                                @endcan
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('key') }}</th>
                                        <th>{{ __('University ID') }}</th>
                                        <th>{{ __('University') }}</th>
                                        <th>{{ __('City') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('Phone Number') }}</th>
                                        <th>{{ __('Action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($universities as $university)
                                        <tr>
                                            <td><a class="font-weight-bold">{{ $university['id'] }}</a></td>
                                            <td><span class="font-weight-normal"> {{ $university->user->key }}</span>
                                            </td>

                                            <td><span class="font-weight-normal">
                                                    {{ $university->user->type_username_id }}</span></td>
                                            <td><span class="font-weight-normal">
                                                    {{ $university->user->name }}</span></td>
                                            <td><span class="font-weight-normal">
                                                    {{ $university->city->name }}</span></td>
                                            <td><span class="font-weight-normal"> {{ $university['address'] }}</span>
                                            </td>
                                            <td><span class="font-weight-normal">
                                                    {{ $university['phone_number'] }}</span></td>

                                            <td>
                                                @can('edit universities')
                                                <a href="{{ route('admin.universities.edit', [$university['id']]) }}"
                                                    type="button" class="btn btn-outline-warning"><i
                                                        class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('delete universities')
                                                <form
                                                    action="{{ route('admin.universities.destroy', $university['id']) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="btn btn-outline-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">
                                                No universities Found.
                                            </td>
                                        </tr>
                                    @endforelse

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


