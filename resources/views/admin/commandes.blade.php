@extends('layouts.mainCompteAdmin')
@section('content')

    <div class="columns-md w-100" style="padding: 15px">

        <div class="container">
            <!-- ou container-fluid -->
            <div class="breadcrumbs">
                {{ Breadcrumbs::render('commandesAdmin') }}
            </div>
            <hr>
            <h4>Listes des commandes :</h4>

            @if (isset($commandes) && count($commandes) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prix</th>
                            <th>Facture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandes as $commande)
                            <tr>
                                <td class="fw-bolder">{{ $commande->numero_commande }}</td>
                                <td>{{ $commande->prix_total }} €</td>
                                @if ($commande->actif == 0)
                                    <td><a href="{{ route('view-commandes-pdf', ['id' => $commande->id]) }}">Télécharger</a>
                                    </td>
                                @else
                                    <td>Télécharger</td>
                                @endif
                                <td>
                                    <form action="{{ route('view-commandes.supprimer', ['id' => $commande->id]) }}"
                                        method="POST">
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
                        @if ($commandes->currentPage() > 1)
                            <li class="page-item"><a class="page-link" href="{{ $commandes->previousPageUrl() }}"
                                    rel="prev">&laquo;</a></li>
                        @endif

                        @for ($i = 1; $i <= $commandes->lastPage(); $i++)
                            <li class="page-item{{ $commandes->currentPage() == $i ? ' active' : '' }}"><a class="page-link"
                                    href="{{ $commandes->url($i) }}">{{ $i }}</a></li>
                        @endfor

                        @if ($commandes->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $commandes->nextPageUrl() }}"
                                    rel="next">&raquo;</a></li>
                        @endif
                    </ul>
                </nav>
            @else
                <p>Aucune commande trouvée</p>
            @endif
        </div>
    </div>
@endsection
