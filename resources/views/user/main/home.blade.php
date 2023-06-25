@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">

        @if (session('changeSuccess'))
            <div class="col-3 offset-9">
                <div class="alert alert-success alert-dismissible zoom-in show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><small> {{ session('changeSuccess') }} </small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif


        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between bg-dark text-white px-3 py-1 mb-3">
                            <label for="price-all" class="mt-2">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between py-1 mb-3">
                            <a href="{{ route('user#home') }}" class="nav-link">All</a>
                        </div>

                        @foreach ($category as $cate)
                            <div class="d-flex align-items-center justify-content-between py-1 mb-3">
                                <a href="{{ route('user#filter', $cate->id) }}" class="nav-link">{{ $cate->name }}</a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-dark position-relative rounded">
                                        <i class="fa-solid fa-cart-plus me-2"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($carts) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#history') }}" class="ms-3">
                                    <button type="button" class="btn btn-dark position-relative rounded">
                                        <i class="fa-solid fa-clock-rotate-left"></i> History
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($orders) }}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control text-center">
                                        <option value="" selected disabled>Choose Sorting</option>
                                        <option value="asc">Old First</option>
                                        <option value="desc">New First</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-auto" id="myList">
                        @if (count($pizzas) != 0)
                            @foreach ($pizzas as $pizza)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $pizza->image) }}"
                                                style="height:200px">
                                            <div class="product-action">
                                                <a href="" class="btn btn-outline-dark btn-square"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a href="{{ route('user#pizzaDetails', $pizza->id) }}"
                                                    class="btn btn-outline-dark btn-square">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $pizza->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $pizza->price }} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-danger fs-3 mt-5">There is no Products !</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('custormJQuery')
    <script>
        $(document).ready(function() {
            // get data with ajax
            // $.ajax({
            //     type: 'get',
            //     url: '/user/ajax/pizza/list',
            //     dataType: 'json',
            //     success: function(response) {
            //         console.log(response.id);
            //     }
            // });

            $('#sortingOption').change(function() {

                if ($('#sortingOption').val() == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        dataType: 'json',
                        data: {
                            'status': 'asc'
                        },
                        success: function(response) {

                            $list = '';
                            for (let $i = 0; $i < response.length; $i++) {

                                $list += `

                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                            style="height:200px">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a href="/user/pizza/details/${response[$i].id}" class="btn btn-outline-dark btn-square">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;

                            };

                            $('#myList').html($list);
                        }
                    });
                } else if ($('#sortingOption').val() == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        dataType: 'json',
                        data: {
                            'status': 'desc'
                        },
                        success: function(response) {
                            $list = '';
                            for (let $i = 0; $i < response.length; $i++) {

                                $list += `

                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                            style="height:200px">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a href="/user/pizza/details/${response[$i].id}" class="btn btn-outline-dark btn-square">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;

                            };

                            $('#myList').html($list);
                        }
                    });
                }

            });

        });
    </script>
@endsection
