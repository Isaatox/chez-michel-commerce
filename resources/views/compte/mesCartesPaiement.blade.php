@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mes cartes de paiement') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom_carte_bancaire">{{ __('Nom de la carte bancaire') }}</label>
                                <input id="nom_carte_bancaire" type="text" class="form-control" name="nom_carte_bancaire" value="{{ $creditCard->nom ?? '' }}" required autofocus>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_carte">{{ __('Numéro de la carte bancaire') }}</label>
                                <input id="numero_carte" type="text" class="form-control" name="numero_carte" value="{{ $creditCard->numero_carte ?? '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_validite_carte">{{ __('Date de validité de la carte bancaire') }}</label>
                                <input id="date_validite_carte" type="text" class="form-control" name="date_validite_carte" value="{{ $creditCard->date_validite ?? '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cryptogramme">{{ __('Cryptogramme visuel') }}</label>
                                <input id="cryptogramme" type="text" class="form-control" name="cryptogramme" value="{{ $creditCard->cryptogramme ?? '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{ __('Type de carte bancaire') }}</label>
                                <input id="type" type="text" class="form-control" name="type" value="{{ $creditCard->type ?? '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">{{ __('Identifiant de l\'utilisateur') }}</label>
                                <input id="user_id" type="text" class="form-control" name="user_id" value="{{ Auth::user()->id }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('Enregistrer les modifications') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection