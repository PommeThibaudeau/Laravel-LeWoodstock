@extends('layouts.app')

@section('content')
    <div class="jumbotron container">
      <div class="card">
        <img src="{{ $article->images }}" alt="" class="card-img-top">
        <h4>{{ $article->designation }}</h4>
        <div class="card-body">
          <h5 class="card-title">{{ $article->price }} €</h5>
          <p class="card-text">{{ $article->description }}</p>
          <small>En stock : {{ $article->stock }} exemplaires.</small>
        </div>
      </div>
    </div>

@endsection
