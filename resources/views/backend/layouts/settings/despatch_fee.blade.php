@extends('backend.app')

@section('content')
<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            {{-- PAGE-HEADER --}}
            <div class="page-header">
                <div>
                    <h1 class="page-title">Dispatch Fee Settings</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dispatch Fee</li>
                    </ol>
                </div>
            </div>
            {{-- PAGE-HEADER --}}

            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card box-shadow-0">
                        <div class="card-body">
                            <!-- Form for updating dispatch fee -->
                            <form method="post" action="{{ route('admin.setting.dispatch.fee.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row mb-4">
                                    <label for="dispatch_fee" class="col-md-3 form-label">Dispatch Fee</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="btn" title="Carefully Change Your Dispatch Fee">
                                                    <i class="fa-solid fa-triangle-exclamation text-danger"></i>
                                                </span>
                                            </div>
                                            <input class="form-control @error('dispatch_fee') is-invalid @enderror" 
                                                   id="dispatch_fee" name="dispatch_fee" 
                                                   placeholder="Enter dispatch fee" 
                                                   type="text" 
                                                   value="{{ old('dispatch_fee', env('DESPATCH_FEE')) }}">
                                        </div>
                                        @error('dispatch_fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
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
<!-- CONTAINER CLOSED -->
@endsection
