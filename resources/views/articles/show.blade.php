@extends('layouts.app')

@section('content')
    @isset($article)
        <h5 class="card-title">{{ $article->id }} - {{ $article->designation }}</h5>
        <h5 class="card-title">{{ $article->designation }}</h5>
        <p class="card-text">{{ $article->description }}</p>
        <p class="card-text">{{ $article->stock }}</p>
        <p class="card-text">{{ $article->price }}</p>
        @if(count($article->matters))
            @foreach($article->matters as $matter)
                <p class="card-text">{{ $matter->designation }}</p>
            @endforeach
        @endif
        @if(count($article->types))
            @foreach($article->types as $type)
                <p class="card-text">{{ $type->designation }}</p>
            @endforeach
        @endif
        @if(count($article->images))
            @foreach($article->images as $image)
                <img class="card-img-top" data-src="{{ asset("storage/$image->src") }}" alt="{{ $image->alt }}" style="height: 180px; width: 100%; display: block;" src="{{ asset("storage/$image->src") }}" data-holder-rendered="true">
            @endforeach
        @endif
    @endisset
@endsection