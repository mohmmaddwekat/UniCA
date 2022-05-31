<link href ="/assets/css/app.css" rel = "stylesheet">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>{{ __('Error') }}</h5>
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>{{ __('Success') }}</h5>
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $page_title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('complaints.details.index') }}">{{ __('Complaints Defult') }}</a></li>
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
                <div class="col-12">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('All Complaint') }}</h3>

                            <div class="card-tools">
                                <!-- Collapse Button -->
                                <select class="form-control" name="forma" onchange="location = this.value;">
                                    <option value="">{{ __('Select Status') }}</option>
                                    <option @if (Request::is('/complaints/details/defult')) selected @endif
                                        value="{{ route('complaints.details.index') }}">{{ __('Defult') }}
                                    </option>
                                    <option @if (Request::is('complaints/details/group')) selected @endif
                                        value="{{ route('complaints.details.group') }}">{{ __('Group') }}
                                    </option>
                                    <option @if (Request::is('complaints/details/complaintForStudent')) selected @endif
                                        value="{{ route('complaints.details.complaintForStudent') }}">
                                        {{ __('complaintForStudent') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <x-auth-validation-errors class="m-4" :errors="$errors" />

                            <div class="row mb-5">

                                <div class="col-6">
                                    <h2 class="sub-header  m-2">complaints Form Withdraw</h2>
                                    <div class="btn-group">

                                            <div class="btn-group">
                                                <div class="btn-group">
                                                    <a href="{{ route('complaints.details.complaintResolvedGroup', 'withdraw') }}"
                                                    type="button" class="btn btn-success m-1"
                                                    style="font-size:13px">{{ __('Resolved') }}</a>
                                                    <a 
                                                    type="button" class="btn btn-danger m-1"  data-toggle="modal" data-target="#modal-default-withdraw"style="font-size:13px">{{ __('Decline') }}</a>
                                                    @if (Auth::user()->type != 'deanDepartment')
                                                    <a href="{{ route('complaints.details.complaintDeanDepartmentGroup', 'withdraw') }}"
                                                        type="button" class="btn btn-primary m-1"
                                                        style="font-size:13px">{{ __('Dean department') }}</a>
                                                    @endif 
                                                </div>
                                            </div>
        
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>{{ __('Name Student') }}</th>
                                                    <th>{{ __('ID') }}</th>
                                                    <th>{{ __('Type') }}</th>
                                                    <th>{{ __('Course Number') }}</th>
                                                    <th>{{ __('Section') }}</th>
                                                    <th>{{ __('Course Name') }}</th>
                                                    <th>{{ __('Teacher Name') }}</th>
                                                    <th>{{ __('Days') }}</th>
                                                    <th>{{ __('Hour') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($complaintsFormWithdraws as $complaintsFormWithdraw)
                                                    <tr>
                                                        <td>
                                                            <a class="font-weight-bold">
                                                                {{ $complaintsFormWithdraw['id'] }}
                                                            </a>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw->user->name }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw->user->type_username_id }}</span>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw['type'] }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw['course_number'] }}</span>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw['section'] }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw['course_name'] }}</span>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw['teacher_name'] }}</span>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw['days'] }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormWithdraw['hour'] }}</span></td>

                                                        <td>
                                                                <div class="btn-group">
                                                                <a href="{{ route('complaints.details.complaintResolvedDefult', $complaintsFormWithdraw['id']) }}"
                                                                type="button" class="btn btn-success m-1"
                                                                style="font-size:13px">{{ __('Resolved') }}</a>
                                                                <a 
                                                                type="button" class="btn btn-danger m-1"  data-toggle="modal" data-target="#modal-default-{{ $complaintsFormWithdraw['id'] }}"style="font-size:13px">{{ __('Decline') }}</a>
                                                                @if (Auth::user()->type != 'deanDepartment')
                                                                <a href="{{ route('complaints.details.complaintDeanDepartmentDefult', $complaintsFormWithdraw['id']) }}"
                                                                    type="button" class="btn btn-primary m-1"
                                                                    style="font-size:13px">{{ __('Dean department') }}</a>
                                                                @endif 
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @empty
        
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h2 class="sub-header m-2">Complaints Form Enroll</h2>
                                    <div class="btn-group">
                                        <div class="btn-group">
                                            <a href="{{ route('complaints.details.complaintResolvedGroup', 'enroll') }}"
                                            type="button" class="btn btn-success m-1"
                                            style="font-size:13px">{{ __('Resolved') }}</a>
                                            <a 
                                            type="button" class="btn btn-danger m-1"  data-toggle="modal" data-target="#modal-default-enroll"style="font-size:13px">{{ __('Decline') }}</a>
                                            @if (Auth::user()->type != 'deanDepartment')
                                            <a href="{{ route('complaints.details.complaintDeanDepartmentGroup', 'enroll') }}"
                                                type="button" class="btn btn-primary m-1"
                                                style="font-size:13px">{{ __('Dean department') }}</a>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>

                                                <tr>

                                                    <th>#</th>
                                                    <th>{{ __('Name Student') }}</th>
                                                    <th>{{ __('ID') }}</th>
                                                    <th>{{ __('Type') }}</th>
                                                    <th>{{ __('Course Number') }}</th>
                                                    <th>{{ __('Section') }}</th>
                                                    <th>{{ __('Course Name') }}</th>
                                                    <th>{{ __('Teacher Name') }}</th>
                                                    <th>{{ __('Days') }}</th>
                                                    <th>{{ __('Hour') }}</th>
                                                    <th>{{ __('Action') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($complaintsFormEnrolls as $complaintsFormEnroll)
                                                    <tr>
                                                        <td>
                                                            <a class="font-weight-bold">
                                                                {{ $complaintsFormEnroll['id'] }}
                                                            </a>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll->user->name }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll->user->type_username_id }}</span>
                                                        </td>

                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll['type'] }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll['course_number'] }}</span>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll['section'] }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll['course_name'] }}</span>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll['teacher_name'] }}</span>
                                                        </td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll['days'] }}</span></td>
                                                        <td><span class="font-weight-normal">
                                                                {{ $complaintsFormEnroll['hour'] }}</span></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('complaints.details.complaintResolvedDefult', $complaintsFormEnroll['id']) }}"
                                                                type="button" class="btn btn-success m-1"
                                                                style="font-size:13px">{{ __('Resolved') }}</a>
                                                                <a 
                                                                type="button" class="btn btn-danger m-1"  data-toggle="modal" data-target="#modal-default-{{ $complaintsFormEnroll['id'] }}"style="font-size:13px">{{ __('Decline') }}</a>
                                                                @if (Auth::user()->type != 'deanDepartment')
                                                                <a href="{{ route('complaints.details.complaintDeanDepartmentDefult', $complaintsFormEnroll['id']) }}"
                                                                    type="button" class="btn btn-primary m-1"
                                                                    style="font-size:13px">{{ __('Dean department') }}</a>
                                                                @endif 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
  
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
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




    @forelse ($complaintsFormWithdraws as $complaintsFormWithdraw)
    <div class="modal fade" id="modal-default-{{ $complaintsFormWithdraw['id'] }}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{ __('Decline Order') }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{ __('Name Student') }} : {{ $complaintsFormWithdraw->user->name }}</p>
              <p>{{ __('ID') }} : {{ $complaintsFormWithdraw->user->type_username_id }}</p>
              <p>{{ __('Type') }} : {{ $complaintsFormWithdraw['type'] }}</p>
              <p>{{ __('Course Number') }} : {{ $complaintsFormWithdraw['course_number'] }}</p>
              <p>{{ __('Section') }} : {{ $complaintsFormWithdraw['section'] }}</p>
              <p>{{ __('Course Name') }} : {{ $complaintsFormWithdraw['course_name'] }}</p>
              <p>{{ __('Teacher Name') }} : {{ $complaintsFormWithdraw['teacher_name'] }}</p>
              <p>{{ __('Days') }} : {{ $complaintsFormWithdraw['days'] }}</p>
              <p>{{ __('Hour') }} : {{ $complaintsFormWithdraw['hour'] }}</p>

              <form action="{{ route('complaints.details.complaintDeclineDefult', $complaintsFormWithdraw['id']) }}" method="post">
                @csrf
    
                <div class="form-group">
                    <label>{{ __('Notes') }}</label>
                    <textarea class="form-control" rows="3" name="notes" placeholder="{{ __('Enter Your Notes') }}"></textarea>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button  type="submit"  class="btn btn-danger">{{ __('Decline') }}</button>

                  </div>
                </form>
            </div>
    
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal --> 
      @empty

  @endforelse



  @forelse ($complaintsFormEnrolls as $complaintsFormEnroll)
  <div class="modal fade" id="modal-default-{{ $complaintsFormEnroll['id'] }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ __('Decline Order') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>{{ __('Name Student') }} : {{ $complaintsFormEnroll->user->name }}</p>
            <p>{{ __('ID') }} : {{ $complaintsFormEnroll->user->type_username_id }}</p>
            <p>{{ __('Type') }} : {{ $complaintsFormEnroll['type'] }}</p>
            <p>{{ __('Course Number') }} : {{ $complaintsFormEnroll['course_number'] }}</p>
            <p>{{ __('Section') }} : {{ $complaintsFormEnroll['section'] }}</p>
            <p>{{ __('Course Name') }} : {{ $complaintsFormEnroll['course_name'] }}</p>
            <p>{{ __('Teacher Name') }} : {{ $complaintsFormEnroll['teacher_name'] }}</p>
            <p>{{ __('Days') }} : {{ $complaintsFormEnroll['days'] }}</p>
            <p>{{ __('Hour') }} : {{ $complaintsFormEnroll['hour'] }}</p>

            <form action="{{ route('complaints.details.complaintDeclineDefult', $complaintsFormEnroll['id']) }}" method="post">
              @csrf
  
              <div class="form-group">
                  <label>{{ __('Notes') }}</label>
                  <textarea class="form-control" rows="3" name="notes" placeholder="{{ __('Enter Your Notes') }}"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                  <button  type="submit"  class="btn btn-danger">{{ __('Decline') }}</button>

                </div>
              </form>
          </div>
  
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
    <!-- /.modal --> 
    @empty

@endforelse


<div class="modal fade" id="modal-default-withdraw">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ __('Decline Order (withdraw)') }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>{{ __('Do you want to decline the group withdraw') }}</p>

          <form action="{{ route('complaints.details.complaintDeclineGroup', 'withdraw') }}" method="post">
            @csrf

            <div class="form-group">
                <label>{{ __('Notes') }}</label>
                <textarea class="form-control" rows="3" name="notes" placeholder="{{ __('Enter Your Notes') }}"></textarea>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button  type="submit"  class="btn btn-danger">{{ __('Decline') }}</button>

              </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-default-enroll">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ __('Decline Order (enroll)') }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>{{ __('Do you want to decline the group enroll') }}</p>

          <form action="{{ route('complaints.details.complaintDeclineGroup', 'enroll') }}" method="post">
            @csrf

            <div class="form-group">
                <label>{{ __('Notes') }}</label>
                <textarea class="form-control" rows="3" name="notes" placeholder="{{ __('Enter Your Notes') }}"></textarea>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button  type="submit"  class="btn btn-danger">{{ __('Decline') }}</button>

              </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


</div>
