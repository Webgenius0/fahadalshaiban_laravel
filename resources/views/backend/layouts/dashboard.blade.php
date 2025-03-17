@php
use App\Models\Signage;
use Spatie\Permission\Models\Role;
$totalsignage=Signage::all()->count();
$totalActivesignage=Signage::where('status','active')->count();

$ownerRole =Role::where('name','owner')->first();
if($ownerRole){
$ownerCount= $ownerRole->users()->count();
}

if($ownerRole){
$activeOwner=$ownerRole->users()->where('status','active')->count();
}

$allUsersCountWithoutAdmin = App\Models\User::whereDoesntHave('roles', function ($query) {
$query->where('name', 'admin');
})->count();

$toatalCategory=App\Models\Category::all()->count();

@endphp
@extends('backend.app')
@push('styles')
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
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 -->
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3>Total Users</h3>
                                    <h6 class="mb-2 fw-semibold">{{ $allUsersCountWithoutAdmin }}</h6>

                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 16 16">
                                            <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                            <path d="m5.93 6.704-.846 8.451a.768.768 0 0 0 1.523.203l.81-4.865a.59.59 0 0 1 1.165 0l.81 4.865a.768.768 0 0 0 1.523-.203l-.845-8.451A1.5 1.5 0 0 1 10.5 5.5L13 2.284a.796.796 0 0 0-1.239-.998L9.634 3.84a.7.7 0 0 1-.33.235c-.23.074-.665.176-1.304.176-.64 0-1.074-.102-1.305-.176a.7.7 0 0 1-.329-.235L4.239 1.286a.796.796 0 0 0-1.24.998l2.5 3.216c.317.316.475.758.43 1.204Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3>Total Income</h3>
                                    <h6 class="mb-2 fw-semibold">{{$toatalCategory}}</h6>

                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div
                                        class="counter-icon bg-secondary dash ms-auto box-shadow-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3>To Signage Owner</h3>
                                    <h6 class="mb-2 fw-semibold">45</h6>

                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 16 16">
                                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3>Total Profit</h3>
                                    <h6 class="mb-2 fw-semibold">65</h6>

                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z" />
                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 col-sm-12 col-md-10 col-xl-9">
                    <div class="card overflow-hidden">
                        <h5 class="pl-5 pt-5" style="margin-left:25px;">Signage Status</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <strong class="text-muted fs-13 mb-0">Total register signage</strong>
                                    <h3 class="mb-2 fw-semibold">{{$totalsignage}}</h3>

                                </div>

                                <div class="col">
                                    <strong class="text-muted fs-13 mb-0">Total Owners</strong>
                                    <h3 class="mb-2 fw-semibold">{{$ownerCount}}</h3>

                                </div>

                                <div class="col">
                                    <strong class="text-muted fs-13 mb-0">Total Active Signage</strong>
                                    <h3 class="mb-2 fw-semibold">{{$totalActivesignage}}</h3>

                                </div>

                                <div class="col">
                                    <strong class="text-muted fs-13 mb-0">Total Active Owner</strong>
                                    <h3 class="mb-2 fw-semibold">{{$activeOwner}}</h3>

                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z" />
                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 h-100">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col p-6">
                                    <p class="text-muted fs-13 mb-0">Page Visits</p>
                                    <h3 class="mb-2 fw-semibold">65</h3>

                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z" />
                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content main-content mt-0">
                <div class="side-app">         
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card product-sales-main">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-0">Transection</h3>
                            <!-- <div class="card-options ms-auto">
                                <a href="{{ route('admin.tap.create') }}" class="btn btn-primary btn-sm">Add Marcent Id</a>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="bg-transparent border-bottom-0 wp-15">ID</th>
                                            <th class="bg-transparent border-bottom-0 wp-15">Name</th>
                                            <th class="bg-transparent border-bottom-0 wp-15">Email</th>
                                            <th class="bg-transparent border-bottom-0">Tap Marcent Id</th>
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
                    url: "{{ route('admin.dashboard') }}",
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
                        data: 'subtotal',
                        name: 'subtotal',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'dispatch_fee',
                        name: 'dispatch_fee',
                        orderable: false,
                        searchable: false
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
        let url = "{{ route('admin.tap.status', ':id') }}";
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

    // delete Confirm
    function showDeleteConfirm(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: 'If you delete this, it will be gone forever.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                deleteItem(id);
            }
        });
    }

    // Delete Button
    function deleteItem(id) {
        NProgress.start();
        let url = "{{ route('admin.tap.destroy', ':id') }}";
        let csrfToken = '{{ csrf_token() }}';
        $.ajax({
            type: "DELETE",
            url: url.replace(':id', id),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
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

    //edit
    function goToEdit(id) {
        let url = "{{ route('admin.tap.edit', ':id') }}";
        window.location.href = url.replace(':id', id);
    }
</script>
@endpush