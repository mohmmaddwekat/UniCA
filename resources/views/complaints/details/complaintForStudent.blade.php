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
                                href="{{ route('complaints.details.index') }}">{{ __('Complaints Defult') }}</a>
                        </li>

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
                    <div class="card ">
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
                                    <option @if (Request::is('complaints/details/complaint-for-student')) selected @endif
                                        value="{{ route('complaints.details.complaintForStudent') }}">
                                        {{ __('complaint for student') }}</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <x-auth-validation-errors class="m-4" :errors="$errors" />

                        <div class="card-body table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>

                                    <tr>

                                        <th>#</th>
                                        <th>{{ __('Name Student') }}</th>
                                        <th>{{ __('ID Student') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Course Number') }}</th>
                                        <th>{{ __('Section') }}</th>
                                        <th>{{ __('Course Name') }}</th>
                                        <th>{{ __('Teacher Name') }}</th>
                                        <th style="width: 10%">{{ __('Days') }}</th>
                                        <th style="width: 15%">{{ __('Hour') }}</th>
                                        <th>{{ __('Action') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @forelse ($unique_users_id as $complaintsForms)

                                        <tr>
                                            <td>

                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <a class="font-weight-bold">
                                                        {{ $complaintsForm['id'] }}
                                                    </a><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="font-weight-normal">
                                                    {{ $complaintsForms[0]->user->name }}</span>
                                            </td>
                                            <td><span class="font-weight-normal">
                                                    {{ $complaintsForms[0]->user->type_username_id }}</span></td>

                                            <td>
                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <span class="font-weight-normal">
                                                        {{ $complaintsForm['type'] }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <span class="font-weight-normal">
                                                        {{ $complaintsForm['course_number'] }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <span class="font-weight-normal">
                                                        {{ $complaintsForm['section'] }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <span class="font-weight-normal">
                                                        {{ $complaintsForm['course_name'] }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <span class="font-weight-normal">
                                                        {{ $complaintsForm['teacher_name'] }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <span class="font-weight-normal">
                                                        {{ $complaintsForm['days'] }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($complaintsForms as $complaintsForm)
                                                    <span class="font-weight-normal">
                                                        {{ $complaintsForm['hour'] }}</span><br>
                                                @endforeach
                                            </td>


                                            <td colspan="2">
                                                <div class="btn-group">

                                              


                                                        <a href="{{ route('complaints.details.complaintResolvedForStudent',$complaintsForms[0]['user_id']) }}"
                                                        type="button" class="btn btn-success m-1"
                                                        style="font-size:13px">{{ __('Resolved') }}</a>
                                                        <a 
                                                        type="button" class="btn btn-danger m-1"  data-toggle="modal" data-target="#modal-default-{{ $complaintsForms[0]['user_id'] }}"style="font-size:13px">{{ __('Decline') }}</a>
                                                        @if (Auth::user()->type != 'deanDepartment')
                                                        <a href="{{ route('complaints.details.complaintDeanForStudent',$complaintsForms[0]['user_id']) }}) }}"
                                                            type="button" class="btn btn-primary m-1"
                                                            style="font-size:13px">{{ __('Dean department') }}</a>
                                                        @endif 


                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
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

    @forelse ($unique_users_id as $complaintsForms)
    <div class="modal fade" id="modal-default-{{ $complaintsForms[0]['user_id'] }}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{ __('Decline Order') }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <p>{{ __('Do you want to decline all order for ') }}{{ $complaintsForms[0]->user->name }}</p>

              <form action="{{ route('complaints.details.complaintDeclineForStudent', $complaintsForms[0]['user_id']) }}" method="post">
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
      <tr>
          <td colspan="10">
              No Complaints Found.
          </td>
      </tr>
  @endforelse
  
</div>
