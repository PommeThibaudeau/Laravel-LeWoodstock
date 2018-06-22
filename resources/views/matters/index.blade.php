@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('matters.create') }}">
                    <i class="fas fa-plus-circle fa-lg">Ajouter une Matière</i>
                </a><br><br>
                @if (count($matters))

                    <ul>
                        @foreach ($matters as $matter)
                            <li>
                                <a href="{{ route('matters.show', ['id' => $matter->getKey()]) }}">
                                    {{ $matter->designation }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <p>Aucune matière actuellement</p>
                @endif

            </div>
        </div>
    </div>
@endsection
