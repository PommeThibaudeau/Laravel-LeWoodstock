@extends('layouts.app')

@section('content')
    <div class="container jumbotron index-container">
        <h1>Les types</h1>
        <a href="{{ route('types.create') }}">
            <i class="fas fa-plus-circle fa-lg">Ajouter un Type</i>
        </a><br><br>
        <div class="row index-wrapper">
            @if (count($types))
                @foreach ($types as $type)
                    <div class="col-sm-4">
                        <a class="show-link" href="{{ route('types.show', ['id' => $type->getKey()]) }}">
                            <div class="card index-item text-center">
                                @if ($type->image_url)
                                    <img style="max-height: 180px; max-width: 180px" src="storage/{{ $type->image_url }}" alt="{{ $type->designation }}" class="card-img-top">
                                @endif
                                <h4 class="index-item-title">{{ $type->designation }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>Aucun type actuellement</p>
            @endif
        </div>
    </div>
@endsection
