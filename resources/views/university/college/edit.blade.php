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
                          <li class="breadcrumb-item"><a
                                  href="{{ route('university.college.index') }}">{{ __('College') }}</a></li>
                          <li class="breadcrumb-item active">{{ $page_title }}</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="card card-default">
                  <div class="card-header">
                      <div class="card-tools">
                          <!-- Collapse Button -->
                          <a href="{{ route('university.college.index') }}"
                              class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                      </div>
                  </div>
                  <form class="needs-validation" action="{{ route('university.college.update', $college['id']) }}"
                      method="post" enctype="multipart/form-data">
                      <!-- /.card-header -->

                      @csrf
                      @include('university.college._form',[
                        'savelabel' => 'update'
                        ])
                  </form>
              </div>
          </div>
      </section>
  </div>


  