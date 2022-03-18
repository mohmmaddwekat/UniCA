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


                                            <div class="m-5 p-5 text-center">
                                                <p>Welcome <span>{{ $user->name }}</span></p>
                                                <p>{{ $user->email }}</p>

                                            </div>

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
        $("#example").find('tbody').remove().end();
    });
    $('.semester').on('change', function(e) {

        var semesterSelected = $(".semester option").filter(":selected").val()
        var yearSelected = $(".year option").filter(":selected").val()
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "course/change/" + yearSelected + "/" + semesterSelected,
            contentType: "application/json; charset=utf-8",
            type: "POST",
            dataType: "json",
            success: function(courses) {
                console.log(courses);
                if (courses.length != 0) {
                    $("#example").find('tbody').remove().end();
                    courses.forEach(course => {
                        // $('#example ').h;
                        $('#example').append(`<tbody></tbody><tr><td>${course.name}</td>
          <td><div
              class="icheck-success d-inline">
              <input type="radio"
                  name="course[${course.id}]"
                  value="Success"
                  id="radioSuccess_${course.id}">
              <label for="radioSuccess_${course.id}">
              </label>
            </div></td>
          <td><div
              class="icheck-danger d-inline">
              <input type="radio"
              
                  name="course[${course.id}]"
                  value="Fail"
                  id="radioDanger_${course.id}">
              <label for="radioDanger_${course.id}">
              </label>
            </div></td>
          <td><div
              class="icheck-primary d-inline">
              <input type="radio"
                  name="course[${course.id}]"
                  value="didnot study"
                  id="radioPrimary_${course.id}">
              <label for="radioPrimary_${course.id}">
              </label>
            </div></td></tr>
      `);
                        $('#example').append(`</tbody>`);
                    });

                }
            },
        });
    });
</script>
