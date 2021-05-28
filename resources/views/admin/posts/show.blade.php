@extends('layouts.main')

@section('pageTitle')
	{{$post->title}}
@endsection

@section('content')
	<p><strong>data:</strong> {{$post->date}}</p>
	<p><strong>stato:</strong> {{$post->published ? 'pubblicato' : 'non pubblicato'}}</p>
  <div><strong>tags: </strong>
		@foreach ($post->tags as $tag)
			<span class="badge badge-success">{{$tag->name}}</span>
		@endforeach
	</div>
  
	<p class="mt-3"><strong>contenuto:</strong> {{$post->content}}</p>
	
	@if ($post->comments->isNotEmpty())
	<div class="mt-5">
		<h3>Commenti</h3>

		<ul class="comments_list">
			@foreach ($post->comments as $comment)
				<li>
					<div class="comment mt-3 bt-3">
						<div class="comment_container">
							<h5>{{$comment->name ? $comment->name : 'Anonimo'}}</h5>
							<p>{{$comment->content}}</p>
						</div>

						<div class="delete_container mt-3">
							<form action="{{route('admin.comments.destroy', ['comment' => $comment->id])}}" method="post">
								@csrf
								@method('DELETE')
								
								<button type="submit" class="btn btn-danger">Elimina</button>
							</form>
						</div>
					</div>
				</li>
			@endforeach
		</ul>
    
	</div>
	@endif

	<a href="{{route('admin.posts.index')}}">Torna alla lista degli articoli</a>
@endsection