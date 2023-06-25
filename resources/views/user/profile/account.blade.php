@extends('user.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:void(0)" class="nav-link" onclick="history.back()">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>
                            <hr>

                            @if (session('updateSuccess'))
                                <div class="col-4 offset-8">
                                    <div class="alert alert-success alert-dismissible zoom-in show" role="alert">
                                        <i class="fa-solid fa-check me-2"></i><small> {{ session('updateSuccess') }}
                                        </small>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">

                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('img/default_user.png') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                <img src="{{ asset('img/default_female.png') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="img-thumbnail shadow-sm" alt="">
                                        @endif

                                        <div class="mt-3">
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-dark col-12"> <i
                                                    class="fa-solid fa-circle-right me-1"></i> Update</button>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name')
                                                is-invalid @enderror"
                                                value="{{ old('name', Auth::user()->name) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Name !">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email')
                                                is-invalid @enderror"
                                                value="{{ old('email', Auth::user()->email) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Email !">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input type="number" name="phone" id="phone"
                                                class="form-control  @error('phone')
                                                is-invalid @enderror"
                                                value="{{ old('phone', Auth::user()->phone) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Phone !">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender"
                                                class="form-control  @error('gender')
                                                is-invalid @enderror">
                                                <option value="">Choose gender...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="address"
                                                class="form-control  @error('address')
                                                is-invalid @enderror"
                                                cols="30" rows="3" placeholder="Enter Admin Address !">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role" class="control-label mb-1">Role</label>
                                            <input type="text" name="role" id="role" class="form-control"
                                                value="{{ old('role', Auth::user()->role) }}" aria-required="true"
                                                aria-invalid="false" disabled>
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
@endsection
