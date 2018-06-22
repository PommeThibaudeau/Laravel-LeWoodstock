@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('types.create') }}">
                    <i class="fas fa-plus-circle fa-lg">Ajouter un Type</i>
                </a><br><br>
                @if (count($types))

                    <ul>
                        @foreach ($types as $type)
                            <li>
                                <a href="{{ route('types.show', ['id' => $type->getKey()]) }}">
                                    {{ $type->designation }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <p>Aucun type actuellement</p>
                @endif

            </div>
        </div>
    </div>
@endsection
