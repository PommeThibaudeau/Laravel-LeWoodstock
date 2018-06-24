@extends('layouts.app')

@section('content')
    {{ Form::model($article, ['method' => 'PUT', 'route' => ['articles.update', $article->id], 'files' => true]) }}
        {{ Form::label('designation', 'Désignation') }}<br>
        {{ Form::text('designation') }}<br>
        <span class="text-danger">{{ $errors->first('designation') }}</span><br>

        {{ Form::label('description', 'Description') }}<br>
        {{ Form::textarea('description') }}<br>
        <span class="text-danger">{{ $errors->first('description') }}</span><br>

        {{ Form::label('stock', 'Stock') }}<br>
        {{ Form::text('stock') }}<br>
        <span class="text-danger">{{ $errors->first('stock') }}</span><br>

        {{ Form::label('price', 'Prix') }}<br>
        {{ Form::text('price') }}<br>
        <span class="text-danger">{{ $errors->first('price') }}</span><br>

        {{ Form::label("type", 'Type') }}<br>
        {{ Form::select("type", $types, $article->type->getKey(), ['class' => 'chosen-select']) }}<br>
        <span class="text-danger">{{ $errors->first('type') }}</span><br>

        {{ Form::label("matters", 'Matières') }}<br>
        {{ Form::select("matters[]", $matters, $article->matters()->get(), ['class' => 'chosen-select', 'multiple' => 'multiple']) }}
        <span class="text-danger">{{ $errors->first('matters') }}</span><br>

        @foreach($article->images as $image)
            {{ Form::label("images", 'Image') }}<br>
                <img class="card-img-top" data-src="{{ Storage::url($image->src) }}" alt="{{ $article->designation }}" style="height: 180px; width: 180px; display: block;" src="{{ Storage::url($image->src) }}" data-holder-rendered="true">
            {{ Form::file("images[]") }}<br>
        @endforeach

        @for( $i = count($article->images); $i<5; ++$i)
            {{ Form::label("images", 'Image') }}<br>
            {{ Form::file("images[]") }}<br>
        @endfor

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection