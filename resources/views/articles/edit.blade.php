@extends('layouts.app')

@section('content')
    {{ Form::model($article, ['method' => 'PUT', 'route' => ['articles.store', $article->id]], 'files' => true) }}
    {{ Form::label('designation', 'Désignation') }}<br>
    {{ Form::text('designation') }}<br>

    {{ Form::label('description', 'Description') }}<br>
    {{ Form::textarea('description') }}<br>

    {{ Form::label('stock', 'Stock') }}<br>
    {{ Form::text('stock') }}<br>

    {{ Form::label('price', 'Prix') }}<br>
    {{ Form::text('price') }}<br>

    @foreach($articles->images as $image)
        {{ Form::label("images", 'Image') }}<br>
        {{ Form::file("images[]") }}<br>
    @endforeach

    {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection