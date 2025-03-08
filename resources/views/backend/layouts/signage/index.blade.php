@extends('backend.app', ['title' => 'Signage'])

@push('styles')
<style>
    #details-section {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    #details-section .col-md-6 {
        flex: 1;
    }

    #details-section img {
        max-width: 100%;
        height: auto;
    }

    #closeDetailsBtn i {
        font-size: 20px;
        /* Adjust the size of the icon */
        color: white;
        /* Change color if needed */
    }
</style>
<link href="{{ asset('default/datatable.css') }}" rel="stylesheet" />
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
            <div class="row justify-content-evenly z-index-1 ">
                <div class="card col-md-12 position-relative  justify-content-left  ">
                    <!-- Details Section (Initially hidden) -->
                    <div id="details-section" class="card-body" style="display:none;">
                        <!-- The data will be dynamically loaded here -->

                        <!-- Close (cross) button to hide the details -->
                        <button id="closeDetailsBtn" class="btn btn-danger" onclick="hideDetails()">
                            <i class="fe fe-x"></i> Close <!-- Feather icon for 'X' -->
                        </button>
                    </div>
                </div>
            </div>

            <!-- ROW-4 -->
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card product-sales-main">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-0">Task List</h3>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="bg-transparent border-bottom-0 wp-15">ID</th>
                                            <th class="bg-transparent border-bottom-0 wp-15">Name</th>
                                            <th class="bg-transparent border-bottom-0">Image</th>
                                            <th class="bg-transparent border-bottom-0">Status</th>
                                            <th class="bg-transparent border-bottom-0">Action</th>
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



@push('scripts')
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
                dom: "<'row justify-content-between table-topbar'<'col-md-4 col-sm-3'l><'col-md-5 col-sm-5 px-0'f>>tipr",
                ajax: {
                    url: "{{ route('admin.signage.index') }}",
                    type: "GET",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'dt-center text-center'
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
        let url = "{{ route('admin.signage.status', ':id') }}";
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
                url: "{{ route('admin.signage.view', ':id') }}".replace(':id', id), // Replace ':id' with the actual id
                type: 'GET',
                success: function(response) {
                    if (response && response.data) {
                        var data = response.data;
                        var user = data.users;

                        // If there's an image, show it, otherwise show a placeholder
                        var imageUrl = data.image ? "{{asset('')}}" + data.image : "{{ asset('images/no-image-placeholder.png') }}";

                        var content = `
  
                            <div class="row" >
                            
                                <div class="col-md-3 mt-5">
                                <h3>Owner Details</h3>
                                    <p><strong>ID:</strong> ${data.id}</p>
                                    <p><strong>Name:</strong> ${user.name}</p>
                                    <p><strong>Email:</strong> ${user.email}</p>
                                    
                                </div>

                                <div class="col-md-3 mt-5">
                                <h3>Signage Details</h3>
                                    <p><strong>Title:</strong> ${data.name}</p>
                                    <p><strong>Description:</strong> ${data.description}</p>
                                    <p><strong>Daily Views:</strong> ${data.avg_daily_views}</p>
                                    <p><strong>Per day price:</strong> ${data.per_day   }</p>
                                </div>

                                <div class="col-md-3 mt-5">
                                <small>Signage ArthWork Dimension</small>
                                    <p><strong>Height:</strong> ${data.height} px</p>
                                    <p><strong>Width:</strong> ${data.width} px</p>
                                    <small>Signage Actual Dimension</small>
                                    <p><strong>Actual Height:</strong> ${data.actual_height} cm</p>
                                    <p><strong>Actual Width:</strong> ${data.actual_width} cm</p>
                                </div>
                                <div class="col-md-3">
                                    <!-- If there's an image, show it, otherwise show a placeholder -->
                                
                                    <img src="${imageUrl}" alt="Signage Image" class="img-fluid" style="max-width: 100%; height: auto;" />  <!-- Display the image -->
                                </div>
                            </div>
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

        function hideDetails() {
            $('#details-section').hide();
        }

        window.showView = showView;
        window.hideDetails = hideDetails;
    });
</script>
@endpush