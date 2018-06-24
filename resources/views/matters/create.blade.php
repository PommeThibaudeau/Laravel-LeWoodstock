@extends('layouts.app')

@section('content')
    <h1>Création d'une nouvelle matière</h1>

    {{ Form::model($matter, ['method' => 'POST', 'route' => ['matters.store'], 'files' => true]) }}
        {{ Form::label('designation', 'Designation') }}<br>
        {{ Form::text('designation', old('designation')) }}<br>

        {{ Form::label('image', 'Image') }}<br>
        {{ Form::file('image') }}<br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}

@endsection