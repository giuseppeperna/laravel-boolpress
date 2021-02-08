@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Hello') }}</div>
                <div class="card-body">
                    @guest
                    Ciao Utente non autenticato!
                    @else
                    Ciao {{ $user->name}}
                    @endguest
                </div>
                <a class="btn btn-success" href="{{ route('home')}}">Homepage</a>
            </div>
        </div>
    </div>
</div>

@endsection