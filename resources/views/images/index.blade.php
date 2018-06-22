@extends('layouts.app')

@section('content')
    @if(count($images))
        <div class="card-columns">
            @foreach ($images as $image)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" data-src="{{ asset("storage/$image->src") }}" alt="{{ $image->alt }}" style="height: 180px; width: 100%; display: block;" src="{{ asset("storage/$image->src") }}" data-holder-rendered="true">
                    <div class="card-body">
                        <a href="{{ url("/images/".$image->id) }}" class="btn btn-primary">En savoir plus</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

