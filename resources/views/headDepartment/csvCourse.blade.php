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
            <div class="card card-default">
                <form class="needs-validation" action="{{ route('university.department.import.course.store') }}"
                    method="post" enctype="multipart/form-data">
                    <!-- /.card-header -->
                    @if ($errors->any())
                        @foreach ($errors as $error)
                            {{ $error }}
                        @endforeach
                    @else
                    @endif

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">{{ __('Export sample Courses File') }}</label>
                                    <div class="input-group">
                                        <a href="{{ route('university.department.export.course') }}"
                                            class="btn btn-block btn-outline-secondary">{{ __('Export File') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">{{ __('Import Courses File') }}</label>
                                    <div class="input-group">
                                        <input type="file" name="file" accept=".csv" onchange="readImage(this);"
                                            class="custom-file-input  @error('file') is-invalid @enderror"
                                            id="exampleInputFile">
                                        <label class="path custom-file-label"
                                            for="exampleInputFile">{{ __('Choose File') }}</label>
                                        @error('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
