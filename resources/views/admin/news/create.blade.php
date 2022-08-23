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
            <form method="post" action="{{ route('news.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name='title' value="{{old('title')}}" class="form-control" id="title" placeholder="Nhập tiêu đề...">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sumary">Tóm tắt</label>
                    <textarea aria-valuetext="" name="sumary">{{old('sumary')}}</textarea>

                    @error('sumary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea value="{{old('content')}}" aria-valuetext="{{old('content')}}" name="content">{{old('content')}}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Intro">Hình ảnh</label>
                    <input type="file" value="{{old('image')}}" class="form-control-file" id="Intro" name='image'>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputState">Danh mục</label>
                    <select name="category" id="inputState" class="form-control">
                        @foreach ($categories as $key => $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">

                    <input type="hidden" name='author' class="form-control" value="{{ Auth::user()->id }}" id="author"
                        placeholder="Nhập nội dung..."  readonly>
                    @error('author')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mx-auto row">
                    <button type="submit" class="btn btn-primary col-3">Thêm bài viết</button>
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
