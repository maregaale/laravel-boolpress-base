@extends('layouts.guest_main')

@section('pageTitle')
  {{$post->title}}
@endsection


@section('content')
  <div class="post_single container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-9">
        <h2>{{$post->title}}</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-9">
        <h5>{{$post->date}}</h5>
      </div>
    </div>
    <div class="row justify-content-center">

      <div class="col-sm-9">
        <p>{{$post->content}}</p>
      </div>

    </div>

    <div class="row justify-content-center mt-5">
      <div class="col-sm-9">
        <h3>Commenti:</h3>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-sm-9">
        <ul>
          @foreach ($post->comments as $comment)
          <li>
            <h6>{{$comment->name ? $comment->name : 'Anonimo'}}</h6>
            <p>{{$comment->content}}</p>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection