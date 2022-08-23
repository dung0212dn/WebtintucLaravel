@extends('layout.app')
@push('styles')
<link href="{{ asset('css/newslayout.css') }}" rel="stylesheet">
@endpush
@section('content')
<main class="container">
    <header class="header">
        <p class="subheading">Đăng vào {{$news->created_at}}</p>
        <h1 class="heading">{{$news->title}}</h1>
    </header>
    <section class="content m-auto w-75">
       {!!$news->content!!}
    </section>
</main>
@endsection
