@extends('layouts.app')

@section('content')
    {{ Form::model($image, ['method' => 'POST', 'route' => ['images.store'], 'files' => true]) }}
        {{ Form::label('src', 'Image') }}<br>
        {{ Form::file('src') }}<br>

        {{ Form::label('alt', 'Titre') }}<br>
        {{ Form::text('alt') }}<br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection
