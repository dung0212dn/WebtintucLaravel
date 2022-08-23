@extends('layout.app')
@section('content')
    <h2 class="text-center my-3">Quản lý người dùng</h2>
    <a role="button" class="text-white nav-link btn btn-primary mx-auto col-2" href="{{ route('user.create') }}">Thêm người
        dùng</a>
    @if (session('msg'))
        <div class="alert alert-success text-center mx-auto w-50 my-3">{{ session('msg') }}</div>
    @endif

    @error('msg')
        <div class="alert alert-danger text-center mx-auto w-50 my-3">{{ $message }}</div>
    @enderror
    <table class="my-4 table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th class="col-1" scope="col">ID</th>
                <th class="col-2" scope="col">Tên người dùng</th>
                <th class="col-2" scope="col">Tên đăng nhập</th>
                <th scope="col">Mật khẩu</th>
                <th scope="col">Email</th>
                <th class="col-1" scope="col">Vai trò</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($users as $key => $user)
                <tr>
                    <td class="col-1" data-label="ID">{{ $user->id }}</td>
                    <td class="col-2" data-label="Name">{{ $user->name }}</td>
                    <td class="col-2" data-label="Username">{{ $user->username }}</td>
                    <td data-label="Password" class="overflow-hidden text-nowrap"
                        style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $user->password }}</td>
                    <td data-label="Email">{{ $user->email }}</td>
                    <td class="col-1" data-label="Role">{{ $user->role }}</td>
                    <td data-label="Control" class="row m-0">
                        @if (Auth::user()->id == $user->id)
                        <a role="button" class="text-white nav-link disabled btn btn-success mx-auto col-4"
                        href="{{ route('user.show', [$user->id]) }}">Sửa</a>
                        <button type="button" class="btn btn-danger disabled mx-auto col-4 " data-toggle="modal"
                        data-target="#exampleModal" data-name="{{ $user->name }}"
                        data-id="{{ $user->id }}">Xoá</button>
                       @else
                        <a role="button" class="text-white nav-link btn btn-success mx-auto col-4"
                            href="{{ route('user.show', [$user->id]) }}">Sửa</a>
                        <button type="button" class="btn btn-danger mx-auto col-4 " data-toggle="modal"
                            data-target="#exampleModal" data-name="{{ $user->name }}"
                            data-id="{{ $user->id }}">Xoá</button>
                            @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $users->links('vendor.pagination.paginationcustom') }}</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-delete" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        Bạn có chắc muốn xoá người dùng?
                        <input type="text" name='id' hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Xoá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name')
            var modal = $(this)
            var route = "{{ route('user.destroy', [" + id + "])}}"
            modal.find('.modal-title').text('Xoá người dùng ' + name)
            modal.find('.modal-body input').val(id)
            modal.find('#form-delete').attr("action", route)
        })
    </script>
@endsection
