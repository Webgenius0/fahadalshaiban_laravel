@extends('backend.app', ['title' => 'Cteate tap Marcent Id'])

@section('content')

<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Tap marcent Id </h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tap marcent Id</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>

            <div class="row" id="user-profile">
                <div class="col-lg-12">

                    <div class="tab-content">
                        <div class="tab-pane active show" id="editProfile">
                            <div class="card">
                                <div class="card-body border-0">
                                    <form class="form-horizontal" method="post" action="{{ route('admin.tap.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-4">

                                            

                                            <div class="form-group">
                                                <label for="name" class="form-label">email:</label>
                                                <select name="email" id="" class="form-control">
                                                    @foreach ($users as $user)
                                                    <option value="">{{$user->email}}</option>
                                                    @endforeach
                                                </select>
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="url" class="form-label">URL:</label>
                                                <input type="text" class="form-control @error('url') is-invalid @enderror" name="tap_marcent_id" placeholder="Tap marchen Id" id="" value="{{ old('tap_marcent_id') }}">
                                                @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                           

                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection
@push('scripts')

@endpush