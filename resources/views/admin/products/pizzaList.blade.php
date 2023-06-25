@extends('admin.layout.master')

@section('title', 'Pizza Products List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('products#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i> Add Pizza
                                </button>
                            </a>
                        </div>
                    </div>


                    @if (session('changeSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible zoom-in show" role="alert">
                                <i class="fa-solid fa-check me-2"></i><small
                                    class="text-danger">{{ session('changeSuccess') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> <strong> {{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('updateSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-arrow-up me-2"></i>
                                <span>{{ session('updateSuccess') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row my-3">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('products#list') }}" method="get">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="key" id="" class="form-control"
                                        value="{{ request('key') }}" placeholder="Search...">
                                    <button type="submit" class="btn btn-dark"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1 offset-10 bg-light text-center rounded shadow-sm p-2">
                            <h5> <i class="fa-solid fa-database mr-2"> </i>{{ $pizzas->total() }}</h5>
                        </div>
                    </div>



                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Counts</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow">
                                            <td class="col-2 h-25"><img src="{{ asset('storage/' . $pizza->image) }}"
                                                    class="img-thumbnail rounded"></td>
                                            <td>{{ $pizza->name }}</td>
                                            <td>{{ $pizza->price }}</td>
                                            <td>{{ $pizza->category_name }}</td>
                                            <td><i class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('products#edit', $pizza->id) }}" class="mx-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Details">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('products#updatePage', $pizza->id) }}"
                                                        class="mx-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('products#delete', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $pizzas->links() }}
                            </div>

                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no {{ request('key') }} pizza here !</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
