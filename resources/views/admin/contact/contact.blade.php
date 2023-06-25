@extends('admin.layout.master')

@section('title', 'Customer Contact')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    @if (session('delete'))
                        <div class="offset-6 col-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('delete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="col-1 offset-11 bg-light text-center rounded shadow-sm d-flex align-items-center py-2 my-2">
                        <h5 class="mx-auto"> <i class="fa-solid fa-message me-2"></i> {{ count($messages) }} </h5>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($messages as $message)
                                    <tr class="tr-shadow text-center">
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ Str::words($message->message, 5, ' ....') }}</td>
                                        <td>
                                            <a href="{{ route('admin#detailMessage', $message->id) }}">
                                                <button class="rounded-circle btn btn-sm btn-secondary mx-2"
                                                    data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="fa-solid fa-info p-1"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#deleteMessage', $message->id) }}">
                                                <button class="rounded-circle btn btn-sm btn-danger mx-2"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="my-2">{{ $messages->links() }}</div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
