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

        <div class="container">
    <div class="breadcrumbs">
        {{ Breadcrumbs::render('ajouter_meubles') }}
    </div>
            <hr>
    <form action="{{ route('enregistrer_meuble') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nom" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" name="description" id="description" required></textarea>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="categorie" class="form-label">Catégorie :</label>
                <select class="form-select" name="categorie" id="categorie" required>
                    <option value="" selected disabled>Sélectionnez une catégorie</option>
                    @foreach ($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->label}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="stock" class="form-label">Stock :</label>
                <input type="number" min="0" class="form-control" name="stock" id="stock" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="prix" class="form-label">Prix :</label>
                <input type="number" min="0" class="form-control" name="prix" id="prix" required>
            </div>
            <div class="col">
                <label for="couleur" class="form-label">Couleur :</label>
                <select class="form-select" name="couleur" id="couleur" required>
                    <option value="" selected disabled>Sélectionnez une couleur</option>
                    @foreach ($couleurs as $couleur)
                        <option value="{{$couleur->id}}" style="color: {{$couleur->hex_couleur}}">{{$couleur->label}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Images :</label>
            <input type="file" class="form-control" name="images[]" id="images" accept="image/*" multiple required>
        </div>

        <div class="mb-3">
            <label for="preview" class="form-label">Aperçu des images :</label>
            <div id="preview"></div>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
        <div class="container"> <!-- ou container-fluid -->
            <hr>
        <h4>Tous les meubles :</h4>

    @if(count($meubles) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><a href="?sort_order={{ $sortOrder == 'asc' ? 'desc' : 'asc' }}">Nom</a></th>
                    <th>Description</th>
                    <th><a href="?sort_order={{ $sortOrder == 'asc' ? 'desc' : 'asc' }}">Prix</a></th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($meubles as $meuble)
                    <tr>
                        <td>{{ $meuble->nom }}</td>
                        <td>{{ $meuble->description }}</td>
                        <td>{{ $meuble->prix }}</td>
                        <td class="d-flex justify-content-center gap-1">
                            <div class="d-flex">
                                <a href="{{ route('meuble.modifier', ['id' => $meuble->id]) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('meuble.supprimer', ['id' => $meuble->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @if ($meubles->currentPage() > 1)
                            <li class="page-item"><a class="page-link" href="{{ $meubles->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        @for ($i = 1; $i <= $meubles->lastPage(); $i++)
                            <li class="page-item{{ $meubles->currentPage() == $i ? ' active' : '' }}"><a class="page-link" href="{{ $meubles->url($i) }}">{{ $i }}</a></li>
                        @endfor

                        @if ($meubles->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $meubles->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @endif
                    </ul>
                </nav>


            @else
        <p>Aucun meuble trouvé</p>
    @endif
    </div>
    </div>
    </div>
    <script src="{{ url('js/admin.js') }}"></script>

@endsection
