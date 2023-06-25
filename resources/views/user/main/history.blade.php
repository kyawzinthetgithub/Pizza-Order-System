@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height:500px;">

        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <a href="javascript:void(0)" class="nav-link ms-5 mb-3" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable" class="align-middle">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">{{ $order->created_at->format('j-F-Y') }}</td>
                                <td class="align-middle">{{ $order->order_code }}</td>
                                <td class="align-middle">{{ $order->total_price }}</td>
                                <td class="align-middle">
                                    @if ($order->status == 0)
                                        <span class="text-warning"><i class="fa-solid fa-hourglass-half me-2"></i>
                                            Panding</span>
                                    @elseif ($order->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check me-2"></i> Success</span>
                                    @elseif ($order->status == 2)
                                        <span class="text-danger"><i class="fa-solid fa-ban me-2"></i> Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-2">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
