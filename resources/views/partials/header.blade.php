<header>
  <div class="container mt-5">
    <a class="title" href="{{route('guest.posts.index')}}"><h1 class="text-center">Boolpress</h1></a>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
      @foreach ($tags as $tag)
      <a class="p-2 text-muted" href="{{route('guest.posts.filter-by-tag', ['slug' => $tag->slug])}}">{{$tag->name}}</a>
      @endforeach
      </nav>
    </div>
  </div>
</header>