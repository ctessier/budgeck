@extends('layouts.front')

@section('title', 'Mot de passe oublié')

@section('content')
    <div class="ui centered grid">
        <div class="six wide column">
            <div class="ui segment">

                @if (session('status'))
                <div class="ui success message">
                    {{ session('status') }}
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="ui error message">
                    <ul class="list">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::open(['method' => 'post', 'url' => '/password/email', 'class' => 'ui form']) !!}
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        {!! Form::email('email', old('email'), ['placeholder' => 'Adresse e-mail']) !!}
                    </div>
                </div>
                {!! Form::button('Réinitialiser mon mot de passe', ['type' => 'submit', 'class' => 'ui fluid button']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
