@extends('layouts.mainCompte')
@section('content')


<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('mesinformations.modifier') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nom" class="col-sm-4 col-form-label">{{ __('Nom') }} :</label>
                            <div class="col-sm-8">
                                <input id="nom" type="text" name="nom" class="form-control" value="{{ $user->nom }}" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="prenom" class="col-sm-4 col-form-label">{{ __('Prénom') }} :</label>
                            <div class="col-sm-8">
                                <input id="prenom" type="text" name="prenom" class="form-control" value="{{ $user->prenom }}" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">{{ __('Email') }} :</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" name="email" class="form-control" value="{{ $user->email }}" required />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="civilite" class="col-sm-4 col-form-label">{{ __('Civilité') }} :</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite_neutre" value="Neutre" required {{ $user->civilite == 'Neutre' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="civilite_neutre">Neutre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite_m" value="M" {{ $user->civilite == 'M' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="civilite_m">M.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite_mme" value="Mme" {{ $user->civilite == 'Mme' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="civilite_mme">Mme</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="adresse" class="col-sm-4 col-form-label">{{ __('Adresse') }} :</label>
                            <div class="col-sm-8">
                                <input id="adresse" type="text" name="adresse" class="form-control" value="{{ $user->adresse }}" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="ville" class="col-sm-4 col-form-label">{{ __('Ville') }} :</label>
                            <div class="col-sm-8">
                                <input id="ville" type="text" name="ville" class="form-control" value="{{ $user->ville }}" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="code_postal" class="col-sm-4 col-form-label">{{ __('Code Postal') }} :</label>
                            <div class="col-sm-8">
                                <input id="code_postal" type="text" name="code_postal" class="form-control" value="{{ $user->code_postal }}" required autofocus />
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
