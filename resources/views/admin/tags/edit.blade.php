@extends('layouts.main')

@section('pageTitle')
	modifica il tag {{$tag->name}}
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('admin.tags.update', ['tag' => $tag->id])}}" method="POST">
	@csrf
	@method('PUT')

	<div class="form-group">
		<label for="name">Nome</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$tag->name}}">
	</div>
	

	
	<div class="mt-3">
		<button type="submit" class="btn btn-primary">Modifica</button>
	</div>
</form>
	
@endsection