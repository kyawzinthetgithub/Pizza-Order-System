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
                            <div class="ms-5">
                                <a href="javascript:void(0)" class="nav-link" onclick="history.back()">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>

                            <form action="{{ route('products#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        <img src="{{ asset('storage/' . $pizza->image) }}" class="img-tumbnail shadow-sm"
                                            alt="">
                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" id="pizzaImage"
                                                class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
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
                                            <input type="text" name="pizzaName" id="pizzaName"
                                                class="form-control @error('pizzaName')
                                                is-invalid @enderror"
                                                value="{{ old('pizzaName', $pizza->name) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Pizza Name !">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pizzaDescription" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" id="pizzaDescription"
                                                class="form-control  @error('pizzaDescription')
                                                is-invalid @enderror"
                                                cols="30" rows="3" placeholder="Enter Pizza Description !">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pizzaCategory">Category</label>
                                            <select name="pizzaCategory" id="pizzaCategory"
                                                class="form-control  @error('pizzaCategory')
                                                is-invalid @enderror">
                                                <option value="">Choose Category...</option>
                                                @foreach ($category as $cate)
                                                    <option value="{{ $cate->id }}"
                                                        @if ($pizza->category_id == $cate->id) selected @endif>
                                                        {{ $cate->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                            <input type="number" name="pizzaPrice" id="pizzaPrice"
                                                class="form-control @error('pizzaPrice')
                                                is-invalid @enderror"
                                                value="{{ old('pizzaPrice', $pizza->price) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Pizza Price !">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pizzaWaitingTime" class="control-label mb-1">Waiting Time</label>
                                            <input type="number" name="pizzaWaitingTime" id="pizzaWaitingTime"
                                                class="form-control @error('pizzaWaitingTime')
                                                is-invalid @enderror"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Pizza Waiting Time !">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="viewCount" class="control-label mb-1">View Count</label>
                                            <input type="number" name="viewCount" id="viewCount" class="form-control"
                                                value="{{ old('viewCount', $pizza->view_count) }}" aria-required="true"
                                                aria-invalid="false" disabled />
                                        </div>

                                        <div class="form-group">
                                            <label for="created_at" class="control-label mb-1">Created Date</label>
                                            <input type="text" name="created_at" id="created_at" class="form-control"
                                                value="{{ $pizza->created_at->format('j-F-Y') }}" aria-required="true"
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
    <!-- END MAIN CONTENT-->
@endsection
