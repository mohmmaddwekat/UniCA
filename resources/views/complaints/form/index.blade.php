<link href ="/assets/css/app.css" rel = "stylesheet">

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
              <h3 class="card-title">{{__('All Complaints')}}</h3>
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
                          <th>{{ __('Student Name') }}</th>
                          <th>{{ __('Student ID') }}</th>
                          <th>{{__('Complaint Type')}}</th>
                          <th>{{__('Course Number')}}</th>
                          <th>{{__('Section')}}</th>
                          <th>{{__('Course Name')}}</th>
                          <th>{{__('Instructor Name')}}</th>
                          <th>{{__('Lecture Days')}}</th>
                          <th>{{__('Lecture Time')}}</th>
                          <th>{{__('Complaint Status')}}</th>

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