@extends('layouts.app')

@section('content')
    {{ Form::model($article, ['route' => ['articles.store']]) }}
        {{ Form::label('designation', 'Désignation') }}<br>
        {{ Form::text('designation') }}<br>

        {{ Form::label('description', 'Description') }}<br>
        {{ Form::textarea('description') }}<br>

        {{ Form::label('stock', 'Stock') }}<br>
        {{ Form::text('stock') }}<br>

        {{ Form::label('price', 'Prix') }}<br>
        {{ Form::text('price') }}<br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection
