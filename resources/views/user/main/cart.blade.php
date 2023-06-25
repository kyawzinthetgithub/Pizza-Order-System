@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">

        <a href="{{ route('user#home') }}" class="nav-link ms-5 mb-3">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable" class="align-middle">
                        @foreach ($cartLists as $cartList)
                            <tr>
                                {{-- <input type="hidden" name="" id="price" value="{{ $cartList->pizza_price }}"> --}}
                                <td class="align-middle"><img src="{{ asset('storage/' . $cartList->product_image) }}"
                                        alt="" class="img-thumbnail" style="width: 70px;"></td>
                                <td class="align-middle">
                                    {{ $cartList->pizza_name }}
                                    <input type="hidden" class="cartId" value="{{ $cartList->id }}">
                                    <input type="hidden" class="productId" value="{{ $cartList->product_id }}">
                                    <input type="hidden" class="userId" value="{{ $cartList->user_id }}">
                                </td>
                                <td id="price" class="align-middle">{{ $cartList->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button type="button" id="btnMinus" class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus text-white"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-0 text-center qty"
                                            value="{{ $cartList->qty }}" readonly>
                                        <div class="input-group-btn">
                                            <button type="button" id="btnPlus" class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3"><span
                                        id="total">{{ $cartList->pizza_price * $cartList->qty }}</span> Kyats
                                </td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemoves"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><span id="subTotalPrice">{{ $totalPrice }}</span> Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><span id="deliFeed">3000</span> Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><span id="finalPrice">{{ $totalPrice + 3000 }}</span> Kyats</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3 rounded-5">
                            <span class="text-white">Proceed To Checkout</span>
                        </button>
                        <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3 rounded-5">
                            <span class="text-white">Clear Cart</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('custormJQuery')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#orderBtn").click(function() {

                $orderList = [];
                $random = Math.floor(Math.random() * 10000001);
                $('#dataTable tr').each(function(index, row) {
                    $orderList.push({
                        'user_id': $(row).find('.userId').val(),
                        'product_id': $(row).find('.productId').val(),
                        'qty': $(row).find('.qty').val(),
                        'total': Number($(row).find('#total').text().replace('Kyats', '')),
                        'order_code': 'POS' + $random
                    });
                });

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/order',
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "true") {
                            window.location.href = '/user/homePage';
                        }
                    }
                });
            });

            // clear cart
            $('#clearBtn').click(function() {
                $('#dataTable tr').remove();
                $('#subTotalPrice').text('0');
                $('#finalPrice').text('0');
                $('#deliFeed').text(0);

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear/cart',
                    dataType: 'json'
                });
            });

            //remove current product list
            $('.btnRemoves').click(function() {
                $parentNode = $(this).parents('tr');
                $productId = $parentNode.find('.productId').val();
                $cartId = $parentNode.find('.cartId').val();

                $parentNode.remove();

                //total summary
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text());
                });

                $('#subTotalPrice').html($totalPrice);
                $('#finalPrice').html($totalPrice + 3000);

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear/current/product',
                    dataType: 'json',
                    data: {
                        'cartId': $cartId,
                        'productId': $productId
                    }
                });


            });

        });
    </script>
@endsection
