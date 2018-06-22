@extends('layouts.app')

@section('content')
    @isset($image)
        <img class="card-img-top" data-src="{{ asset("storage/$image->src") }}" alt="{{ $image->alt }}" style="height: 180px; width: 100%; display: block;" src="{{ asset("storage/$image->src")  }}" data-holder-rendered="true">
    @endisset
@endsection