@extends('layouts.main')

@section('pageTitle')
    Tags
@endsection

@section('content')
  <div class="mb-3 text-right">
    <a href="{{route('admin.tags.create')}}"><button type="button" class="btn btn-success"><i class="fas fa-plus-square"></i> Aggiungi Tag</button></a>
  </div>
  <table class="table table-striped tags">
    <thead>
      <tr>
       
        <th calss="tag_name" scope="col">Nome</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach ($tags as $tag)
      <tr>
       
        <td>{{$tag->name}}</td>
        
        <td class="delete_tag">
          <form class="mt-1 mb-1" action="{{route('admin.tags.destroy', ['tag' => $tag->id])}}" method="POST">
            @csrf
            @method('DELETE')
  
            <button type="submit" class="btn btn-danger">Elimina</i></button></a>
          </form>

          <a href="{{route('admin.tags.edit', ['tag' => $tag->id])}}"><button type="button" class="btn btn-secondary">Modifica</i></button></a>
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