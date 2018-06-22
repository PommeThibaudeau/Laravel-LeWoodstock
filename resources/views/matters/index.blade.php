@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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
