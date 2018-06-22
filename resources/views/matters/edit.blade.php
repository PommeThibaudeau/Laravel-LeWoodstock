@extends('layouts.app')

@section('content')

    <h1>Modification de la matière {{ $matter->designation }}</h1>

    {{ Form::model($matter, ['method' => 'PUT', 'route' => ['matters.update', $matter->getKey()], 'files' => true]) }}
        {{ Form::label('designation', 'Designation') }}<br>
        {{ Form::text('designation') }}<br>


        {{ Form::label('image', 'Image') }}<br>
        <img class="card-img-top" data-src="{{ Storage::url($matter->image) }}" alt="{{ $matter->designation }}" style="height: 180px; width: 180px; display: block;" src="{{ Storage::url($matter->image) }}" data-holder-rendered="true">
        {{ Form::file('image') }}<br>

        {{ Form::submit('Envoyer')}}
    {{ Form::close() }}

@endsection