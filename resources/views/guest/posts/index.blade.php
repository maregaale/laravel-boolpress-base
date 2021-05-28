@extends('layouts.guest_main')

@section('pageTitle')
  Home Page
@endsection

@section('content')
  <div class="container mt-5">
    <div class="row">
      @if ($posts->isEmpty())
      <div class="col-sm-6 offset-sm-3 mt-5">
        <h2 class="text-center">non ci sono post collegati a questo tag</h2>
      <div>
      @else
      
      @foreach ($posts as $post)
      <div class="col-sm-6">
        <div class="post">
          <h3>{{$post->title}}</h3>
          <p>{{$post->date}}</p>
          <p class="content">{{$post->content}}</p>

          <div class="info">
            <a href="{{route('guest.posts.show', ['slug' => $post->slug])}}">Leggi di più</a>
          </div>
        </div>
      </div>
      @endforeach
          
      @endif
    </div>
  </div>
@endsection