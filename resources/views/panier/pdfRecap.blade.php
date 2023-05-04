<style>
    * {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }
    h4 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    p {
        margin: 0;
    }
    #cart-summary {
        border: 1px solid #ddd;
        padding: 20px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #eee;
    }
    .card-img-bottom {
        max-width: 150px;
        max-height: 150px;
    }
    .text-uppercase {
        text-transform: uppercase;
    }
    .fw-bold {
        font-weight: bold;
    }
    .mt-2 {
        margin-top: 10px;
    }
    .mt-5 {
        margin-top: 50px;
    }
</style>

<div class="card mt-5" id="cart-summary">
        <div class="card-header">
            @php
                $total = 0;
            @endphp
            <div class="d-flex flex-row justify-content-between">
                <h4>Commande n°{{$commande->numero_commande}}</h4>
{{--                <h4 id="total">{{$total}} €</h4>--}}
            </div>
            @if($commande->date_livraison != getdate())
                <h4>En cours</h4>
            @else
                <h4>Livrée</h4>
            @endif
        </div>
        <div class="card-body">
            <div class="d-flex flex-column">
                <h4 class="card-title">Adresse de livraison : </h4>
                <p class="text-uppercase fw-bold mt-2">{{ $adresseLivraison->nom }} {{ $adresseLivraison->prenom }}</p>
                <p class="text-uppercase fw-bold">{{ $adresseLivraison->rue }}</p>
                <p class="text-uppercase fw-bold">{{ $adresseLivraison->code_postal }} {{ $adresseLivraison->ville }}</p>
                <p class="text-uppercase fw-bold">{{ $adresseLivraison->pays }}</p>
            </div>
            <div class="container">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <h4 class="card-title">Détail de votre commande : </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($meubles as $key => $meuble)
                            <tr>
                                <td class="text-center align-middle fs-5 fw-bold">{{$meuble->nom}}</td>
                                <td class="text-center align-middle fs-5 fw-bold">{{ $panierItems[$key]->quantite }}</td>
                                @php
                                    $prixTotal = $meuble->prix * $panierItems[$key]->quantite;
                                    $total += $prixTotal;
                                @endphp
                                <td class="text-center align-middle fs-5 fw-bold">{{$prixTotal}} €</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-end fs-5 fw-bold">Total :</td>
                            <td class="text-center fs-5 fw-bold">{{$total}} €</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
