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
                    <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-thumbs-down"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">{{__('Failing courses')}}</span>
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
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">{{__('Successful courses')}}</span>
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
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">{{__('Courses you haven\'t studied')}}</span>
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
                      <span class="info-box-text">{{__('Complaint')}}</span>
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
                  <div class="card " >
                    <div class="card-header">
                      <h3 class="card-title">{{__('All Complaint')}}</h3>
                      <div class="card-tools">
                          <!-- Collapse Button -->
                          @can('add form complaints')
                          <a href="{{route('complaints.form.create')}}" class="btn btn-block btn-outline-primary">{{__('Create Complaint')}}</a>
                          @endcan
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                       <table id="example" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            
                              <tr>
        
                                  <th>#</th>
                                  <th>{{ __('Name Student') }}</th>
                                  <th>{{ __('ID Student') }}</th>
                                  <th>{{__('Type')}}</th>
                                  <th>{{__('Course Number')}}</th>
                                  <th>{{__('Section')}}</th>
                                  <th>{{__('Course Name')}}</th>
                                  <th>{{__('Teacher Name')}}</th>
                                  <th>{{__('Days')}}</th>
                                  <th>{{__('Hour')}}</th>
                                  <th>{{__('Status')}}</th>
        
                              </tr>
                          </thead>
                          <tbody>
                            @forelse ($complaintsForms as $complaintsForm)
                            <tr>
                            <td>
                              <a class="font-weight-bold">
                                  {{  $complaintsForm['id'] }}
                              </a>
                          </td>
                          <td>
                            <span class="font-weight-normal">
                                {{  $complaintsForm->user->name  }}</span>
                        </td>
                        <td><span class="font-weight-normal">
                                {{ $complaintsForm->user->type_username_id }}</span></td>
                            <td><span class="font-weight-normal"> {{ $complaintsForm['type'] }}</span></td>
                            <td><span class="font-weight-normal"> {{ $complaintsForm['course_number'] }}</span></td>
                            <td><span class="font-weight-normal"> {{ $complaintsForm['section'] }}</span></td>
                            <td><span class="font-weight-normal"> {{ $complaintsForm['course_name'] }}</span></td>
                            <td><span class="font-weight-normal"> {{ $complaintsForm['teacher_name'] }}</span></td>
                            <td><span class="font-weight-normal"> {{ $complaintsForm['days'] }}</span></td>
                            <td><span class="font-weight-normal"> {{ $complaintsForm['hour'] }}</span></td>
                            <td class="@if ($complaintsForm['status'] == 'Declined') bg-danger bg-gradient w-10 h-5 @elseif ($complaintsForm['status'] == 'Resolved') bg-success bg-gradient  w-10 h-5 @elseif ($complaintsForm['status'] == 'In progress By the Dean of the department') bg-info bg-gradient  w-10 h-5  @else  bg-secondary bg-gradient  w-10 h-5  @endif "><span class="font-weight-normal"> 
                            
                            {{ $complaintsForm['status'] }}
                            </span></td>
                          </tr>
                            @empty
                            <tr>
                                <td colspan="10">
                                    No Complaints Found.
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


