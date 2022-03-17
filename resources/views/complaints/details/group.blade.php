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
                        <li class="breadcrumb-item"><a href="{{ route('complaints.details.index') }}">{{__('Complaints Defult')}}</a></li>
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
                                    <option value="{{ route('complaints.details.index') }}">{{ __('Defult') }}
                                    </option>
                                    <option value="{{ route('complaints.details.group') }}">{{ __('Group') }}
                                    </option>
                                    <option value="{{ route('complaints.details.complaintForStudent') }}">
                                        {{ __('complaintForStudent') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row mb-5">

                                <div class="col-6">
                                    <h2 class="sub-header  m-2">complaints Form Withdraw</h2>
                                    <div class="btn-group">
                                      <a href="" type="button" class="btn btn-danger m-1" style="font-size:13px">Decline</a>
                                      <a href="" type="button" class="btn btn-success m-1" style="font-size:13px">Resolved</a>
                                      <a href="" type="button" class="btn btn-primary m-1" style="font-size:13px">Dean department</a>
                                      </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>{{__('Name Student')}}</th>
                                                    <th>{{__('ID')}}</th>
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
                                                        <td><span class="font-weight-normal"> {{ $complaintsFormWithdraw->user->name }}</span></td>
                                                        <td><span class="font-weight-normal"> {{ $complaintsFormWithdraw->user->type_username_id }}</span></td>
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
                                                              <a href="" type="button" class="btn btn-danger m-1" style="font-size:13px">Decline</a>
                                                              <a href="" type="button" class="btn btn-success m-1" style="font-size:13px">Resolved</a>
                                                              <a href="" type="button" class="btn btn-primary m-1" style="font-size:13px">Dean department</a>
                                                              </div>
                                                            </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10">
                                                            No complaints Form Withdraw Found.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h2 class="sub-header m-2">Complaints Form Enroll</h2>
                                    <div class="btn-group">
                                      <a href="" type="button" class="btn btn-danger m-1" style="font-size:13px">Decline</a>
                                      <a href="" type="button" class="btn btn-success m-1" style="font-size:13px">Resolved</a>
                                      <a href="" type="button" class="btn btn-primary m-1" style="font-size:13px">Dean department</a>
                                      </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>

                                                <tr>

                                                    <th>#</th>
                                                    <th>{{__('Name Student')}}</th>
                                                    <th>{{__('ID')}}</th>
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
                                                        <td><span class="font-weight-normal"> {{ $complaintsFormEnroll->user->name }}</span></td>
                                                        <td><span class="font-weight-normal"> {{ $complaintsFormEnroll->user->type_username_id }}</span></td>

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
                                                            <a href="" type="button" class="btn btn-danger m-1" style="font-size:13px">Decline</a>
                                                            <a href="" type="button" class="btn btn-success m-1" style="font-size:13px">Resolved</a>
                                                            <a href="" type="button" class="btn btn-primary m-1" style="font-size:13px">Dean department</a>
                                                            </div>
                                                          </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10">
                                                            No complaints Form Enroll Found.
                                                        </td>
                                                    </tr>
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

</div>
