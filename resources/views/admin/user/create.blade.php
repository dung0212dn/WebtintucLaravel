@extends('layout.app')
@section('content')
    <h2 class="text-center my-3">Thêm người dùng</h2>
    @if (session('msg'))
        <div class="alert alert-success text-center my-2 mx-auto w-50">{{ session('msg') }}</div>
    @endif

    @error('msg')
        <div class="alert alert-danger text-center my-2 mx-auto w-50">{{ $message }}</div>
    @enderror
    <div class="card mx-auto w-50">
        <div class="card-header">
            Thêm người dùng
        </div>

        <div class="card-body">
            <form method="post" action="{{ route('user.store') }}">
                @csrf

                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" name='email' class="form-control" id="Email" aria-describedby="emailHelp"
                        placeholder="Nhập email...">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Name">Tên người dùng</label>
                    <input type="text" name="name" class="form-control" id="Name" placeholder="Nhập tên người dùng...">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Username">Tên đăng nhập</label>
                    <input type="text" name='username' class="form-control" id="Username" placeholder="Nhập tên đăng nhập...">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Password">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="Password" placeholder="Nhập mật khẩu...">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputState">Vai trò</label>
                    <select name="role" id="inputState" class="form-control">
                        <option value="guest" selected>Khách</option>
                        <option value="creator">Cộng tác viên</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>
                <div class="form-group mx-auto row">
                    <button type="submit" class="btn btn-primary col-3">Thêm người dùng</button>
                    <a role="button" class="text-white nav-link btn btn-danger mx-3 col-3"
                        href="{{ route('user.index') }}">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
