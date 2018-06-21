@extends('layouts.app')

@section('content')
    <h1>Création d'un nouveau type</h1>

    {{ Form::model($type, ['method' => 'POST', 'route' => ['types.store'], 'files' => true]) }}
        {{ Form::label('designation', 'Designation') }}<br>
        {{ Form::text('designation') }}<br>

        {{ Form::label('image', 'Image') }}<br>
        {{ Form::file('image') }}<br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}

@endsection