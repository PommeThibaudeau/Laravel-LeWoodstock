@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oups il y a des erreurs:</strong>
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Modification du type {{ $type }}</h1>
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label for="type-designation">Nom</label>
        <input id="type-designation" value="{{ $type }}" name="type-designation" type="text" required>

        <label for="type-image">Image</label>
        <input id="type-image" name="type-image" type="file" required>

        <input type="submit">
    </form>

@endsection