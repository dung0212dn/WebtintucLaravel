@extends('layout.app')
@section('content')
    <h2 class="text-center my-3">Thêm tin tức</h2>
    @if (session('msg'))
        <div class="alert alert-success text-center my-2 mx-auto w-50">{{ session('msg') }}</div>
    @endif

    @error('msg')
        <div class="alert alert-danger text-center my-2 mx-auto w-50">{{ $message }}</div>
    @enderror
    <div class="card mx-auto w-50">
        <div class="card-header">
            Thêm tin tức
        </div>

        <div class="card-body">
            <form method="post" action="{{ route('news.update', [$news->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name='title' value="{{$news->title}}" class="form-control" id="title" placeholder="Nhập tiêu đề...">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sumary">Tóm tắt</label>
                    <textarea aria-valuetext="" name="sumary">{{$news->sumary}}</textarea>

                    @error('sumary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea value="{{old('content')}}" aria-valuetext="{{old('content')}}" name="content">{{$news->content}}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Intro">Hình ảnh</label>
                    <input type="file" class="form-control-file" id="Intro" name='image'>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputState">Danh mục</label>
                    <select name="category" id="inputState" class="form-control">
                        @foreach ($categories as $key => $category)
                            @if ($category->id == $news->category_id)
                            <option value="{{ $category->id }}" selected> {{ $category->name }} </option>
                            @else
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputState">Kích hoạt</label>
                    <select name="active" id="inputState" class="form-control">
                            @if ($news->active == '1')
                                <option class="text-success" value="1" selected> Kích hoạt </option>
                                <option class="text-danger" value="0"> Không kích hoạt </option>
                            @else
                                <option class="text-success" value="1"> Kích hoạt </option>
                                <option class="text-danger" value="0" selected> Không kích hoạt </option>
                            @endif
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name='author' class="form-control" value="{{ $news->author_id }}" id="author"
                        placeholder="Nhập nội dung..."  readonly>
                    @error('author')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mx-auto row">
                    <button type="submit" class="btn btn-primary col-3">Cập nhật bài viết</button>
                    <a role="button" class="text-white nav-link btn btn-danger mx-3 col-3"
                        href="{{ route('news.index') }}">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('sumary');
        CKEDITOR.replace('content');
    </script>
@endsection
