@extends('layouts.main')

@section('content')

<br><br><br><br>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card border-0 shadow rounded-lg">
        <div class="card-header bg-white border-0">
          <h3 class="text-center mb-0">{{ __('Connexion') }}</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
              <label for="email" class="col-form-label">{{ __('Email') }}</label>

              <div class="">
                <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <!-- Password -->
            <div class="form-group">
              <label for="password" class="col-form-label">{{ __('Mot de passe') }}</label>

              <div class="">
                <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <br>

            <div class="row justify-content-between">

              <!-- Remember Me -->
              <div class="form-group form-check col-sm-6">
                <input class="form-check-input mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  {{ __('Se souvenir de moi') }}
                </label>
              </div>

              <div class="form-group mb-0 col-sm-6 text-right">
                <button type="submit" class="btn btn-primary rounded-pill w-100">{{ __('Connexion') }}</button>
              </div>
            </div>

            <div class="form-group text-center mt-3">
              <a href="{{ route('password.request') }}">{{ __('Mot de passe oublié ?') }}</a>
              <a href="{{ route('register') }}">{{ __("S'inscrire") }}</a>
            </div>

            <!-- Social Login -->
            <hr>
            <div class="form-group text-center">
              <a href="#" class="btn btn-danger btn-lg rounded-pill mb-3 w-75"><i class="fab fa-google fa-lg mr-2"></i>{{ __('oogle') }}</a>
              <a href="#" class="btn btn-primary btn-lg rounded-pill w-75"><i class="fab fa-facebook fa-lg mr-2"></i>{{ __('acebook') }}</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<style>
        footer{
            position: fixed !important;
        }
</style>