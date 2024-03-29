@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Inscription</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Name -->
                            <div class="form-group">
                                <label for="nom" class="form-label">{{ __('Nom') }} :</label>
                                <input id="nom" type="text" name="nom" class="form-control" value="{{ old('nom') }}" required autofocus />
                            </div>

                            <!-- Prenom -->
                            <div class="form-group">
                                <label for="prenom" class="form-label">{{ __('Prénom') }} :</label>
                                <input id="prenom" type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required autofocus />
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('Email') }} :</label>
                                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required />
                            </div>

                            <div class="form-group">
                                <label for="civilite" class="form-label">{{ __('Civilité') }} :</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite_neutre" value="Neutre" required>
                                    <label class="form-check-label" for="civilite_neutre">Neutre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite_m" value="M">
                                    <label class="form-check-label" for="civilite_m">M.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite_mme" value="Mme">
                                    <label class="form-check-label" for="civilite_mme">Mme</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="adresse" :value="__('Adresse')">Adresse :</label><br>
                                <input id="adresse" type="text" name="adresse" class="form-control" value="{{ old('adresse') }}" required autofocus />
                            </div>

                            <div class="form-group">
                                <label for="ville" :value="__('Ville')">Ville :</label><br>
                                <input id="ville" type="text" name="ville" class="form-control" value="{{ old('ville') }}" required autofocus />
                            </div>

                            <div class="form-group">
                                <label for="code_postal" class="form-label">{{ __('Code Postal') }} :</label>
                                <input id="code_postal" type="number" name="code_postal" class="form-control" value="{{ old('code_postal') }}" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" class="form-label">{{ __('Mot de passe') }} :</label>
                                <input id="password" type="password" name="password" class="form-control" value="{{ old('mot_passe') }}" required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">{{ __('Confirmer votre mot de passe') }} :</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"value="{{ old('mot_passe') }}" required />
                            </div>

                            <div class="form-group text-center mt-4">
                                <a href="{{ route('login') }}">{{ __('Déjà inscrit ?') }}</a><br>
                                <button class="btn btn-primary">{{ __('Inscription') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection