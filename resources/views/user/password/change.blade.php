@extends('user.layouts.master')

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>

                                    @if (session('notMatch'))
                                        <div class="col-12">
                                            <div class="alert alert-warning alert-dismissible zoom-in show" role="alert">
                                                <i
                                                    class="fa-solid fa-triangle-exclamation me-2"></i><small>{{ session('notMatch') }}</small>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    <hr>
                                    <form action="{{ route('user#changePassword') }}" method="post"
                                        novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                            <input id="oldPassword" name="oldPassword" type="password"
                                                class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                                            @error('oldPassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if (session('notMatch'))
                                                <div class="invalid-feedback">
                                                    {{ session('notMatch') }}
                                                </div>
                                            @endif

                                        </div>

                                        <div class="form-group">
                                            <label for="newPassword" class="control-label mb-1">New Password</label>
                                            <input id="newPassword" name="newPassword" type="password"
                                                class="form-control @error('newPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                            @error('newPassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                                            <input id="confirmPassword" name="confirmPassword" type="password"
                                                class="form-control @error('confirmPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Confirm Password">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-dark btn-block rounded-3">
                                                <i class="fa-solid fa-key me-2"></i>
                                                <span id="payment-button-amount">Change Password</span>
                                            </button>
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
@endsection
