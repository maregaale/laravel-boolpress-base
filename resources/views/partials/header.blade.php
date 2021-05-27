<header>
  <div class="container mt-5">
    <h1 class="text-center">Boolpress</h1>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
      @foreach ($tags as $tag)
      <a class="p-2 text-muted" href="#">{{$tag->name}}</a>
      @endforeach
      </nav>
    </div>
  </div>
</header>