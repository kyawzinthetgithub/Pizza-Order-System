@extends('admin.layout.master')

@section('title', 'Category List Page')

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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>

                    @if (session('deletedSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <p class="text-white"><i class="fa-solid fa-person-circle-minus me-2">
                                    </i>{{ session('deletedSuccess') }}</p>
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
                            <form action="{{ route('admin#list') }}" method="get">
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
                            <h5> <i class="fa-solid fa-users-gear me-2"></i> {{ $admins->total() }}</h5>
                        </div>
                    </div>


                    @if (count($admins) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr class="tr-shadow">
                                            <td>
                                                @if ($admin->image == null)
                                                    @if ($admin->gender == 'male')
                                                        <img src="{{ asset('img/default_user.png') }}" width="70px">
                                                    @else
                                                        <img src="{{ asset('img/default_female.png') }}" width="70px">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $admin->image) }}" width="70px">
                                                @endif
                                            </td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ ucfirst($admin->gender) }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>{{ $admin->address }}</td>
                                            <td>
                                                <input type="hidden" name="userId" id="userId"
                                                    value="{{ $admin->id }}">
                                                <select name="" class="btn-outline-secondary changeRoles">
                                                    <option value="user" @if ($admin->role == 'user') selected @endif
                                                        @if ($admin->id == Auth::user()->id) disabled @endif>User</option>
                                                    <option value="admin"
                                                        @if ($admin->role == 'admin') selected @endif>Admin</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">

                                                    {{-- <a href="{{ route('admin#changeRole', $admin->id) }}">
                                                        @if (Auth::user()->id == $admin->id)
                                                        @else
                                                            <button class="item me-2" data-toggle="tooltip"
                                                                data-placement="top" title="Change Admin Role">
                                                                <i class="fa-solid fa-retweet"></i>
                                                            </button>
                                                        @endif
                                                    </a> --}}

                                                    <a href="{{ route('admin#delete', $admin->id) }}">
                                                        @if (Auth::user()->id == $admin->id)
                                                        @else
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        @endif
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $admins->links() }}
                            </div>

                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-3">There is no Category !</h3>
                    @endif
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

            $('.changeRoles').change(function() {
                $currentValue = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();
                $data = {
                    'userId': $userId,
                    'role': $currentValue
                };

                $.ajax({
                    type: 'get',
                    url: '/admin/change/role',
                    dataType: 'json',
                    data: $data
                });

                location.reload();

            });

        });
    </script>
@endsection
