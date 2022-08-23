@extends('layout.app')
@section('content')
    <div class="bg-light nav-scroller ">
        <nav class="nav w-75 m-auto d-flex justify-content-between">
            @foreach ($categories as $key => $category)
                <a class="p-2 nav-item-custom text-dark text-uppercase"
                    href="{{ route('page.category', [$category->id]) }}">{{ $category->name }}</a>
            @endforeach
        </nav>
    </div>
    <main role="main" class="mt-3 container">
        <div class="row">
            <div class="col-md-12 blog-main">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="m-0">Kết quả tìm kiếm: {{ $keyword }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($allNews->count() == 0)
                            <h5 class="text-center">Không có kết quả khả dụng</h5>
                        @else
                            @foreach ($allNews as $news)
                                <div class="card flex-row  p-2"
                                    style="max-height:150px; height:150px; border:none; border-bottom:2px solid rgb(185, 185, 185); border-radius:0px ">
                                    <img class="card-img-left example-card-img-responsive col-3" width="100%"
                                        src="{{ asset('images/' . $news->picIntro) }}" />
                                    <div class="card-body px-4 py-0 col-9">
                                        <h5 class="card-title"><a class="link-news3"
                                                href="{{ route('page.show', [$news->id]) }}">
                                                <h4>{{ $news->title }}</h4>
                                            </a>
                                        </h5>
                                        <p class="m-0">{!! $news->sumary !!}</p>
                                        <small class="d-flex flex-row justify-content-end news-des position-absolute"
                                            style="bottom: 10px; right:10px">{{ $news->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="text-center">{{ $allNews->links('vendor.pagination.paginationcustom') }}</div>
                </div>
            </div><!-- /.blog-main -->

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
