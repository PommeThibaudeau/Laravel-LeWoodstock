@extends('layouts.app')

@section('content')

    <div class="container jumbotron index-container">
        <h1>Les matières</h1>
        <br>
        <div class="row index-wrapper">

            @if (count($matters))
                @foreach ($matters as $matter)
                    <div class="col-sm-4">
                        <a class="show-link" href="{{ route('matters.show', ['id' => $matter->getKey()]) }}">
                            <div class="card index-item">
                                @if ($matter->image_url)
                                    <img src="{{ Storage::url($matter->image) }}" alt="{{ $matter->designation }}" class="card-img-top">
                                @endif
                                <h4 class="index-item-title">{{ $matter->designation }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>Aucune matière actuellement</p>
            @endif
        </div>

    </div>

@endsection
