@extends('layouts.mainCompte')
@section('content')
    <div class="columns-md w-100">




   <style>
        .progresses{
            display: flex;
            align-items: center;
        }

        .line{

            width: 120px;
            height: 6px;
            background: #2C8C99;
        }


        .steps{

            display: flex;
            background-color: #2C8C99;
            color: #fff;
            font-size: 14px;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;

        }

        .listItem {
            border: 1px solid black;
            width: auto;
            padding: 5px;
        }
        .monPrix {
            border: 1px solid black;
        }
    </style>
    <div class="container">
        <div class="breadcrumbs mt-3">
            {{ Breadcrumbs::render('mesCommandes') }}
        </div>
        <hr>
        @foreach($commandes as $commande)

            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <h5 class="card-title">Commande n°{{$commande->numero_commande}}</h5>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        @if($commande->date_livraison >= now())
                            <p class="card-text">En cours de livraison</p>
                        @else
                            <p class="card-text">Livrée</p>
                        @endif
                        <a href="{{route('mescommandes.voir', ['id' => $commande->id])}}" class="card-link mt-5">Voir en détails >></a>
                    </div>
                </div>
            </div>
        @endforeach

{{--        <div class="card mt-5" id="cart-summary">--}}
{{--            <div class="card-header">--}}
{{--                @php--}}
{{--                    $total = 0;--}}
{{--                @endphp--}}
{{--                <div class="d-flex flex-row justify-content-between">--}}
{{--                    <h4>Commande n°{{$commande->numero_commande}}</h4>--}}
{{--                    <h4 id="total">{{$total}} €</h4>--}}
{{--                </div>--}}
{{--                @if($commande->date_livraison != getdate())--}}
{{--                    <h4>En cours</h4>--}}
{{--                @else--}}
{{--                    <h4>Livrée</h4>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="d-flex flex-column">--}}
{{--                    <h4 class="card-title">Adresse de livraison : </h4>--}}
{{--                    <p class="text-uppercase fw-bold mt-2">{{ $adresseLivraison->nom }} {{ $adresseLivraison->prenom }}</p>--}}
{{--                    <p class="text-uppercase fw-bold">{{ $adresseLivraison->rue }}</p>--}}
{{--                    <p class="text-uppercase fw-bold">{{ $adresseLivraison->code_postal }} {{ $adresseLivraison->ville }}</p>--}}
{{--                    <p class="text-uppercase fw-bold">{{ $adresseLivraison->pays }}</p>--}}
{{--                </div>--}}
{{--                <div class="container">--}}
{{--                    <div class="d-flex flex-row align-items-center justify-content-between">--}}
{{--                        <h4 class="card-title">Détail de votre commande : </h4>--}}
{{--                        <a href="{{route('monPanier.pdf')}}" >Télécharger la facture</a>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-striped table-bordered">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">Image</th>--}}
{{--                                <th scope="col">Nom</th>--}}
{{--                                <th scope="col">Quantité</th>--}}
{{--                                <th scope="col">Prix</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($meubles as $key => $meuble)--}}
{{--                                <tr>--}}
{{--                                    <td class="p-0 w-25 text-center align-middle"><img src="{{ asset('public/'.$meuble->photo1) }}" class="card-img-bottom img-thumbnail w-50" alt="Image du produit"></td>--}}
{{--                                    <td class="text-center align-middle fs-5 fw-bold">{{$meuble->nom}}</td>--}}
{{--                                    <td class="text-center align-middle fs-5 fw-bold">{{ $panierItems[$key]->quantite }}</td>--}}
{{--                                    @php--}}
{{--                                        $prixTotal = $meuble->prix * $panierItems[$key]->quantite;--}}
{{--                                        $total += $prixTotal;--}}
{{--                                    @endphp--}}
{{--                                    <td class="text-center align-middle fs-5 fw-bold">{{$prixTotal}} €</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            <tr>--}}
{{--                                <td colspan="3" class="text-end fs-5 fw-bold">Total :</td>--}}
{{--                                <td class="text-center fs-5 fw-bold">{{$total}} €</td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    </div>
    <script>
        const total = document.getElementById('total');
        const prixTotal = document.querySelector('tbody tr:last-child td:last-child').textContent.trim();
        total.textContent = prixTotal;
    </script>
@endsection
