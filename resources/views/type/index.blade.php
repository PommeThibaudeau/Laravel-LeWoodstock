@extends('layouts.app')

@section('content')

    @if(session('message'))
        <div class="alert alert-info">
            <strong>
                {{session('message')}}
            </strong>
        </div>
    @endif

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
