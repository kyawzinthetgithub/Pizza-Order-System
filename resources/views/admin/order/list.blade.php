@extends('admin.layout.master')

@section('title', 'Pizza Products List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    <div class="row">
                        <form action="{{ route('admin#changeStatus') }}" method="GET" class="col-5">
                            @csrf
                            <div class="form-group d-flex align-items-center">
                                <select name="orderStatus" id="orderStatus" class="form-select">
                                    <option value="">All</option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                    </option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <button type="submit" class="btn btn-dark rounded">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i> Search</button>
                            </div>
                        </form>
                        <div class="col-1 offset-3 bg-light text-center rounded shadow-sm d-flex align-items-center my-2">
                            <h5 class=""> <i class="fa-solid fa-database me-2"> </i> {{ count($orders) }}
                            </h5>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orders as $order)
                                    <tr class="tr-shadow">
                                        <input type="hidden" name="" class="orderId" value="{{ $order->id }}">
                                        <td class="align-center">{{ $order->user_id }}</td>
                                        <td class="align-center">{{ $order->user_name }}</td>
                                        <td class="align-center">{{ $order->created_at->format('j-F-Y') }}</td>
                                        <td class="align-center">
                                            <a href="{{ route('admin#listInfo', $order->order_code) }}"
                                                class="text-primary">{{ $order->order_code }}</a>
                                        </td>
                                        <td class="align-center">{{ $order->total_price }} Kyats</td>
                                        <td class="align-center">
                                            <select name="status" id=""
                                                class="form-control text-center statusChanges">
                                                <option value="0" @if ($order->status == 0) selected @endif>
                                                    Pending
                                                </option>
                                                <option value="1" @if ($order->status == 1) selected @endif>
                                                    Accept
                                                </option>
                                                <option value="2" @if ($order->status == 2) selected @endif>
                                                    Reject
                                                </option>
                                            </select>
                                        </td>
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
@section('custormJQuery')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $status = $(this).val();

            //     $.ajax({
            //         type: 'get',
            //         url: '/order/ajax/status',
            //         data: {
            //             'status': $status
            //         },
            //         dataType: 'json',
            //         success: function(response) {

            //             //append data from database
            //             $list = '';
            //             for (let i = 0; i < response.length; i++) {

            //                 let months = ['January', 'February', 'March', 'April', 'May',
            //                     'June', 'July', 'August', 'September', 'October',
            //                     'November', 'December'
            //                 ];
            //                 let DBdate = new Date(response[i].created_at);
            //                 const finalDate = DBdate.getDate() + "-" + months[DBdate
            //                     .getMonth()] + "-" + DBdate.getFullYear();

            //                 if (response[i].status == 0) {
            //                     $message = `
        //                         <select name="status" id="" class="form-control text-center statusChanges">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
            //                 } else if (response[i].status == 1) {
            //                     $message = `
        //                         <select name="status" id="" class="form-control text-center statusChanges">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;

            //                 } else if (response[i].status == 2) {
            //                     $message = `
        //                         <select name="status" id="" class="form-control text-center statusChanges">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                     `;

            //                 }


            //                 $list += `
        //                             <tr class="tr-shadow">
        //                                 <input type="hidden" name="" class="orderId" value="${response[i] . id}">
        //                                 <td class="align-center"> ${response[i] . user_id} </td>
        //                                 <td class="align-center">${response[i] . user_name}</td>
        //                                 <td class="align-center">${finalDate}</td>
        //                                 <td class="align-center">${response[i] . order_code}</td>
        //                                 <td class="align-center">${response[i] . total_price} Kyats </td>
        //                                 <td class="align-center">${$message}</td>
        //                             </tr>
        //                         `;
            //             }
            //             $('#dataList').html($list);
            //         }
            //     });

            // });

            //change status
            $('.statusChanges').change(function() {
                $parentNode = $(this).parents('tr');
                $currentValue = $(this).val();
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'orderId': $orderId,
                    'status': $currentValue
                };

                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    dataType: 'json',
                    data: $data,
                    success: function(response) {

                    }
                });

            });

        });
    </script>
@endsection
