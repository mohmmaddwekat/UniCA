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
                                  href="{{ route('university.department.index') }}">{{ __('Department') }}</a></li>
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
                          <a href="{{ route('university.department.index') }}"
                              class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                      </div>
                  </div>
                  <form class="needs-validation" action="{{ route('university.department.save') }}" method="post"
                      enctype="multipart/form-data">
                      <!-- /.card-header -->

                      @if ($errors->any())
                          @foreach ($errors as $error)
                              {{ $error }}
                          @endforeach
                      @endif

                      @csrf
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="exampleInputName1">{{ __('Name Department') }}</label>
                                      <input type="text" class="form-control @error('name') is-invalid @enderror"
                                          name="name" value="{{ old('name') }}" id="exampleInputName1"
                                          placeholder="{{ __('Enter Name') }}" required>
                                  </div>
       
                              </div>
                              <!-- /.col -->
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>{{ __('College') }}</label>
                                      <select class="form-control  selectpicker @error('college') is-invalid @enderror"
                                          name="college" data-selected-text-format="count" data-live-search="true">
                                          <option>{{ __('Nothing selected') }}</option>
                                          @foreach ($colleges as $college)
                                              <option value="{{ $college->id }}"
                                                  @if (old('college') && old('college') == $college->id) selected @endif>
                                                  {{ $college->name }}</option>
                                          @endforeach
                                      </select>
                                      @error('college')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label>{{ __('Head of Department') }}</label>
                                      <select class="form-control  selectpicker @error('user') is-invalid @enderror"
                                          name="user" data-selected-text-format="count" data-live-search="true">
                                          <option>{{ __('Nothing selected') }}</option>
                                          @foreach ($users as $user)
                                              <option value="{{ $user->id }}"
                                                  @if (old('user') && old('user') == $user->id) selected @endif>{{ $user->name }}
                                              </option>
                                          @endforeach
                                      </select>
                                      @error('user')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                              </div>
                          </div>
                          <!-- /.row -->
                          <!-- /.row -->
                      </div>
                      <div class="card-footer">
                          <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                      </div>
                  </form>
              </div>
          </div>
      </section>
  </div>
