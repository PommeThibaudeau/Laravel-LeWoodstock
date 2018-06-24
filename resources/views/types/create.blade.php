@extends('layouts.app')

@section('content')
    <h1>Création d'un nouveau type</h1>

    {{ Form::model($type, ['method' => 'POST', 'route' => ['types.store'], 'files' => true]) }}
        {{ Form::label('designation', 'Designation') }}<br>
        {{ Form::text('designation', old('designation')) }}<br>
        <span class="text-danger">{{ $errors->first('designation') }}</span><br>

        {{ Form::label('image', 'Image') }}<br>
        {{ Form::file('image') }}<br>
        <span class="text-danger">{{ $errors->first('image') }}</span><br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}

@endsection