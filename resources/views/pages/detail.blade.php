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
    <main role="main" class="container ">
        <div class="row">
            <div class="col-md-8 blog-main pt-3" style="background-color:#fcfaf6">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $news->title }}</h2>
                    <p class="blog-post-meta">Đăng vào {{ date('d-m-Y H:i:s', strtotime($news->created_at)) }} by
                        @foreach ($users as $user)
                            @if ($user->id == $news->author_id)
                                <span class="text-primary">{{ $user->name }}</span>
                            @endif
                        @endforeach
                    </p>

                </div><!-- /.blog-post -->
                <div class="blog-post">
                    {{ $news->content }}
                </div>

                <div class="comment">

                </div>

            </div><!-- /.blog-main -->


            <aside class="col-md-4 pt-3 blog-sidebar">
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
        <div class="row mt-3">
            <div class="col-md-8 px-0">
                <h4 class="">Bình luận <span style="font-size: 20px"
                        class=" px-3 justify-content-end">{{ $comments->count() }} bình luận</span>
                </h4>

                <div class="coment-bottom bg-white p-2 px-3">
                    <div class=" add-comment-section mt-2 mb-2">
                        @if (Auth::check())
                            <form action="{{ route('page.comment') }}" method="post">
                                @csrf
                                <textarea name="comment" type="text" rows="5" cols="100" maxlength="600" class="form-control"
                                    placeholder="Nhập bình luận của bạn..."></textarea>
                                <input type="hidden" name="author_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="news_id" value="{{ $news->id }}">
                                <button class="btn btn-primary mt-3" type="submit">Bình luận</button>
                            </form>
                        @else
                            <h5 class="text-center text-primary">Vui lòng <a href="{{ route('auth.getLogin') }}">đăng
                                    nhập</a>để bình luận!</h5>
                        @endif
                    </div>
                    <div class="comments-box overflow-auto" style="max-height:500px; overflow-y:scroll">
                        @if ($comments->count() == 0)
                            <h5 class="text-center">Bạn hãy là người đầu tiên bình luận</h5>
                        @else
                            @foreach ($comments as $comment)
                                <div class="commented-section mt-2">
                                    <div class="d-flex flex-row align-items-center commented-user">
                                        <h5 class="mr-2">
                                            @foreach ($users as $user)
                                                @if ($user->id == $comment->author_id)
                                                    <span class=""><i
                                                            class="fa-solid fa-user-tie mr-2 rounded-circle p-2 bg-primary text-white"></i>{{ $user->name }}</span>
                                                @endif
                                            @endforeach
                                        </h5>
                                        <span class="dot mb-1"></span>
                                        <span class="mb-1 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="comment-text-sm"><span>{{ $comment->content }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main><!-- /.container -->
@endsection
