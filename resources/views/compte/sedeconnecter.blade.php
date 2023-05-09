@extends('layouts.mainCompte')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Déconnexion') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <p>
                                {{ __('Êtes-vous sûr de vouloir vous déconnecter?') }}
                            </p>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Se déconnecter') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection