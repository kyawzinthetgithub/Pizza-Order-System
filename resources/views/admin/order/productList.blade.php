@extends('admin.layout.master')

@section('title', 'Pizza Products List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}" class="text-dark">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>

                        <div class="row col-6 mt-3">
                            <div class="card shadow-sm rounded-3">
                                <div class="card-body">
                                    <div class="row text-center border-bottom pb-2 my-2">
                                        <h3> <i class="fa-solid fa-clipboard me-2"></i> Order
                                            Information</h3>
                                        <small class="text-warning"> <i class="fa-solid fa-triangle-exclamation"></i> In
                                            clude Delivery Feed</small>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-circle-user me-2"></i> User Name</div>
                                        <div class="col">{{ strtoupper($orderLists[0]->user_name) }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                        <div class="col">{{ $orderLists[0]->order_code }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-stopwatch me-2"></i> Order Date</div>
                                        <div class="col">{{ $orderLists[0]->created_at->format('j-F-Y') }}</div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-dollar-sign me-2"></i> Total Price</div>
                                        <div class="col">{{ $order->total_price }} Kyats</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>QTY</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderLists as $orderList)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td>{{ $orderList->id }}</td>
                                        <td class="col-2"><img src="{{ asset('storage/' . $orderList->product_image) }}"
                                                class="img-thumbnail">
                                        </td>
                                        <td>{{ $orderList->product_name }}</td>
                                        <td>{{ $orderList->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $orderList->qty }}</td>
                                        <td>{{ $orderList->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
