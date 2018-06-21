@extends('layouts.app')

@section('content')
    @isset($article)
        <h5 class="card-title">{{ $article->designation }}</h5>
        <h5 class="card-title">{{ $article->designation }}</h5>
        <p class="card-text">{{ $article->description }}</p>
        <p class="card-text">{{ $article->stock }}</p>
        <p class="card-text">{{ $article->price }}</p>
        @if(count($article->matters))
            @foreach($article->matters as $matter)
                <p class="card-text">{{ $matter->designation }}</p>
            @endforeach
        @endif
        @isset($article->type)
            <p class="card-text">{{ $article->type->designation }}</p>
        @endisset
        @if(count($article->images))
            @foreach($article->images as $image)
                <img class="card-img-top" data-src="{{ Storage::url($image->src) }}" alt="{{ $article->designation }}" style="height: 180px; width: 180px; display: block;" src="{{ Storage::url($image->src) }}" data-holder-rendered="true">
            @endforeach
        @endif
    @endisset
@endsection