@extends('owner.app', ['title' => 'Home'])


@push('style')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
    #closeDetailsBtn i {
        font-size: 20px;
        /* Adjust the size of the icon */
        color: white;
        /* Change color if needed */
    }

    .dataTables_filter {
        float: right;
        margin-bottom: 40px;
    }
</style>
<!-- <link href="{{ asset('default/datatable.css') }}" rel="stylesheet" /> -->
@endpush


@section('content')
<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">


            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Signage</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Signage</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row justify-content-evenly ">
                <div class="card col-md-5 position-relative  justify-content-center align-items-center ">
                    <!-- Details Section (Initially hidden) -->

                </div>
            </div>

            <!-- ROW-4 -->
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card product-sales-main">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-0">Order List</h3>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="bg-transparent border-bottom-0 wp-15">ID</th>
                                            <th class="bg-transparent border-bottom-0 wp-15">Order Id</th>
                                            <th class="bg-transparent border-bottom-0 wp-20">Signage Name</th>
                                            <th class="bg-transparent border-bottom-0">Campaign Name</th>
                                            <th class="bg-transparent border-bottom-0">Campaign Image</th>
                                            <th class="bg-transparent border-bottom-0">Start Date</th>
                                            <th class="bg-transparent border-bottom-0">End Date</th>
                                            </th>
                                            <th class="bg-transparent border-bottom-0">Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div><!-- COL END -->
            </div>
            <!-- ROW-4 END -->

        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection



@push('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        if (!$.fn.DataTable.isDataTable('#datatable')) {
            let dTable = $('#datatable').DataTable({
                order: [],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                processing: true,
                responsive: true,
                serverSide: true,

                language: {
                    processing: `<div class="text-center">
                    <img src="{{ asset('default/loader.gif') }}" alt="Loader" style="width: 50px;">
                    </div>`
                },

                scroller: {
                    loadingIndicator: false
                },
                pagingType: "full_numbers",
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>tipr", // Adjusted dom configuration
                ajax: {
                    url: "{{ route('owner.order.index') }}",
                    type: "GET",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'uuid',
                        name: 'uuid',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'ad_title',
                        name: 'ad_title',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'art_work',
                        name: 'art_work',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data) {
                                var date = new Date(data);
                                return date.toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'long',
                                    year: '2-digit'
                                }); // Formats as "21 March 25"
                            }
                            return data;
                        }
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data) {
                                var endDate = new Date(data);
                                var currentDate = new Date();

                                // If today's date is greater than the end date, show "Booking time expired" on the date
                                if (currentDate > endDate) {
                                    // Return a span with the badge-danger class to highlight the expired booking
                                    return '<span class="badge badge-danger">Expired on ' + endDate.toLocaleDateString('en-GB', {
                                        day: '2-digit',
                                        month: 'long',
                                        year: '2-digit'
                                    }) + '</span>';
                                } else {
                                    // Otherwise, return the formatted end date
                                    return endDate.toLocaleDateString('en-GB', {
                                        day: '2-digit',
                                        month: 'long',
                                        year: '2-digit'
                                    }); // Formats as "21 March 25"
                                }
                            }
                            return data;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                   
                ],
            });
        }
    });
    // Status Change Confirm Alert
    function showStatusChangeAlert(id) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update the status?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                statusChange(id);
            }
        });
    }

    // Status Change
    function statusChange(id) {
        NProgress.start();
        let url = "";
        $.ajax({
            type: "GET",
            url: url.replace(':id', id),
            success: function(resp) {
                NProgress.done();
                toastr.success(resp.message);
                $('#datatable').DataTable().ajax.reload();
            },
            error: function(error) {
                NProgress.done();
                toastr.error(error.message);
            }
        });
    }


    $(document).ready(function() {
        // Define the showView function
        function showView(id) {
            $.ajax({
                url: "".replace(':id', id), // Replace ':id' with the actual id
                type: 'GET',
                success: function(response) {
                    if (response && response.data) {
                        var data = response.data;
                        var user = data.users;
                        var content = `
                        <h3>Record Details</h3>
                        <p><strong>ID:</strong> ${data.id}</p>
                         <p><strong> Name:</strong> ${user.name}</p>
                        <p><strong>Email:</strong> ${user.email}</p>
                        <p><strong>Title:</strong> ${data.name}</p>
                        <p><strong>Description:</strong> ${data.description}</p>
                        
                    `;
                        // Load the data into the details section
                        $('#details-section').html(content);
                        $('#details-section').show();
                    } else {
                        $('#details-section').html("<p>Failed to load data. Please try again.</p>");
                        $('#details-section').show();
                    }
                },
                error: function(xhr, status, error) {
                    $('#details-section').html("<p>There was an error fetching the data. Please try again.</p>");
                    $('#details-section').show();
                }
            });
        }

    });
</script>
@endpush