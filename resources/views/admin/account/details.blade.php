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
                            <a href="javascript:void(0)" class="nav-link" onclick="history.back()">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('img/default_user.png') }}" class="img-thumbnail"
                                                alt="">
                                        @else
                                            <img src="{{ asset('img/default_female.png') }}" class="img-thumbnail"
                                                alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="img-thumbnail shadow-sm" alt="">
                                    @endif
                                </div>
                                <div class="col-5 offset-2">

                                    <h5 class="my-2 text-muted"> <i class="fa-solid fa-clipboard-user me-2"></i>
                                        {{ Auth::user()->name }}</h5>
                                    <h5 class="my-2 text-muted"> <i class="fa-solid fa-envelope me-2"></i>
                                        {{ Auth::user()->email }}</h5>
                                    <h5 class="my-2 text-muted"> <i class="fa-solid fa-phone-volume me-2"></i>
                                        {{ Auth::user()->phone }}</h5>
                                    <h5 class="my-2 text-muted text-capitalize"><i class="fa-solid fa-venus-mars me-2"></i>
                                        {{ Auth::user()->gender }}</h5>
                                    <h5 class="my-2 text-muted text-capitalize"> <i
                                            class="fa-solid fa-location-dot me-2"></i> {{ Auth::user()->address }}</h5>
                                    <h5 class="my-2 text-muted text-capitalize"> <i class="fa-solid fa-user-clock me-2"></i>
                                        {{ Auth::user()->created_at->format('j F Y') }}</h5>

                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <a href="{{ route('admin#edit') }}">
                                            <button class="btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Edit
                                                Profile</button></a>
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
