@extends('layouts.app')

@section('content')
    <h1>Ajouter une création</h1>

    {{ Form::model($article, ['method' => 'POST', 'route' => 'articles.store', 'files' => true]) }}

        <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
            {{ Form::label('designation', 'Désignation') }}
            {{ Form::text('designation', old('designation'), ['class'=>'form-control']) }}
            <span class="text-danger">{{ $errors->first('designation') }}</span>
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', old('description'), ['class'=>'form-control']) }}
            <span class="text-danger">{{ $errors->first('description') }}</span>
        </div>

        <div class="form-group {{ $errors->has('stock') ? 'has-error' : '' }}">
            {{ Form::label('stock', 'Stock') }}
            {{ Form::text('stock', old('stock'), ['class'=>'form-control']) }}
            <span class="text-danger">{{ $errors->first('stock') }}</span>
        </div>

        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
            {{ Form::label('price', 'Prix') }}
            {{ Form::text('price', old('price'), ['class'=>'form-control']) }}
            <span class="text-danger">{{ $errors->first('price') }}</span>
        </div>

        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
            {{ Form::label("type", 'Type') }}
            {{ Form::select("type", $types, old('type'), ['class' => 'form-control chosen-select']) }}
            <span class="text-danger">{{ $errors->first('type') }}</span>
        </div>

        <div class="form-group {{ $errors->has('matters') ? 'has-error' : '' }}">
            {{ Form::label("matters", 'Matières') }}
            {{ Form::select('matters[]', $matters, old('$matters[]'), ['class' => 'form-control chosen-select', 'multiple' => 'multiple']) }}
            <span class="text-danger">{{ $errors->first('matters') }}</span>
        </div>

        <div class="form-group {{ $errors->has('images') ? 'has-error' : '' }}">
            {{ Form::label("images", 'Images') }}
            @for($i=0;$i<5;++$i)
                {{ Form::file("images[]", ['class' => 'form-control-file']) }}<br>
            @endfor
        </div>
        <span class="text-danger">{{ $errors->first('images') }}</span>

    {{ Form::submit('Envoyer', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection
