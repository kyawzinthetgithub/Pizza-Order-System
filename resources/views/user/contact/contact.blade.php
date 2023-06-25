@extends('user.layouts.master')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="offset-3 col-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert"></button>
                </div>
            </div>
        @endif
        <form action="{{ route('user#messageSent') }}" method="post">
            @csrf
            <div class="col-6 offset-3  border rounded p-5">
                <div class="row g-4">
                    <h3 class="fw-normal fs-2 d-flex justify-content-center mb-3">Customer Contact Form</h3>
                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" />
                            <label class="form-label">User Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" />
                            <label class="form-label">Email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-outline my-3">
                            <textarea name="message" id="" class="form-control @error('message') is-invalid @enderror" rows="5">{{ old('message') }}</textarea>
                            <label class="form-label">Message</label>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success rounded-3">Sent</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
