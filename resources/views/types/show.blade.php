@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>{{ $type->designation }}</h1>
                <img class="card-img-top" data-src="{{ Storage::url($type->image) }}" alt="{{ $type->designation }}" style="height: 180px; width: 180px; display: block;" src="{{ Storage::url($type->image) }}" data-holder-rendered="true">

                <a href="{{ route('types.edit', ['id' => $type->getKey()]) }}">
                    <i class="fas fa-edit fa-3x"></i>
                </a>

                <a href="{{ route('types.delete', ['id' => $type->getKey()]) }}">
                    <i class="fas fa-trash-alt fa-3x"></i>
                </a>

            </div>
        </div>
    </div>
@endsection