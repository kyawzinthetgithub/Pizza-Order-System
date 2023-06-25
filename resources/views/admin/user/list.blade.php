@extends('admin.layout.master')

@section('title', 'Pizza Products List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    <div class="col-1 offset-11 bg-light text-center rounded shadow-sm d-flex align-items-center py-2 my-2">
                        <h5 class="mx-auto"> <i class="fa-solid fa-users me-2"></i> {{ count($users) }} </h5>
                    </div>

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
                            <tbody id="dataList">
                                @foreach ($users as $user)
                                    <tr class="tr-shadow text-center">
                                        <td>
                                            @if ($user->image == null)
                                                @if ($user->gender == 'male')
                                                    <img src="{{ asset('img/default_user.png') }}" width="60px">
                                                @else
                                                    <img src="{{ asset('img/default_female.png') }}" width="60px">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $user->image) }}" width="60px">
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->gender) }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <input type="hidden" name="userImg" id="userImg" value="{{ $user->image }}">
                                            <input type="hidden" name="userId" id="userId"
                                                value="{{ $user->id }}">
                                            <select name="" class="btn-outline-secondary text-center changeRoles">
                                                <option value="user" @if ($user->role == 'user') selected @endif>
                                                    User</option>
                                                <option value="admin" @if ($user->role == 'admin') selected @endif>
                                                    Admin</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-danger rounded-circle deleteUsers"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">{{ $users->links() }}</div>
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
                    url: '/user/change/role',
                    dataType: 'json',
                    data: $data
                });

                location.reload();
            });

            $('.deleteUsers').click(function() {
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();
                $userImg = $parentNode.find('#userImg').val();
                $data = {
                    'userId': $userId,
                    'userImg': $userImg
                };

                $.ajax({
                    type: 'get',
                    url: '/user/delete/user',
                    dataType: 'json',
                    data: $data
                });

                location.reload();

            });
        });
    </script>
@endsection
