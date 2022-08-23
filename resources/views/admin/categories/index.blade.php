@extends('layout.app')
@section('content')
    <h2 class="text-center my-3">Quản lý danh mục</h2>
    <a role="button" class="text-white nav-link btn btn-primary my-3 mx-auto col-2" href="{{ route('categories.create') }}">Thêm
        danh mục</a>
    @if (session('msg'))
        <div class="alert alert-success text-center mx-auto w-50 my-3">{{ session('msg') }}</div>
    @endif

    @error('msg')
        <div class="alert alert-danger text-center mx-auto w-50 my-3">{{ $message }}</div>
    @enderror
    <table class="my-4 table-bordered w-75 m-auto">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($categories as $key => $category)
                <tr>
                    <td data-label="ID">{{ $category->id }}</td>
                    <td data-label="Name">{{ $category->name }}</td>
                    @if ($category->active == '1')
                        <td class="text-success" data-label="Name">Kích hoạt</td>
                    @else
                        <td class="text-danger" data-label="Name">Chưa kích hoạt</td>
                    @endif

                    <td data-label="Control" class="row m-0">
                        <a role="button" class="text-white nav-link btn btn-success mx-auto col-4"
                            href="{{ route('categories.show', [$category->id]) }}">Sửa</a>
                        <button type="button" class="btn btn-danger mx-auto col-4 " data-toggle="modal"
                            data-target="#exampleModal" data-name="{{ $category->name }}"
                            data-id="{{ $category->id }}">Xoá</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $categories->links('vendor.pagination.paginationcustom') }}</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-delete" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        Bạn có chắc muốn xoá danh mục?
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
            var route = "{{ route('categories.destroy', [' + id + ']) }}"
            modal.find('.modal-title').text('Xoá danh mục ' + name)
            modal.find('.modal-body input').val(id)
            modal.find('#form-delete').attr("action", route)
        })
    </script>
@endsection
