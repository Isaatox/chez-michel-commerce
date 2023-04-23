@extends('layouts.mainCompte')
@section('content')
@foreach($commandes as $commande)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Commande n°{{ $commande->id }}</h5>
            <p class="card-text">Statut : {{ $commande->statut }}</p>
            <p class="card-text">Prix : {{ $commande->prix }}</p>
            <p class="card-text">Adresse : {{ $commande->adresse }}</p>
            <p class="card-text">Nom : {{ $commande->nom }}</p>
            <p class="card-text">Bille : {{ $commande->bille }}</p>
            <p class="card-text">Code postal : {{ $commande->code_postal }}</p>
            <a href="{{ route('mesCommandes', ['commande' => $commande->id]) }}" class="btn btn-primary">Voir détails</a>
        </div>
    </div>
@endforeach
@endsection

