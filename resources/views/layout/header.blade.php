<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #abdbe3;">
    @if (Auth::check() && Auth::user()->role == 'admin')
        <div class="nav-brand">
            <h3>QUẢN TRỊ VIÊN</h3>
        </div>
    @else
        <a class="navbar-brand" href="{{route('page.index')}}">
            <img width="100" src="https://cdnmobile.dantri.com.vn/dist/static-logo.1-0-1.329fb29fe0ea34cca545.svg"
                alt="">
        </a>
    @endif


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (!Auth::check() || Auth::user()->role != 'admin')
            <form method="get" action="{{route('page.search')}}" class="form-inline my-2 my-lg-0 ml-auto w-50">
                <input class="form-control mr-sm-2 w-75" name="keyword" type="search" placeholder="Nhập từ khoá tìm kiếm..."
                    aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
            </form>
        @endif
        @guest
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item">
                    <a role="button" class="text-white btn btn-success nav-link" href="{{ route('auth.getLogin') }}">Đăng
                        nhập</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-2">
                <li class="nav-item">
                    <a role="button" class="text-white nav-link btn btn-info" href="{{ route('auth.getRegister') }}">Đăng
                        kí</a>
                </li>
            </ul>
        @endguest

        @auth
            <ul class="navbar-nav ml-auto mr-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-user mr-2"></i>Xin chào,
                        @if (Auth::user()->role == 'admin')
                            <span class="badge badge-success">Admin</span>
                        @elseif (Auth::user()->role == 'creator')
                            <span class="badge badge-success">Creator</span>
                        @else
                            <span class="badge badge-success">Guest</span>
                        @endif
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->role == 'admin')
                            <a class="dropdown-item" href="{{ route('page.index') }}"><i
                                    class="fa-solid fa-house mr-2"></i>Trang chủ</a>
                            <a class="dropdown-item" href="{{ route('user.index') }}"><i
                                    class="fa-solid fa-user-group mr-2"></i>Quản lý người dùng</a>
                            <a class="dropdown-item" href="{{ route('categories.index') }}"><i
                                    class="fa-solid fa-book-bookmark mr-2"></i>Quản lý danh mục</a>
                        @endif
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'creator')
                            <a class="dropdown-item" href="{{ route('news.index') }}"><i
                                    class="fa-solid fa-newspaper mr-2"></i>Quản lý tin tức</a>
                        @endif

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('auth.getLogout') }}"> <i
                                class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Đăng xuất</a>
                    </div>
                </li>
            </ul>
        @endauth
    </div>
</nav>
