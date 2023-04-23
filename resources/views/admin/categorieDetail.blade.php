@extends('layouts.mainCompteAdmin')
@section('content')
    <div class="columns-md w-100" style="padding: 15px">
        <div class="breadcrumbs">
            {{ Breadcrumbs::render('uneCategorie') }}
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifier une categorie</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('categorie.modifier', ['id' => $categorie->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom d'identification :</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ $categorie->nom }}" required>
                    </div>
                    <div class="form-group">
                        <label for="label">Label :</label>
                        <input type="text" name="label" id="label" class="form-control" value="{{ $categorie->label }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                </form>
                <form action="{{ route('couleur.supprimer', ['id' => $categorie->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
