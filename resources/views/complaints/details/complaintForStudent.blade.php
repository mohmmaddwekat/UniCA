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
            <li class="breadcrumb-item"><a href="{{ route('complaints.details.index') }}">{{__('Complaints Defult')}}</a></li>

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
              <h3 class="card-title">{{__('All Complaint')}}</h3>

              <div class="card-tools">
                  <!-- Collapse Button -->
                  <select class="form-control"  name="forma" onchange="location = this.value;">
                    <option value="">{{__('Select Stuts')}}</option>
                    <option value="{{ route('complaints.details.index') }}">{{__('Defult')}}</option>
                    <option value="{{ route('complaints.details.group') }}">{{__('Group')}}</option>
                    <option value="{{ route('complaints.details.complaintForStudent') }}">{{__('complaintForStudent')}}</option>
                  </select>         
                 </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              
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