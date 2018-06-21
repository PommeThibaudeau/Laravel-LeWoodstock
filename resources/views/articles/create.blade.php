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

        @for($i=0;$i<5;++$i)
            {{ Form::label("images", 'Images') }}<br>
            {{ Form::file("images[]") }}<br>
        @endfor

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection
