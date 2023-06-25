@extends('user.layouts.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">

                <a href="javascript:void(0)" class="nav-link" onclick="history.back()"><i
                        class="fa-solid fa-arrow-left"></i></a>

                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $pizzas->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizzas->name }}</h3>
                    <input type="hidden" name="" id="userId" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="" id="pizzaId" value="{{ $pizzas->id }}">
                    <div class="d-flex mb-3">
                        <small class="pt-1"> <i class="fa-solid fa-eye mx-1"></i> {{ $pizzas->view_count + 1 }} </small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizzas->price }} Kyats</h3>
                    <p class="mb-4">{{ $pizzas->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="orderCount" class="form-control bg-secondary text-center"
                                value="1" readonly>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addCartBtn" class="btn btn-primary px-3 cartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You
                May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $pizza)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $pizza->image) }}" alt=""
                                    style="height: 200px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a href="{{ route('user#pizzaDetails', $pizza->id) }}"
                                        class="btn btn-outline-dark btn-square">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $pizza->price }}</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small> Views {{ $pizza->view_count }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('custormJQuery')
    <script>
        $(document).ready(function() {

            // increase view count
            $.ajax({
                type: 'get',
                url: '/user/ajax/increase/viewCount',
                dataType: 'json',
                data: {
                    'productId': $('#pizzaId').val()
                }
            });

            // add to cart button
            $('#addCartBtn').click(function() {

                $source = {
                    'pizzaId': $('#pizzaId').val(),
                    'userId': $('#userId').val(),
                    'count': $('#orderCount').val()
                }

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/addToCart',
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = '/user/homePage';
                        }
                    }
                });
            });

        });
    </script>
@endsection
