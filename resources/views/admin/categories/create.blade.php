@extends('layout.app')
@section('content')
    <h2 class="text-center my-3">Thêm danh mục</h2>
    @if (session('msg'))
        <div class="alert alert-success text-center my-2 mx-auto w-50">{{ session('msg') }}</div>
    @endif

    @error('msg')
        <div class="alert alert-danger text-center my-2 mx-auto w-50">{{ $message }}</div>
    @enderror
    <div class="card mx-auto w-50">
        <div class="card-header">
            Thêm danh mục
        </div>

        <div class="card-body">
            <form method="post" action="{{ route('categories.store') }}">
                @csrf
                <div class="form-group">
                    <label for="Name">Tên danh mục</label>
                    <input type="text" name="name" class="form-control" id="Name" placeholder="Nhập tên danh mục...">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputState">Kích hoạt</label>
                    <select name="active" id="inputState" class="form-control">
                        <option class="text-success" value="1"> Kích hoạt </option>
                        <option class="text-danger" value="0"> Không kích hoạt </option>
                    </select>
                </div>
                <div class="form-group mx-auto row">
                    <button type="submit" class="btn btn-primary col-3">Thêm danh mục</button>
                    <a role="button" class="text-white nav-link btn btn-danger mx-3 col-3"
                        href="{{ route('categories.index') }}">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
