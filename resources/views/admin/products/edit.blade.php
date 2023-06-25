@extends('admin.layout.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row mb-2">
            <div class="col-4 offset-6">
                @if (session('updateSuccess'))
                    <div class="">
                        <div class="alert alert-success alert-dismissible zoom-in show" role="alert">
                            <i class="fa-solid fa-check me-2"></i><small
                                class="text-danger">{{ session('updateSuccess') }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <a href="javascript:void(0)" class="nav-link" onclick="history.back()">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                {{-- <h3 class="text-center title-2">Pizza Details</h3> --}}
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-1">

                                    <img src="{{ asset('storage/' . $pizza->image) }}" class="img-tumbnail shadow-sm"
                                        alt="">

                                </div>
                                <div class="col-8">
                                    <div class="d-flex justify-content-center">
                                        <h3 class="text-capitalize btn btn-lg btn-danger w-50 mx-2">{{ $pizza->name }}
                                        </h3>
                                        <h3 class="text-capitalize btn btn-lg btn-info mx-2">
                                            <i class="fa-solid fa-table-cells-large me-2"></i>{{ $pizza->category_name }}
                                        </h3>
                                    </div>
                                    <span class="my-3 rounded bg-dark text-white p-1 text-capitalize"> <i
                                            class="fa-solid fa-sack-dollar me-2 fs-6"></i>
                                        {{ $pizza->price }} Kyats</span>
                                    <span class="my-3 rounded bg-dark text-white p-1"> <i
                                            class="fa-regular fa-clock me-2 fs-6"></i>
                                        {{ $pizza->waiting_time }} min</span>
                                    <span class="my-3 rounded bg-dark text-white p-1"> <i
                                            class="fa-solid fa-eye me-2 fs-6"></i>
                                        {{ $pizza->view_count }}</span>
                                    <div class="my-3 text-white btn btn-sm btn-dark"> <i
                                            class="fa-solid fa-user-clock me-2 fs-6"></i>
                                        {{ $pizza->created_at->format('j F Y') }}</div>

                                    <div class="my-3 text-muted"> <i class="fa-solid fa-file-lines me-2 fs-4"></i>
                                        Details</div>
                                    <div class="">
                                        {{ $pizza->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
