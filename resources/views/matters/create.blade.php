@extends('layouts.app')

@section('content')
    <h1>Création d'une nouvelle matière</h1>

    {{ Form::model($matter, ['method' => 'POST', 'route' => ['matters.store'], 'files' => true]) }}
        {{ Form::label('designation', 'Designation') }}<br>
        {{ Form::text('designation', old('designation')) }}<br>
        <span class="text-danger">{{ $errors->first('designation') }}</span><br>

        {{ Form::label('image', 'Image') }}<br>
        {{ Form::file('image') }}<br>
        <span class="text-danger">{{ $errors->first('image') }}</span><br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}

@endsection