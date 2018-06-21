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

    <h1>Création d'un nouveau type</h1>
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label for="type-designation">Nom</label>
        <input id="type-designation" name="type-designation" type="text" required>

        <label for="type-image">Image</label>
        <input id="type-image" name="type-image" type="file">

        <input type="submit">
    </form>

@endsection