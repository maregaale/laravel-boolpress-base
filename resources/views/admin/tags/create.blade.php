@extends('layouts.main')

@section('pageTitle')
	Crea un nuovo tag
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

<form action="{{route('admin.tags.store')}}" method="POST">
	@csrf
	@method('POST')

	<div class="form-group">
		<label for="name">Nome</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="Name">
	</div>
	

	
	<div class="mt-3">
		<button type="submit" class="btn btn-primary">Crea</button>
	</div>
</form>
	
@endsection