@extends('layouts.main')

@section('pageTitle')
    Posts
@endsection

@section('content')
  <div class="mb-3 text-right">
    <a href="{{route('admin.posts.create')}}"><button type="button" class="btn btn-success"><i class="fas fa-plus-square"></i> Aggiungi Post</button></a>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Immagine</th>
        <th scope="col">Titolo</th>
        <th scope="col">Data</th>
        <th scope="col">Pubblicato</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($posts as $post)
      <tr>
        <td><img src="{{$post->image ? $post->image : 'https://via.placeholder.com/200'}}" alt="{{$post->title}}" style="width: 100px"></td>
        <td>{{$post->title}}</td>
        <td>{{$post->date}}</td>
        <td>{{$post->published}}</td>
        <td>
          <a href="{{route('admin.posts.show', [ 'post' => $post->id ])}}"><button type="button" class="btn btn-primary">Visualizza</i></button></a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  @if (session('message'))
      <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 30px">
          {{ session('message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"> &times;</span>
      </button>
      </div>
  @endif
@endsection