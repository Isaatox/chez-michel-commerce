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
                            <label for="ancien_mot_de_passe" class="col-sm-4 col-form-label">{{ __('Ancien mot de passe') }} :</label>
                            <div class="col-sm-8">
                                <input id="ancien_mot_de_passe" type="password" name="ancien_mot_de_passe" class="form-control" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="nouveau_mot_de_passe" class="col-sm-4 col-form-label">{{ __('Nouveau mot de passe') }} :</label>
                            <div class="col-sm-8">
                                <input id="nouveau_mot_de_passe" type="password" name="nouveau_mot_de_passe" class="form-control" required autofocus />
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="nouveau_mot_de_passe_confirmation" class="col-sm-4 col-form-label">{{ __('Confirmation du nouveau mot de passe') }} :</label>
                            <div class="col-sm-8">
                                <input id="nouveau_mot_de_passe_confirmation" type="password" name="nouveau_mot_de_passe_confirmation" class="form-control" required autofocus />
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