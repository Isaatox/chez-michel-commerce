@extends('layouts.mainCompteAdmin')
@section('content')
    <div class="columns-md w-100" style="padding: 15px">
        <div class="container">
        <div class="breadcrumbs">
            {{ Breadcrumbs::render('uneCouleur') }}
        </div>
            <hr>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifier une couleur</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('couleur.modifier', ['id' => $couleur->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nom">Nom d'identification :</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ $couleur->nom }}" required>
                    </div>
                    <div class="form-group">
                        <label for="label">Label :</label>
                        <input type="text" name="label" id="label" class="form-control" value="{{ $couleur->label }}" required>
                    </div>
                    <div class="form-group d-flex justify-content-center flex-column align-items-center mb-2">
                        <label for="color">Couleur :</label>
                        <input type="color" class="form-control form-control-color" name="color" id="color" value="{{ $couleur->hex_couleur }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
                <form action="{{ route('couleur.supprimer', ['id' => $couleur->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
