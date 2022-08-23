<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="registration-form">
        <form method="POST" action="{{ route('auth.postlogin')  }}">
        @csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>

            @if (session('msg'))
                <div class="alert alert-success text-center">{{session('msg')}}</div>
            @endif

            @error('msg')
                <div class="alert alert-danger text-center">{{$message}}</div>
            @enderror
            <div class="form-group">
                <input name='username' type="text" class="form-control item" id="username" placeholder="Tên người dùng">
                @error('username')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control item" id="password" placeholder="Mật khẩu">
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Đăng nhập</button>
            </div>
            <div class="forget-password text-center">Quên mật khẩu?</div>
        </form>

        <div class="social-media">
            <h5>Bạn chưa có tài khoản? <a href="{{route('auth.getRegister')}}">Đăng kí ngay</a>  </h5>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
