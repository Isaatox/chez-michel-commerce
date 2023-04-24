@extends('layouts.mainCompte')
@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('mesInformations.modifierMotDePasse') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nom_carte_bancaire" class="col-sm-4 col-form-label">{{ __('Nom') }} :</label>
                            <div class="col-sm-8">
                                <input id="nom_carte_bancaire" type="text" name="nom_carte_bancaire" class="form-control" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="numero_carte" class="col-sm-4 col-form-label">{{ __('Numéro de la carte') }} :</label>
                            <div class="col-sm-8">
                                <input id="numero_carte" type="text" name="numero_carte" class="form-control" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="date_validite_carte" class="col-sm-4 col-form-label">{{ __('Date de validité de la carte') }} :</label>
                            <div class="col-sm-8">
                                <input id="date_validite_carte" type="text" name="date_validite_carte" class="form-control" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="cryptogramme" class="col-sm-4 col-form-label">{{ __('Cryptogramme') }} :</label>
                            <div class="col-sm-8">
                                <input id="cryptogramme" type="password" name="cryptogramme" class="form-control" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-6 offset-sm-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enregistrer les modifications') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection