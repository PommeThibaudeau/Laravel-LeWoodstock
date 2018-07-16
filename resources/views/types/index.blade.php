@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 index__title">Les types</h1>
        <a href="{{ route('types.create') }}">
            <i class="fas fa-plus-circle fa-lg">Ajouter un Type</i>
        </a><br><br>
        <div class="row">
            @if (count($types))
                @foreach ($types as $type)
                    <div class="col-md-4 col-sm-6 index__item portfolio-item">
                        <div class="card h-100">
                            @if ($type->image_url)
                                <div class="index__item__image">
                                    <img class="card-img-top" alt="{{ $type->designation }}" src="{{ Storage::url($type->image_url) }}">
                                </div>
                            @endif
                            <div class="card-body">
                                <a class="show-link" href="{{ route('types.show', ['id' => $type->getKey()]) }}">
                                    <h4 class="card-title">{{ $type->designation }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>

                @endforeach
            @else
                <p>Aucun type actuellement</p>
            @endif
        </div>
    </div>
@endsection
