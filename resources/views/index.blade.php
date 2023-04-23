@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ url('css/accueil.css') }}">
    <main>
        <div class="container">
            <p class="h3">Nos produits populaires</p>
            <hr>
            <form action="{{route('meubles.filtres')}}" method="get">
            <div class="filtres">
                <div class="filtre">Prix
                    <div class="dropdown">
                        <button type="button" onclick="dropdownPrix()" class="dropbtn">Sélectionner Prix<i
                                class="fa-solid fa-caret-down mt-1"></i></button>
                        <div id="dropdownPrix" class="dropdown-content">
                            <div class="container">
                                <div class="price-input">
                                    <div class="field">
                                        <span>Min</span>
                                        <input type="number" class="input-min" name="min_prix" value="0">
                                        <span>€</span>
                                    </div>
                                    <div class="separator">-</div>
                                    <div class="field">
                                        <span>Max</span>
                                        <input type="number" class="input-max" name="max_prix" value="10000">
                                        <span>€</span>
                                    </div>
                                </div>
                                <div class="slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min" min="0" max="10000" value="0"
                                        step="100">
                                    <input type="range" class="range-max" min="0" max="10000" value="10000"
                                        step="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filtre">Couleur
                    <div class="dropdown">
                        <button type="button" onclick="dropdownCouleur()" class="dropbtn">Sélectionner la couleur<i
                                class="fa-solid fa-caret-down mt-1"></i></button>
                        <div id="dropdownCouleur" class="dropdown-content">
                            <div class="container item">
                                @foreach ($couleurs as $couleur)
                                    <div>
                                        <input type="checkbox" id="{{$couleur->nom}}" name="couleur[]" value="{{$couleur->id}}">
                                        <label for="{{$couleur->nom}}" class="couleur {{$couleur->nom}}" style="background-color: {{$couleur->hex_couleur}}"></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filtre">Trier
                    <div class="dropdown">
                        <button type="button" onclick="dropdownOrdre()" class="dropbtn">Trier<i
                                class="fa-solid fa-caret-down mt-1"></i></button>
                        <div id="dropdownOrdre" class="dropdown-content">
                            <div class="container">
                                <ul>
                                    <li>
                                        <input type="radio" id="prixCroissant" name="ordre" value="prixCroissant">
                                        <label for="prixCroissant">Prix croissant</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="prixDecroissant" name="ordre" value="prixDecroissant">
                                        <label for="prixDecroissant">Prix décroissant</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="nom" name="ordre" value="nom">
                                        <label for="nom">Nom</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="noteClient" name="ordre" value="noteClient">
                                        <label for="noteClient">Note client</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filtre">Catégorie
                    <div class="dropdown">
                        <button type="button" onclick="dropdownCategorie()" class="dropbtn">Sélectionner la catégorie<i
                                class="fa-solid fa-caret-down mt-1"></i></button>
                        <div id="dropdownCategorie" class="dropdown-content">
                            <div class="container">
                                <ul>
                                    @foreach ($categories as $categorie)
                                        <li>
                                            <input type="checkbox" id="{{$categorie->nom}}" name="categorie[]" value="{{$categorie->id}}">
                                            <label for="{{$categorie->nom}}">{{$categorie->label}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
            </form>
        </div>
        <div class="cartes">
            <div class="row gy-5">
                @if($meubles->count() == 0)
                    <p>Aucun meuble trouvé</p>
                @else
                    @foreach($meubles as $meuble)
                        <div class="col-6">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('public/'.$meuble->photo1) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$meuble->nom}}</h5>
                                    @if(strlen($meuble->description) > 100)
                                        <p class="card-text">{{ substr($meuble->description, 0, 100) }}...</p>
                                    @else
                                        <p class="card-text">{{ $meuble->description }}</p>
                                    @endif
                                    <p class="price">{{$meuble->prix}} €</p>
                                </div>
                                <div class="card-footer d-flex align-items-center space-between">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <p>(15)</p>
                                    </div>
                                    <a href="{{ route('voir.meuble', ['id' => $meuble->id]) }}" class="btn btn-primary d-flex align-items-center justify-content-center">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
<script src="{{ url('js/accueil.js') }}"></script>
@endsection
