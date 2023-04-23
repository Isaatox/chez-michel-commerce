@extends('layouts.mainCompte')
@section('content')
<div class="columns-md w-100" style="padding: 15px">
    <div class="breadcrumbs">
        {{ Breadcrumbs::render('commandes') }}
    </div>
    <div class="card" id="commande-card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-2">
                    Commande n°
                </div>
                <div class="col-md-10 text-right">
                    Prix : 
                </div>
            </div>
        </div>
        <div class="card-body text-left">
          <p class="card-text">Statut de la commande : </p>
          <a href="#" class="btn btn-link" onclick="toggleCard()">Voir en détails</a>
        </div>
        <div class="card-footer d-none" id="commande-details">
            <div class="row">
                <div class="col-md-6">
                    <strong>Nom :</strong>
                </div>
                <div class="col-md-6">
                    <span class="nom"></span>
                </div>
                <div class="col-md-6">
                    <strong>Adresse :</strong>
                </div>
                <div class="col-md-6">
                    <span class="adresse"></span>
                </div>
                <div class="col-md-6">
                    <strong>Codepo et ville :</strong>
                </div>
                <div class="col-md-6">
                    <span class="adresse-ville"></span>
                </div>
            </div>
        </div>
      </div>
</div>

<script>
function toggleCard() {
    var card = document.getElementById("commande-card");
    var details = document.getElementById("commande-details");
    if (card.classList.contains("commande-agrandie")) {
        card.classList.remove("commande-agrandie");
        details.classList.add("d-none");
    } else {
        card.classList.add("commande-agrandie");
        details.classList.remove("d-none");
    }
}
</script>

<style>
.commande-agrandie {
    height: auto;
    transition: height 0.5s;
}
</style>
@endsection