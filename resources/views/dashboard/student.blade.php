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
                <div class="col-12">
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Dashboard') }}
                        </h2>
                    </x-slot>
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white  shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (count($student->coursesStudent) == 0)
                                                <div class="card card-default">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Student information</h3>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="bs-stepper">
                                                            <div class="bs-stepper-header" role="tablist">
                                                                <!-- your steps here -->
                                                                <div class="step"
                                                                    data-target="#Academic-information-part">
                                                                    <button type="button" class="step-trigger"
                                                                        role="tab"
                                                                        aria-controls="Academic-information-part"
                                                                        id="Academic-information-part-trigger">
                                                                        <span class="bs-stepper-circle">1</span>
                                                                        <span class="bs-stepper-label">Academic
                                                                            information</span>
                                                                    </button>
                                                                </div>
                                                                <div class="line"></div>
                                                                <div class="step"
                                                                    data-target="#courses-information-part">
                                                                    <button type="button" class="step-trigger"
                                                                        role="tab"
                                                                        aria-controls="courses-information-part"
                                                                        id="courses-information-part-trigger">
                                                                        <span class="bs-stepper-circle">2</span>
                                                                        <span class="bs-stepper-label">Courses
                                                                            information</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="bs-stepper-content">
                                                                <form action="{{ route('course.add') }}"
                                                                    method="post">
                                                                    <!-- your steps content here -->
                                                                    @csrf
                                                                    <div id="Academic-information-part"
                                                                        class="content" role="tabpanel"
                                                                        aria-labelledby="Academic-information-part-trigger">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Year') }}</label>
                                                                            <select
                                                                                class="form-control year selectpicker @error('year') is-invalid @enderror"
                                                                                name="year"
                                                                                data-selected-text-format="count"
                                                                                title="{{ __('Nothing selected') }}"
                                                                                data-live-search="true">
                                                                                <option value="1">First</option>
                                                                                <option value="2">Second</option>
                                                                                <option value="3">Third</option>
                                                                                <option value="4">Fourth</option>
                                                                            </select>
                                                                            @error('year')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>{{ __('Track') }}</label>
                                                                            <select
                                                                                class="form-control track selectpicker @error('track') is-invalid @enderror"
                                                                                name="track"
                                                                                data-selected-text-format="count"
                                                                                title="{{ __('Nothing selected') }}"
                                                                                data-live-search="true">
                                                                            </select>
                                                                            @error('track')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>{{ __('Semester') }}</label>
                                                                            <select
                                                                                class="form-control semester selectpicker @error('semester') is-invalid @enderror"
                                                                                name="semester"
                                                                                data-selected-text-format="count"
                                                                                title="{{ __('Nothing selected') }}"
                                                                                data-live-search="true">
                                                                                <option value="1">First</option>
                                                                                <option value="2">Second</option>
                                                                                <option value="3">Third</option>
                                                                            </select>
                                                                            @error('semester')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <a class="btn btn-primary"
                                                                            onclick="stepper.next()">Next</a>
                                                                    </div>
                                                                    <div id="courses-information-part"
                                                                        class="content" role="tabpanel"
                                                                        aria-labelledby="courses-information-part-trigger">
                                                                        <table id="example"
                                                                            class="table table-bordered table-hover"
                                                                            style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Name course</th>
                                                                                    <th>Success</th>
                                                                                    <th>Fail</th>
                                                                                    <th>didn't study it</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                        </table>
                                                                        <a class="btn btn-primary"
                                                                            onclick="stepper.previous()">Previous</a>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            @else
                                                <div class="card card-default">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Student</h3>

                                                    </div>
                                                </div>
                                            @endif
                                            <!-- /.card -->
                                        </div>
                                    </div>
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

