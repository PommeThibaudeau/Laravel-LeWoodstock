@extends('layouts.app')

@section('content')
<div class="container jumbotron">
      <h1>Nos articles</h1>
      <br>
      <div class="row">
        @if (count($articles))
          @foreach ($articles as $article)
            <div class="col-sm-4">
              <div class="card">
                <img src="{{ $article->images }}" alt="" class="card-img-top">
                <h4>{{ $loop->iteration }} - {{ $article->designation }}</h4>
                <div class="card-body">
                  <h5 class="card-title">{{ $article->price }} €</h5>
                  <p class="card-text">{{ $article->description }}</p>
                  <small>En stock : {{ $article->stock }} exemplaires.</small>
                  <div><a href="/articles/{{$article->id}}"><button class="btn btn-info">Lire la suite</button></a></div>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <h5>Aucune article disponible</h5>
        @endif
      </div>

</div>
@endsection
