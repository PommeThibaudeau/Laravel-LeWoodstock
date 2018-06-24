@extends('layouts.app')

@section('content')
    <h1>Ajouter une création</h1>

    {{ Form::model($article, ['method' => 'POST', 'route' => 'articles.store', 'files' => true]) }}
        {{ Form::label('designation', 'Désignation') }}<br>
        {{ Form::text('designation', old('designation')) }}<br>
        <span class="text-danger">{{ $errors->first('designation') }}</span><br>

        {{ Form::label('description', 'Description') }}<br>
        {{ Form::textarea('description', old('description')) }}<br>
        <span class="text-danger">{{ $errors->first('description') }}</span><br>

        {{ Form::label('stock', 'Stock') }}<br>
        {{ Form::text('stock', old('stock')) }}<br>
        <span class="text-danger">{{ $errors->first('stock') }}</span><br>

        {{ Form::label('price', 'Prix') }}<br>
        {{ Form::text('price', old('price')) }}<br>
        <span class="text-danger">{{ $errors->first('price') }}</span><br>

        {{ Form::label("type", 'Type') }}<br>
        {{ Form::select("type", $types, old('type'), ['class' => 'chosen-select']) }}<br>
        <span class="text-danger">{{ $errors->first('type') }}</span><br>

        {{ Form::label("matters", 'Matières') }}<br>
        {{ Form::select('matters[]', $matters, old('$matters[]'), ['class' => 'chosen-select', 'multiple' => 'multiple']) }}
        <span class="text-danger">{{ $errors->first('matters') }}</span><br>

        @for($i=0;$i<5;++$i)
            {{ Form::label("images", 'Images') }}<br>
            {{ Form::file("images[]") }}<br>
        @endfor
    <span class="text-danger">{{ $errors->first('images') }}</span><br>


    {{ Form::submit('Envoyer')}}
    {{ Form::close() }}
@endsection
