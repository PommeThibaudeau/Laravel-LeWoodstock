@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <h2>Contactez moi :</h2>
                <br>
                {{ Form::open(['route'=>'contacts.store']) }}

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {{ Form::label('Name:') }}
                        {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Name']) }}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        {{ Form::label('Email:') }}
                        {{ Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) }}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                        {{ Form::label('Message:') }}
                        {{ Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Enter Message']) }}
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Envoyer</button>
                    </div>

                {{ Form::close() }}
            </div>
            <div class="col-md-3">
                <h2>Infos pratiques :</h2>
                <br>
                Localisation : <br><b>Saumur, Pays de la Loire</b>
                <br><br>
                E-mail : <br><b><a href="mailto:lewoodstockbroc@gmail.com">lewoodstockbroc@gmail.com</a></b>
                <br><br>
                Réseaux sociaux : <br>
                <a href="https://www.facebook.com/lewoodstock/" target="blank"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="https://www.instagram.com/carlthibaudeau/?hl=fr" target="blank"><i class="fab fa-instagram fa-2x"></i></a>
            </div>
        </div>
    </div>
@endsection