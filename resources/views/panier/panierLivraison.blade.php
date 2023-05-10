@extends('layouts.main')

@section('content')
    <style>
        .progresses {
            display: flex;
            align-items: center;
        }

        footer {
            position: fixed !important;
        }

        .line {

            width: 120px;
            height: 6px;
            background: #2C8C99;
        }


        .steps {

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
        <h1 class="text-center">Adresse de livraison</h1>
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
                    <span class="font-weight-bold">3</span>
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

                    <h4>Adresses connues</h4>
                    <form id="form_nouvelle_adresse" action="{{ route('adresseLivraison.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="adresse_livraison">Adresse de livraison</label>
                            <select class="form-control" id="adresse_livraison" name="adresse_livraison">
                                <option value="">Choisir une adresse de livraison</option>
                                @foreach ($adresseLivraison as $mesAdresseLivraison)
                                    <option value="{{ $mesAdresseLivraison->id }}">{{ $mesAdresseLivraison->nom }}
                                        {{ $mesAdresseLivraison->prenom }} - {{ $mesAdresseLivraison->rue }},
                                        {{ $mesAdresseLivraison->code_postal }} {{ $mesAdresseLivraison->ville }},
                                        {{ $mesAdresseLivraison->pays }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <h4>Nouvelle adresse</h4>

                        <div class="form-group row">
                            <div class="col">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control">
                            </div>
                            <div class="col">
                                <label for="prenom">Prenom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="adresse" id="adresse" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="code_postal">Code postal</label>
                                    <input type="number" min="0" name="code_postal" id="code_postal"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input type="text" name="pays" id="pays" class="form-control">
                            <input type="hidden" name="id_utilisateur" value="{{ auth()->user()->id }}">
                        </div>
                        <hr>
                        <button id="valider_adresse" type="submit" class="btn btn-success mt-3 mb-3 w-100">Valider cette
                            adresse</button>
                    </form>

                </div>
            </div>
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Votre Panier</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($meubles as $key => $meuble)
                            <div class="d-flex justify-content-between">
                                <img src="{{ asset('public/' . $meuble->photo1) }}" class="card-img-bottom w-25"
                                    alt="...">
                                <div>
                                    <div class="d-flex justify-content-between w-100" style="margin-right: 100px">
                                        <p class="fw-bold h5">{{ $meuble->nom }}</p>
                                        @php
                                            $prixTotal = $meuble->prix * $panierItems[$key]->quantite;
                                            $total += $prixTotal;
                                        @endphp
                                        <p class="fw-bold h5">{{ $prixTotal }} €</p>
                                    </div>
                                    <p class="fw-bold h5">X {{ $panierItems[$key]->quantite }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <p class="fw-bold h4  mt-3">Total: {{ $total }} €</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var radioButtons = document.querySelectorAll('input[type=radio][name=adresse_livraison]');
            var inputFields = document.querySelectorAll('input[type=text], input[type=email], textarea');

            // Function to clear input fields
            function clearInputFields() {
                for (var i = 0; i < inputFields.length; i++) {
                    inputFields[i].value = '';
                }
            }

            // Event listener for form click
            document.querySelector('form').addEventListener('click', function(event) {
                // If a radio button is clicked
                if (event.target.type === 'radio') {
                    clearInputFields();
                } else {
                    // Uncheck all radio buttons
                    for (var i = 0; i < radioButtons.length; i++) {
                        radioButtons[i].checked = false;
                    }
                }
            });
        });

        const radioButtons = document.querySelectorAll('input[type=radio][name=adresse_livraison]');
        radioButtons.forEach(button => {
            button.addEventListener('change', function() {
                // Réinitialiser l'attribut checked de tous les boutons radio
                radioButtons.forEach(b => {
                    b.removeAttribute('checked');
                });

                // Définir l'attribut checked pour le bouton sélectionné
                this.setAttribute('checked', 'checked');
            });
        });
    </script>
@endsection
