@extends('layouts.main')

@section('content')
  <div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
      <div class="card-body">
        <h5 class="card-title">Mot de passe oublié</h5>
        <form>
          <div class="form-group">
            <label for="email">Adresse email :</label>
            <input type="email" class="form-control" id="email" required>
          </div>
          <button type="submit" class="btn btn-primary mt-3 mb-3">Envoyer un email de récupération</button>
        </form>
        <a href="{{route('index')}}" class="card-link">Retourner à la page d'accueil</a>
      </div>
    </div>
  </div>
@endsection
<style>
  footer{
    position: fixed !important;
  }
</style>