@extends('layouts.app')

@section('content')
    {{ Form::model($article, ['method' => 'POST', 'route' => ['articles.store'], 'files' => true]) }}
        {{ Form::label('designation', 'Désignation') }}<br>
        {{ Form::text('designation') }}<br>

        {{ Form::label('description', 'Description') }}<br>
        {{ Form::textarea('description') }}<br>

        {{ Form::label('stock', 'Stock') }}<br>
        {{ Form::text('stock') }}<br>

        {{ Form::label('price', 'Prix') }}<br>
        {{ Form::text('price') }}<br>

        {{ Form::label("type", 'Type') }}<br>
        {{ Form::select("type", $types, null, ['class' => 'chosen-select']) }}<br>

        {{ Form::label("matters", 'Matières') }}<br>
        {{ Form::select('$matters[]', $matters, null, ['class' => 'chosen-select', 'multiple' => 'multiple']) }}

        @for($i=0;$i<5;++$i)
            {{ Form::label("images", 'Images') }}<br>
            {{ Form::file("images[]") }}<br>
        @endfor

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection
