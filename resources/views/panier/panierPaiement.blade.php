@extends('layouts.main')

@section('content')
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
        <h1 class="text-center">Paiement</h1>
        <hr>
        <div class="container d-flex justify-content-center align-items-center mb-3">
            <div class="progresses">
                <div class="steps">
                    <span><i class="fa fa-check"></i></span>
                </div>
                <span class="line"></span>
                <div class="steps">
                    <span><i class="fa fa-check"></i></span>
                </div>
                <span class="line"></span>
                <div class="steps">
                    <span><i class="fa fa-check"></i></span>
                </div>
                <span class="line"></span>
                <div class="steps">
                    <span class="font-weight-bold">4</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="listItem col-9 w-75">
                    <h4>Carte bancaire 'enregistré'</h4>
                    <form id="form_nouvelle_cb" action="{{route('paiement.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="carte_bancaire">Carte bancaire</label>
                            <select class="form-control" id="select_option" name="carte_bancaire">
                                <option>Choisir une carte bancaire</option>
                                @foreach($cartes as $carte)
                                    <option value="{{$carte['ID']}}" >
                                        **** **** **** {{$carte['last4']}} - {{$carte['brand']}} - {{$carte['exp_date']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <h4>Nouvelle carte bancaire</h4>
                        <div class="form-group">
                            <label for="nom_carte">Nom sur la carte</label>
                            <input type="text" class="form-control" id="nom_carte" name="nom_carte">
                        </div>
                        <div class="form-group">
                            <label for="numero_carte">Numéro de carte</label>
                            <input type="text" class="form-control" id="numero_carte" name="numero_carte">
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="date_expiration">Date d'expiration (MM/AA)</label>
                                <input type="text" class="form-control" id="date_expiration" name="date_expiration">
                            </div>
                            <div class="col">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control" id="cvc" name="cvc">
                            </div>
                        </div>
                        <hr>
                        <h4>Autre moyen de paiement</h4>
                        <img src="https://www.veloelectriquefrance.fr/img/cms/Subvention/Paypal.png" style="width: 40%" alt="" srcset="">
                        <hr>
                        <button id="valider_adresse" type="submit" class="btn btn-success mt-3 mb-3 w-100">Valider ma commande</button>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-column ml-auto">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Votre Panier</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $total = 0;
                            @endphp
                            @foreach($meubles as $key => $meuble)
                                <div class="d-flex justify-content-between">
                                    <img src="{{ asset('public/'.$meuble->photo1) }}" class="card-img-bottom w-25" alt="...">
                                    <div>
                                        <div class="d-flex justify-content-between w-100" style="margin-right: 100px">
                                            <p class="fw-bold h5">{{$meuble->nom}}</p>
                                            @php
                                                $prixTotal = $meuble->prix * $panierItems[$key]->quantite;
                                                $total += $prixTotal;
                                            @endphp
                                            <p class="fw-bold h5">{{$prixTotal}} €</p>
                                        </div>
                                        <p class="fw-bold h5">X {{ $panierItems[$key]->quantite }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            <p class="fw-bold h4  mt-3">Total: {{ $total }} €</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Adresse de livraison</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                @if ($adresseLivraison)
                                    <p class="h5">{{ $adresseLivraison->nom }} {{ $adresseLivraison->prenom }}</p>
                                    <p class="h5">{{ $adresseLivraison->rue }}</p>
                                    <p class="h5">{{ $adresseLivraison->code_postal }} {{ $adresseLivraison->ville }}</p>
                                    <p class="h5">{{ $adresseLivraison->pays }}</p>
                                @else
                                    <p>Aucune adresse sélectionnée.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Erreur carte bancaire</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        La date d'expiration de votre carte bancaire est incorrecte.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-erreur-date" tabindex="-1" role="dialog" aria-labelledby="modal-erreur-date-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modal-erreur-date-label">Erreur de date d'expiration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        La date d'expiration de la carte bancaire est incorrecte. Veuillez entrer une date au format MM/AA.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const form = document.getElementById("form_nouvelle_cb");
        const selectOption = document.getElementById("select_option");

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            // Récupération des valeurs du formulaire
            const nomCarte = document.getElementById("nom_carte").value;
            const numeroCarte = document.getElementById("numero_carte").value;
            const cvc = document.getElementById("cvc").value;

            // Vérification des champs du formulaire
            if (selectOption.value === "Choisir une carte bancaire" && (!nomCarte || !numeroCarte || !cvc)) {
                alert("Veuillez remplir les champs obligatoires");
                return;
            }

            // Affichage du loader
            const loader = document.createElement("div");
            loader.classList.add("modal-backdrop", "show", "d-flex", "justify-content-center", "align-items-center");
            loader.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="sr-only">Chargement...</span></div>';
            document.body.appendChild(loader);

            // Soumission du formulaire
            setTimeout(function () {
                form.submit();
            }, 3000); // temps en millisecondes du délai du loader

            // Fermeture du loader
            setTimeout(function () {
                loader.remove();
            }, 5000); // temps en millisecondes du délai de fermeture du loader
        });

    </script>
@endsection
