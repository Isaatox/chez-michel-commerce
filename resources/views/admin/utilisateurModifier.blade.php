@extends('layouts.mainCompteAdmin')

@section('content')
<div class="columns-md w-100" style="padding: 15px">
    <div class="container">
    <div class="breadcrumbs">
    {{ Breadcrumbs::render('unUtilisateur') }}
    </div>
        <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modifier un utilisateur</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('utilisateur.modifier', ['id' => $user->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $user->nom }}" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $user->prenom }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="role">Rôle :</label>
                <div>
                    <label>
                        <input type="radio" name="role" value="client" {{ $user->role == 'client' ? 'checked' : '' }}> Client
                    </label>
                    <label>
                        <input type="radio" name="role" value="admin" {{ $user->role == 'admin' ? 'checked' : '' }}> Admin
                    </label>
                </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Modifier</button>
            </form>
            <form action="{{ route('utilisateur.delete', ['id' => $user->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection

