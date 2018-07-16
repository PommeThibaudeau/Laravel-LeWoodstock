@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 index__title">Les matières</h1>
            <a href="{{ route('matters.create') }}">
                <i class="fas fa-plus-circle fa-lg">Ajouter une matière</i>
            </a><br><br>
        <div class="row">
            @if (count($matters))
                @foreach ($matters as $matter)
                    <div class="col-md-4 col-sm-6 index__item portfolio-item">
                        <div class="card h-100">
                            @if ($matter->image_url)
                                <div class="index__item__image">
                                    <img class="card-img-top" alt="{{ $matter->designation }}" src="{{ Storage::url($matter->image_url) }}">
                                </div>
                            @endif
                            <div class="card-body">
                                <a class="show-link" href="{{ route('matters.show', ['id' => $matter->getKey()]) }}">
                                   <h4 class="card-title">{{ $matter->designation }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Aucune matière actuellement</p>
            @endif
        </div>
    </div>
@endsection
