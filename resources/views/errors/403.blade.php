<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/403error.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>403 Error</title>
</head>
<body>
    <div class="text-wrapper">
        <div class="title" data-content="404">
            403 - TRUY CẬP BỊ TỪ CHỐI
        </div>

        <div class="subtitle">
          Bạn không có quyền truy cập trang này.
        </div>
        <div class="isi">
             A web server may return a 403 Forbidden HTTP status code in response to a request from a client for a web page or resource to indicate that the server can be reached and understood the request, but refuses to take any further action. Status code 403 responses are the result of the web server being configured to deny access, for some reason, to the requested resource by the client.
             </div>

        <div class="buttons">
            <a class="button" href="{{route('home')}}">Quay lại trang chủ</a>
        </div>
    </div>
</body>
</html>
