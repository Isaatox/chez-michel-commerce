@extends('layouts.mainCompteAdmin')
@section('content')

    <div class="columns-md w-100" style="padding: 15px">
        <div class="breadcrumbs">
            {{ Breadcrumbs::render('couleur') }}
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ajouter une couleur</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ajouter_couleur') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom d'identification :</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="label">Label :</label>
                        <input type="text" name="label" id="label" class="form-control" required>
                    </div>
                    <div class="form-group d-flex justify-content-center flex-column align-items-center mb-2">
                        <label for="color">Couleur :</label>
                        <input type="color" class="form-control form-control-color" name="color" id="color">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
        <div class="container"> <!-- ou container-fluid -->
            <hr>
            <h4>Toutes les couleurs :</h4>.

            @if(count($couleurs) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Label</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($couleurs as $couleur)
                        <tr>
                            <td>{{ $couleur->nom }}</td>
                            <td>{{ $couleur->label }}</td>
                            <td class="d-flex flex-row justify-content-evenly">
                                <a href="{{ route('couleur.modifier', ['id' => $couleur->id]) }}" class="btn btn-warning">Modifier</a>
{{--                                <a href="{{ route('couleur.supprimer', ['id' => $couleur->id]) }}" class="btn btn-danger">Supprimer</a>--}}
                                <form action="{{ route('couleur.supprimer', ['id' => $couleur->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @if ($couleurs->currentPage() > 1)
                            <li class="page-item"><a class="page-link" href="{{ $couleurs->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        @for ($i = 1; $i <= $couleurs->lastPage(); $i++)
                            <li class="page-item{{ $couleurs->currentPage() == $i ? ' active' : '' }}"><a class="page-link" href="{{ $couleurs->url($i) }}">{{ $i }}</a></li>
                        @endfor

                        @if ($couleurs->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $couleurs->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @endif
                    </ul>
                </nav>


            @else
                <p>Aucune couleur trouvée</p>
            @endif
        </div>
    </div>
@endsection


