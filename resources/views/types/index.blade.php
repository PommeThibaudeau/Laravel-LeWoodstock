@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (count($types))

                    <ul>
                        @foreach ($types as $type)
                            <li>
                                {{$type->designation}}
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