<script>
    $('.year').on('change', function(e) {
        $(".semester.selectpicker").find('option').remove().end().append(`
        <option value="1">First</option>
        <option value="2">Second</option>
        <option value="3">Third</option>
        `).selectpicker('refresh');
        $(".track.selectpicker").find('option').remove().end().selectpicker('refresh');
        var yearSelected = $(".year option").filter(":selected").val()
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "course/year/" + yearSelected,
            contentType: "application/json; charset=utf-8",
            type: "POST",
            dataType: "json",
            success: function(tracks) {
                setTrack = new Set();
                tracks.forEach(track => {
                    setTrack.add(track['track']);
                });
                arrTrack = [...setTrack];
                if (arrTrack.length > 0) {
                    $(".track.selectpicker").find('option').remove().end().selectpicker('refresh');
                    arrTrack.forEach(track => {
                        $(".track.selectpicker").append(`
                        <option value="${track}">${track}</option>
                        `).selectpicker('refresh');
                    });
                }
            },
        });
    });
    $('.semester').on('change', function(e) {

        var semesterSelected = $(".semester option").filter(":selected").val()
        var yearSelected = $(".year option").filter(":selected").val()
        var trackSelected = $(".track option").filter(":selected").val()
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "course/change/" + yearSelected + "/" + semesterSelected + "/" + (trackSelected || 0),
            contentType: "application/json; charset=utf-8",
            type: "POST",
            dataType: "json",
            success: function(courses) {
                if (courses.length != 0) {
                    $("#example").find('tbody').remove().end();
                    $('#example').append(`<tbody>`);
                    courses.forEach(course => {
                        if (course['prerequisite'] === 0) {
                            $('#example').append(`<tr><td>${course.name}</td>
                            <td><div onclick="select(this);"
                                class="icheck-success d-inline">
                                <input type="radio"
                                    name="course[${course.id}]"
                                    value="Success"
                                    id="radioSuccess_${course.id}" data-id = "${course.id}" data-prerequisite=${course.prerequisite}>
                                <label for="radioSuccess_${course.id}">
                                </label>
                                </div></td>
                            <td><div onclick="select(this);"
                                class="icheck-danger d-inline">
                                <input type="radio"
                                    name="course[${course.id}]"
                                    value="Fail"
                                    id="radioDanger_${course.id}" data-id = "${course.id}" prerequisite=${course.prerequisite}>
                                <label for="radioDanger_${course.id}">
                                </label>
                                </div></td>
                            <td><div onclick="select(this);"
                                class="icheck-primary d-inline">
                                <input type="radio"
                                    name="course[${course.id}]"
                                    value="didnot study"
                                    id="radioPrimary_${course.id}" data-id = "${course.id}" prerequisite=${course.prerequisite}>
                                <label for="radioPrimary_${course.id}">
                                </label>
                                </div></td></tr>
                        `);
                        } else {
                            $('#example').append(`<tr><td>${course.name}</td>
                            <td><div onclick="select(this);"
                                class="icheck-success d-inline">
                                <input type="radio"
                                    name="course[${course.id}]"
                                    value="Success"
                                    id="radioSuccess_${course.id}" data-id = "${course.id}" data-prerequisite=${course.prerequisite} disabled>
                                <label for="radioSuccess_${course.id}">
                                </label>
                                </div></td>
                            <td><div onclick="select(this);"
                                class="icheck-danger d-inline">
                                <input type="radio"
                                    name="course[${course.id}]"
                                    value="Fail"
                                    id="radioDanger_${course.id}" data-id = "${course.id}" data-prerequisite=${course.prerequisite} disabled>
                                <label for="radioDanger_${course.id}">
                                </label>
                                </div></td>
                            <td><div onclick="select(this);"
                                class="icheck-primary d-inline">
                                <input type="radio"
                                    name="course[${course.id}]"
                                    value="didnot study"
                                    id="radioPrimary_${course.id}" data-id = "${course.id}" data-prerequisite=${course.prerequisite} disabled>
                                <label for="radioPrimary_${course.id}">
                                </label>
                                </div></td></tr>
                        `);
                        }
                    });
                    $('#example').append(`</tbody>`);
                }
            },
        });
    });
    
    function select(input) {
        radio = input.children[0];
        prerequisite = radio.getAttribute('data-id')
        checkBoxs = document.querySelectorAll(`[data-prerequisite = "${prerequisite}"]`);
        checkBoxs.forEach(checkBox => {
            if (radio.value =="Success") {
                checkBox.removeAttribute("disabled");
            }else {
                checkBox.setAttribute('disabled', '');
            }
        });
    }

</script>
