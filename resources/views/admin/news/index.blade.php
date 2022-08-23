@extends('layout.app')
@section('content')
    <h2 class="text-center my-3">Quản lý bài viết</h2>
    <a role="button" class="text-white nav-link btn btn-primary my-3 mx-auto col-2" href="{{ route('news.create') }}">Thêm
        bài viết</a>
    @if (session('msg'))
        <div class="alert alert-success text-center mx-auto w-50 my-3">{{ session('msg') }}</div>
    @endif

    @error('msg')
        <div class="alert alert-danger text-center mx-auto w-50 my-3">{{ $message }}</div>
    @enderror
    <table class="my-4 table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="col-1" scope="col">ID</th>
                <th scope="col">Tiêu đề bài viết</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Ngày đăng</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allnews as $key => $news)
                <tr>
                    <td data-label="ID">{{ $news->id }}</td>
                    <td data-label="title">{{ $news->title }}</td>
                    <td data-label="imgIntro">
                        <img src="{{asset('images/'.$news->picIntro)}}" width="80%" alt="introPic">

                    </td>
                    @if ($news->active == '1')
                        <td class="text-success" data-label="Name">Kích hoạt</td>
                    @else
                        <td class="text-danger" data-label="Name">Chưa kích hoạt</td>
                    @endif
                    @foreach ($authors as $author)
                        @if ($author->id == $news->author_id)
                            <td data-label="title">{{ $author->name }}</td>
                        @endif
                    @endforeach
                    <td data-label="title">{{ $news->created_at }}</td>
                    <td data-label="Control">
                        <div class="row">
                            <a role="button" class="text-white nav-link btn btn-primary mx-auto col-3"
                                href="{{ route('news.show', [$news->id]) }}">Xem</a>

                            <a role="button" class="text-white nav-link btn btn-success mx-auto col-3"
                                href="{{ route('news.edit', [$news->id]) }}">Sửa</a>

                            <button type="button" class="btn btn-danger mx-auto col-3 " data-toggle="modal"
                                data-target="#exampleModal"
                                data-id="{{ $news->id }}">Xoá</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $allnews->links('vendor.pagination.paginationcustom') }}</div>

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
                        Bạn có chắc muốn xoá bài viết?
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
            var route = "{{ route('news.destroy',  [" + id + "])}}"
            modal.find('.modal-title').text('Xoá bài viết số ' + id)
            modal.find('.modal-body input').val(id)
            modal.find('#form-delete').attr("action", route)
        })
    </script>
@endsection
