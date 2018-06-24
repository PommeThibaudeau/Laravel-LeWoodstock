@extends('layouts.app')

@section('content')

    <h1>Ajouter une création</h1>

    {{ Form::model($article, ['method' => 'POST', 'route' => 'articles.store', 'files' => true]) }}
        {{ Form::label('designation', 'Désignation') }}<br>
        {{ Form::text('designation', old('designation')) }}<br>

        {{ Form::label('description', 'Description') }}<br>
        {{ Form::textarea('description', old('description')) }}<br>

        {{ Form::label('stock', 'Stock') }}<br>
        {{ Form::text('stock', old('stock')) }}<br>

        {{ Form::label('price', 'Prix') }}<br>
        {{ Form::text('price', old('price')) }}<br>

        {{ Form::label("type", 'Type') }}<br>
        {{ Form::select("type", $types, old('type'), ['class' => 'chosen-select']) }}<br>

        {{ Form::label("matters", 'Matières') }}<br>
        {{ Form::select('matters[]', $matters, old('$matters[]'), ['class' => 'chosen-select', 'multiple' => 'multiple']) }}

        @for($i=0;$i<5;++$i)
            {{ Form::label("images", 'Images') }}<br>
            {{ Form::file("images[]") }}<br>
        @endfor

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection
