@extends('layouts.main')

@section('content')
    <style>
        footer{
            position: fixed !important;
        }
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
        }
        .monPrix {
            border: 1px solid black;
        }
    </style>
    <div class="container">
        <p class="h3">Mon panier</p>
        <hr>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="progresses">
                <div class="steps">
                    <span><i class="fa fa-check"></i></span>
                </div>
                <span class="line"></span>
                <div class="steps">
                    <span class="font-weight-bold">2</span>
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
            <div class="listItem mt-5 col-9 w-75">
                @foreach($meubles as $key => $meuble)
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-2">
                                <img src="{{ asset('public/'.$meuble->photo1) }}" class="card-img-top" alt="...">
                            </div>
                            <div class="col-md-10 row">
                                <div class="col-9">
                                    <h5 class="card-title">{{$meuble->nom}}</h5>
                                    <p class="card-text">{{$meuble->description}}</p>
                                    <a href="#" class="text-danger">> Supprimer</a>
                                </div>
                                <div class="col-3">
                                    <h2 class="prix">{{$meuble->prix}} €</h2>
                                    <input type="number" name="quantite[]" class="form-control quantite" value="{{ $panierItems[$key]->quantite }}" min="1" max="{{$meuble->stock}}" data-prix="{{$meuble->prix}}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="monPrix col-3 mt-5 w-25 d-flex flex-column justify-content-around">
                <h4 class="d-flex justify-content-between">Total : <span>199 €</span></h4>
                <form action="{{ route('commande.creer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="utilisateur_commande" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="panier_commande" value="{{ $panier_id }}">
                    <button type="submit" class="btn btn-info w-100">Valider mon panier</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const quantites = document.querySelectorAll('.quantite');
        const prixTotalElement = document.querySelector('.monPrix span');

        function calculerPrixTotal() {
            let prixTotal = 0;

            quantites.forEach(quantite => {
                const prix = quantite.dataset.prix;
                const quantiteValue = quantite.value;
                prixTotal += prix * quantiteValue;
            });

            prixTotalElement.innerText = prixTotal.toFixed(2) + ' €';
        }

        quantites.forEach(quantite => {
            quantite.addEventListener('change', () => {
                const prix = quantite.dataset.prix;
                const h2 = quantite.parentElement.querySelector('.prix');
                h2.innerText = (prix * quantite.value).toFixed(2) + ' €';

                calculerPrixTotal();
            });

            const prix = quantite.dataset.prix;
            const h2 = quantite.parentElement.querySelector('.prix');
            h2.innerText = (prix * quantite.value).toFixed(2) + ' €';

            calculerPrixTotal();
        });
    </script>
@endsection
