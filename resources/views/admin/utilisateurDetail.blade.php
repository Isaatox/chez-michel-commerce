@extends('layouts.mainCompteAdmin')
@section('content')

    <div class="columns-md w-100" style="padding: 15px">

    <div class="container"> <!-- ou container-fluid -->
        <div class="breadcrumbs">
            {{ Breadcrumbs::render('utilisateur') }}
        </div>
        <hr>
        <h4>Tous les utilisateurs :</h4>

        @if(isset($users) && count($users) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>

                            <a href="{{ route('utilisateur.modifier', ['id' => $user->id]) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('utilisateur.delete', $user->id) }}" method="POST" class="d-inline">
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
                    @if ($users->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        <li class="page-item{{ $users->currentPage() == $i ? ' active' : '' }}"><a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    @if ($users->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @endif
                </ul>
            </nav>


        @else
            <p>Aucun utilisateur trouvé</p>
        @endif
    </div>
    </div>
@endsection
