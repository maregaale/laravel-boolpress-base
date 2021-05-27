@extends('layouts.guest_main')

@section('pageTitle')
  Home Page
@endsection

@section('content')
  <div class="container mt-5">
    <div class="row">
      @foreach ($posts as $post)
          <div class="col-sm-6">
            <div class="post">
              <h3>{{$post->title}}</h3>
              <p>{{$post->date}}</p>
              <p class="content">{{$post->content}}</p>

              <div>
                <a href="{{route('guest.posts.show', ['slug' => $post->slug])}}">Leggi di più</a>
              </div>
            </div>
          </div>
      @endforeach
    </div>
  </div>
@endsection