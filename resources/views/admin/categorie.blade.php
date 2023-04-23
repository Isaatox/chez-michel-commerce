@extends('layouts.mainCompteAdmin')
@section('content')

    <div class="columns-md w-100" style="padding: 15px">
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
                    <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                </form>
            </div>
        </div>
    <div class="container"> <!-- ou container-fluid -->
        <hr>
        <h4>Toutes les categories :</h4>.

        @if(count($categories) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Label</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->nom }}</td>
                        <td>{{ $categorie->label }}</td>
                        <td>
                            <a href="" class="btn btn-warning">Modifier</a>
                            <a href="" class="btn btn-danger">Supprimer</a>
                            {{--                            <a href="{{ route('modifier_meuble', ['id' => $meuble->id]) }}" class="btn btn-warning">Modifier</a>--}}
                            {{--                            <a href="{{ route('supprimer_meuble', ['id' => $meuble->id]) }}" class="btn btn-danger">Supprimer</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($categories->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    @for ($i = 1; $i <= $categories->lastPage(); $i++)
                        <li class="page-item{{ $categories->currentPage() == $i ? ' active' : '' }}"><a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    @if ($categories->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @endif
                </ul>
            </nav>


        @else
            <p>Aucune catégorie trouvé</p>
        @endif
    </div>
    </div>
@endsection


