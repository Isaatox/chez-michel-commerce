@extends('layouts.mainCompte')
@section('content')
    <h1>Informations de la carte bancaire</h1>
    <p>Nom du titulaire : {{ $creditCard->nom }}</p>
    <p>Numéro de carte : {{ decrypt($creditCard->numero_carte) }}</p>
    <p>Date de validité : {{ $creditCard->date_validite }}</p>
    <p>Cryptogramme : {{ decrypt($creditCard->cryptogramme) }}</p>
    <p>Type de carte : {{ $creditCard->type }}</p>

    <form method="POST" action="{{ route('cartepaiement.modifier', $user->id) }}">
        @csrf
        <label for="nom">Nom du titulaire</label>
        <input type="text" name="nom" value="{{ $creditCard->nom }}" required>
        <label for="numero_carte">Numéro de carte</label>
        <input type="text" name="numero_carte" value="{{ decrypt($creditCard->numero_carte) }}" required>
        <label for="date_validite">Date de validité (MM/AA)</label>
        <input type="text" name="date_validite" value="{{ $creditCard->date_validite }}" required>
        <label for="cryptogramme">Cryptogramme</label>
        <input type="text" name="cryptogramme" value="{{ decrypt($creditCard->cryptogramme) }}" required>
        <label for="type">Type de carte</label>
        <input type="text" name="type" value="{{ $creditCard->type }}" required>
        <button type="submit">Modifier la carte bancaire</button>
    </form>

    <form method="POST" action="{{ route('carte.supprimer', $user->id) }}">
        @csrf
        <button type="submit">Supprimer la carte bancaire</button>
    </form>
@endsection