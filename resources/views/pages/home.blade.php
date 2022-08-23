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
    <section class="banner-sec" style="background-color: #EBEBEB ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-0 top-slider " style="max-height:450px;">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for slides -->

                        <div class="carousel-inner my-4" role="listbox">
                            @for ($i = 0; $i < 3; $i++)
                                @php
                                    $news = $randNews->random();
                                @endphp
                                @if ($i == 0)
                                    <div class="carousel-item active">
                                        <img class="card-img" width="100%" height="330px"
                                            src="{{ asset('images/' . $news[$i]->picIntro) }}" alt="Card image">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                            <div class="news-title">
                                                <h2 class=" title-large "><a class="link-news"
                                                        href="{{ route('page.show', [$news[$i]->id]) }}">{{ $news[$i]->title }}</a>
                                                </h2>
                                            </div>
                                            <div class="news-des text-light">{{ $news[$i]->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img class="card-img" width="100%" height="330px"
                                            src="{{ asset('images/' . $news[$i]->picIntro) }}" alt="Card image">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                            <div class="news-title">
                                                <h2 class=" title-large "><a class="link-news"
                                                        href="{{ route('page.show', [$news[$i]->id]) }}">{{ $news[$i]->title }}</a>
                                                </h2>
                                            </div>
                                            <div class="news-des text-light">{{ $news[$i]->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-6 my-2">
                    <div class="row mt-3">
                        @for ($i = 0; $i < 4; $i++)
                            @php
                                $news = $randNews->random();
                            @endphp
                            <div class="col-md-6 mb-4">
                                <div class="card bg-dark text-white">
                                    <img class="card-img" src="{{ asset('images/' . $news[$i]->picIntro) }}"
                                        height="150px" alt="Card image">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                                        <h5 class="card-title "><a class="link-news2"
                                                href="{{ route('page.show', [$news[$i]->id]) }}">{{ $news[$i]->title }}</a>
                                        </h5>
                                        <small class="news-des text-light">{{ $news[$i]->created_at->diffForHumans() }}
                                        </small>
                                    </div>

                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main role="main" class="mt-3 container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <div class="new-feed">
                    <h5 class="pb-1 mb-4 font-italic border-bottom">
                        <div class="link-category text-primary text-uppercase">Tin mới</div>
                    </h5>
                    <div class="row mb-3">
                        @foreach ($newsNews as $key => $newsNew)
                            <div class="col-6 mb-3">
                                <div class="card flex-row" style="max-height:120px; height:120px">
                                    <img class="card-img-left example-card-img-responsive" width="35%"
                                        src="{{ asset('images/' . $newsNew->picIntro) }}" />
                                    <div class="card-body p-2">
                                        <h5 class="card-title "><a class="link-news3"
                                                href="{{ route('page.show', [$newsNew->id]) }}">{{ $newsNew->title }}</a>
                                        </h5>
                                        <small class="d-flex flex-row justify-content-end news-des position-absolute"
                                            style="bottom: 10px; right:10px">{{ $newsNew->created_at->diffForHumans() }}
                                        </small>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">{{ $newsNews->links('vendor.pagination.paginationcustom') }}</div>
                </div>

                <div class="category-post">
                    @php
                        $firstCategory = '';
                    @endphp
                    @for ($i = 0; $i < 2; $i++)
                        @php
                            $category = $categories->random();

                            if ($category == $firstCategory) {
                                $category = $categories->random();
                            } else {
                                $firstCategory = $category;
                            }
                        @endphp
                        <h5 class="pb-1 mb-4 font-italic border-bottom">
                            <a href="#" class="link-category text-uppercase">{{ $category->name }}</a>
                        </h5>
                        <div class="row mb-3">
                            @for ($j = 0; $j < 4; $j++)
                                @php
                                    $news = $randNews[$category->id];
                                @endphp
                                <div class="col-6 mb-3">
                                    <div class="card flex-row" style="max-height:120px; height:120px">
                                        <img class="card-img-left example-card-img-responsive" width="35%"
                                            src="{{ asset('images/' . $news[$j]->picIntro) }}" />
                                        <div class="card-body p-2">
                                            <h5 class="card-title "><a class="link-news3"
                                                    href="{{ route('page.show', [$news[$j]->id]) }}">{{ $news[$j]->title }}</a>
                                            </h5>
                                            <small class="d-flex flex-row justify-content-end news-des position-absolute"
                                                style="bottom: 10px; right:10px">{{ $news[$j]->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @endfor
                </div>
            </div><!-- /.blog-main -->
            <aside class="col-md-4 blog-sidebar">
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">About</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis
                        consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="#">March 2014</a></li>
                        <li><a href="#">February 2014</a></li>
                        <li><a href="#">January 2014</a></li>
                        <li><a href="#">December 2013</a></li>
                        <li><a href="#">November 2013</a></li>
                        <li><a href="#">October 2013</a></li>
                        <li><a href="#">September 2013</a></li>
                        <li><a href="#">August 2013</a></li>
                        <li><a href="#">July 2013</a></li>
                        <li><a href="#">June 2013</a></li>
                        <li><a href="#">May 2013</a></li>
                        <li><a href="#">April 2013</a></li>
                    </ol>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>
            </aside><!-- /.blog-sidebar -->



        </div><!-- /.row -->
        <div class="container p-0">
            <h3 class="pb-1 mb-4 font-italic border-bottom">
                <div class="link-category text-primary text-uppercase">Tin nổi bật</div>
            </h3>

            <div class="slide-news p-3 " style="background-color: #EBEBEB ">
                <div class="row">
                    <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
                        <!--Controls-->
                        <div class="controls-top d-flex flex-row justify-content-end pb-3">
                            <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i
                                    class="fa fa-chevron-left" style="font-size: 30px"></i></a>
                            <a class="btn-floating" href="#multi-item-example" data-slide="next"><i
                                    class="fa fa-chevron-right" style="font-size: 30px"></i></a>
                        </div>
                        <!--/.Controls-->

                        <!--Indicators-->
                        {{-- <ol class="carousel-indicators">
                            <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                            <li data-target="#multi-item-example" data-slide-to="1"></li>
                            <li data-target="#multi-item-example" data-slide-to="2"></li>
                        </ol> --}}
                        <!--/.Indicators-->

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            <!--First slide-->
                            @for ($i = 0; $i < 3; $i++)
                                @if ($i == 0)
                                    <div class="carousel-item active">

                                        <div class="row">
                                            @for ($j = 0; $j < 4; $j++)
                                                @php
                                                    $news = $randNews->random();
                                                @endphp
                                                @if ($j == 0)
                                                    <div class="col-md-3">
                                                        <div class="card mb-2"
                                                            style="max-height: 300px; height: 300px">
                                                            <img class="card-img-top" width=""
                                                                src="{{ asset('images/' . $news[$j]->picIntro) }}"
                                                                alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title "><a class="link-news3"
                                                                        href="{{ route('page.show', [$news[$j]->id]) }}">{{ $news[$j]->title }}</a>
                                                                </h5>
                                                                <small
                                                                    class="d-flex flex-row justify-content-end news-des position-absolute"
                                                                    style="bottom: 10px; right:10px">{{ $news[$j]->created_at->diffForHumans() }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-3 clearfix d-none d-md-block">
                                                        <div class="card mb-2"
                                                            style="max-height: 300px; height: 300px">
                                                            <img class="card-img-top"
                                                                src="{{ asset('images/' . $news[$j]->picIntro) }}"
                                                                alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title "><a class="link-news3"
                                                                        href="{{ route('page.show', [$news[$j]->id]) }}">{{ $news[$j]->title }}</a>
                                                                </h5>
                                                                <small
                                                                    class="d-flex flex-row justify-content-end news-des position-absolute"
                                                                    style="bottom: 10px; right:10px">{{ $news[$j]->created_at->diffForHumans() }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <!--/.First slide-->
                                @else
                                    <!--Second slide-->
                                    <div class="carousel-item">

                                        <div class="row">
                                            @for ($j = 0; $j < 4; $j++)
                                                @php
                                                    $news = $randNews->random();
                                                @endphp
                                                @if ($j == 0)
                                                    <div class="col-md-3">
                                                        <div class="card mb-2"
                                                            style="max-height: 300px; height: 300px">
                                                            <img class="card-img-top"
                                                                src="{{ asset('images/' . $news[$j]->picIntro) }}"
                                                                alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title "><a class="link-news3"
                                                                        href="{{ route('page.show', [$news[$j]->id]) }}">{{ $news[$j]->title }}{{ $news[$j]->category_id . '_' . $news[$j]->id }}</a>
                                                                </h5>
                                                                <small
                                                                    class="d-flex flex-row justify-content-end news-des position-absolute"
                                                                    style="bottom: 10px; right:10px">{{ $news[$j]->created_at->diffForHumans() }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-3 clearfix d-none d-md-block">
                                                        <div class="card mb-2"
                                                            style="max-height: 300px; height: 300px">
                                                            <img class="card-img-top"
                                                                src="{{ asset('images/' . $news[$j]->picIntro) }}"
                                                                alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title "><a class="link-news3"
                                                                        href="{{ route('page.show', [$news[$j]->id]) }}">{{ $news[$j]->title }}{{ $news[$j]->category_id . '_' . $news[$j]->id }}</a>
                                                                </h5>
                                                                <small
                                                                    class="d-flex flex-row justify-content-end news-des position-absolute"
                                                                    style="bottom: 10px; right:10px">{{ $news[$j]->created_at->diffForHumans() }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <!--/.Second slide-->
                                @endif
                            @endfor
                        </div>
                        <!--/.Slides-->
                    </div>
                </div>
            </div>
        </div>


    </main><!-- /.container -->
@endsection
