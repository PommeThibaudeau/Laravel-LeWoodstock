@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>{{ $matter->designation }}</h1>
                <img class="card-img-top" data-src="{{ Storage::url($matter->image) }}" alt="{{ $matter->designation }}" style="height: 180px; width: 180px; display: block;" src="{{ Storage::url($matter->image) }}" data-holder-rendered="true">

                <a href="{{ route('matters.edit', ['id' => $matter->getKey()]) }}">
                    <i class="fas fa-trash-alt fa-3x"></i>
                </a>

                {{ Form::model($matter, ['method' => 'DELETE', 'route' => ['matters.destroy', $matter->getKey()]]) }}
                    {{ Form::hidden('id', $matter->getKey()) }}
                    {{ Form::submit('Supprimer')}}
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection