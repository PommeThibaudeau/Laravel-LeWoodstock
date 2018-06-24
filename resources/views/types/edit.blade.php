@extends('layouts.app')

@section('content')

    <h1>Modification du type {{ $type->designation }}</h1>

    {{ Form::model($type, ['method' => 'PUT', 'route' => ['types.update', $type->getKey()], 'files' => true]) }}
        {{ Form::label('designation', 'Designation') }}<br>
        {{ Form::text('designation') }}<br>
        <span class="text-danger">{{ $errors->first('designation') }}</span><br>

        {{ Form::label('image', 'Image') }}<br>
        <img class="card-img-top" data-src="{{ Storage::url($type->image) }}" alt="{{ $type->designation }}" style="height: 180px; width: 180px; display: block;" src="{{ Storage::url($type->image) }}" data-holder-rendered="true">
        {{ Form::file('image') }}<br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}

@endsection