<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$page_title}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="{{url('/assets/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{url('/assets/css/adminlte.min.css')}}">
 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <header>
      @include('layout.sidebar')
      @include('layout.navbar')
    </header>
    <main>
      @include($view_file,$controller_data)
    </main>
    @include('layout.footer') 
  </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{url('/assets/js/adminlte.min.js')}}"></script>
<script src="{{url('/assets/js/app.js')}}"></script>
<script src="{{url('/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
  $(document).ready(function () {
    $("#blah").hide();
    var table = $("#example").DataTable({
        language: {
            lengthMenu: "{{__('Showing')}} _MENU_ {{__('entries')}}",
            zeroRecords: "{{__('Nothing found')}}",
            info: "{{__('Showing')}}  _PAGE_ {{__('to')}} _TOTAL_ {{__('of')}} _PAGES_ {{__('entries')}}",
            infoEmpty: "{{__('No records available')}}",
            emptyTable: "{{__('No data available in table')}}",
            infoFiltered: "(filtered from _MAX_ total records)",
            decimal: "",
            infoPostFix: "",
            thousands: ",",
            loadingRecords: "{{__('Loading')}}...",
            processing: "{{__('Processing')}}...",
            search: "{{__('Search')}}:",
            paginate: {
                first: "{{__('First')}}",
                last: "{{__('Last')}}",
                next: "{{__('Next')}}",
                previous: "{{__('Previous')}}",
            },
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending",
            },
        },
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        responsive: true,
        pagingType: "full_numbers",
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            },
        ],
        order: [[1, "asc"]],
    });

    table
        .on("order.dt search.dt", function () {
            table
                .column(0, { search: "applied", order: "applied" })
                .nodes()
                .each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
        })
        .draw();
});
</script>
</body>
</html>