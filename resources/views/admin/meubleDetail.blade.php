@extends('layouts.mainCompteAdmin')
@section('content')
    <style>
        form {
            margin: auto;
            width: 50%;
        }
        form #preview img {
            max-width: 200px;
            max-height: 200px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        table {
            margin: auto;
            width: 80%;
        }
    </style>
    <div class="columns-md w-100" style="padding: 15px">

    <div class="breadcrumbs">
        {{ Breadcrumbs::render('unMeuble') }}
    </div>
    <form action="{{ route('meuble.modifier', ['id' => $meuble->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nom" value="{{ $meuble->nom }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" name="description" id="description" required>{{ $meuble->description }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="categorie" class="form-label">Catégorie :</label>
                <select class="form-select" name="categorie" id="categorie" required>
                    <option value="" selected disabled>Sélectionnez une catégorie</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" @if($meuble->categorie == $categorie->id) selected @endif>{{ $categorie->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="stock" class="form-label">Stock :</label>
                <input type="number" class="form-control" name="stock" id="stock" value="{{ $meuble->stock }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="prix" class="form-label">Prix :</label>
                <input type="text" class="form-control" name="prix" id="prix" value="{{ $meuble->prix }}" required>
            </div>
            <div class="col">
                <label for="couleur" class="form-label">Couleur :</label>
                <select class="form-select" name="couleur" id="couleur" required>
                    <option value="" selected disabled>Sélectionnez une couleur</option>
                    @foreach ($couleurs as $couleur)
                        <option value="{{ $couleur->id }}" style="color: {{ $couleur->hex_couleur }}" @if($meuble->couleur_id == $couleur->id) selected @endif>{{ $couleur->label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Images :</label>
            <input type="file" class="form-control" name="images[]" id="images" accept="image/*" multiple>
        </div>
        <div class="mb-3">
            <label for="preview" class="form-label">Aperçu des images :</label>
            <div id="preview">
                <img src="{{ asset('public/'.$meuble->photo1) }}" alt="Image 1" style="max-width: 150px; margin-right: 5px;">
                @if($meuble->photo2)
                    <img src="{{ asset('public/'.$meuble->photo2) }}" alt="Image 2" style="max-width: 150px; margin-right: 5px;">
                @endif
                @if($meuble->photo3)
                    <img src="{{ asset('public/'.$meuble->photo3) }}" alt="Image 3" style="max-width: 150px; margin-right: 5px;">
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('js/admin.js') }}"></script>
@endsection
