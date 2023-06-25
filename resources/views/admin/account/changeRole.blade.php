@extends('admin.layout.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
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
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#change', $account->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'male')
                                                <img src="{{ asset('img/default_user.png') }}" class="img-thumbnail"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('img/default_female.png') }}" class="img-thumbnail"
                                                    alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}"
                                                class="img-thumbnail shadow-sm" alt="">
                                        @endif

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-dark col-12"> <i
                                                    class="fa-solid fa-circle-right me-1"></i> Change</button>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name')
                                                is-invalid @enderror"
                                                value="{{ old('name', $account->name) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Name !" disabled>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Role</label>
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input type="radio" name="role" id="admin"
                                                        class="form-check-input"
                                                        @if ($account->role == 'admin') checked @endif value="admin">
                                                    <label class="form-check-label" for="admin">
                                                        Admin
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input type="radio" name="role" id="user"
                                                        class="form-check-input"
                                                        @if ($account->role == 'user') checked @endif value="user">
                                                    <label class="form-check-label" for="user">
                                                        User
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email')
                                                is-invalid @enderror"
                                                value="{{ old('email', $account->email) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Email !" disabled>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input type="number" name="phone" id="phone"
                                                class="form-control  @error('phone')
                                                is-invalid @enderror"
                                                value="{{ old('phone', $account->phone) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Phone !" disabled>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender"
                                                class="form-control  @error('gender')
                                                is-invalid @enderror"
                                                disabled>
                                                <option value="">Choose gender...</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
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
                                                cols="30" rows="3" placeholder="Enter Admin Address !" disabled>{{ old('address', $account->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
    <!-- END MAIN CONTENT-->
@endsection
