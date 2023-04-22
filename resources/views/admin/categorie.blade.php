@extends('layouts.mainCompteAdmin')
@section('content')

    <div class="columns-md">
        <div class="breadcrumbs">
            {{ Breadcrumbs::render('categorie') }}
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ajouter une catégorie</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ajouter_categorie') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom d'identification :</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="label">Label :</label>
                        <input type="text" name="label" id="label" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection


