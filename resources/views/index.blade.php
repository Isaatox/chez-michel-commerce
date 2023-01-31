@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ url('css/accueil.css') }}">
<script src="{{ url('js/accueil.js') }}"></script>
    <main>
        <div class="container">
            <p class="h3">Nos produits populaires</p>
            <hr>
            <div class="filtres">
                <div class="filtre">Prix
                    <div class="dropdown">
                        <button onclick="dropdownPrix()" class="dropbtn">Sélectionner Prix<i
                                class="fa-solid fa-caret-down mt-1"></i></button>
                        <div id="dropdownPrix" class="dropdown-content">
                            <div class="container">
                                <div class="price-input">
                                    <div class="field">
                                        <span>Min</span>
                                        <input type="number" class="input-min" value="2500">
                                        <span>€</span>
                                    </div>
                                    <div class="separator">-</div>
                                    <div class="field">
                                        <span>Max</span>
                                        <input type="number" class="input-max" value="7500">
                                        <span>€</span>
                                    </div>
                                </div>
                                <div class="slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min" min="0" max="10000" value="2500"
                                        step="100">
                                    <input type="range" class="range-max" min="0" max="10000" value="7500"
                                        step="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filtre">Couleur
                    <div class="dropdown">
                        <button onclick="dropdownCouleur()" class="dropbtn">Sélectionner la couleur<i
                                class="fa-solid fa-caret-down mt-1"></i></button>
                        <div id="dropdownCouleur" class="dropdown-content">
                            <div class="container item">
                                <div>
                                    <input type="checkbox" id="noir" name="noir">
                                    <label for="noir" class="couleur noir"></label>
                                </div>
                                <div>
                                    <input type="checkbox" id="blanc" name="blanc">
                                    <label for="blanc" class="couleur blanc"></label>
                                </div>
                                <div>
                                    <input type="checkbox" id="gris" name="gris">
                                    <label for="gris" class="couleur gris"></label>
                                </div>
                                <div>
                                    <input type="checkbox" id="marron" name="marron">
                                    <label for="marron" class="couleur marron"></label>
                                </div>
                                <div>
                                    <input type="checkbox" id="bleu" name="bleu">
                                    <label for="bleu" class="couleur bleu"></label>
                                </div>
                                <div>
                                    <input type="checkbox" id="rouge" name="rouge">
                                    <label for="rouge" class="couleur rouge"></label>
                                </div>
                                <div>
                                    <input type="checkbox" id="rose" name="rose">
                                    <label for="rose" class="couleur rose"></label>
                                </div>
                                <div>
                                    <input type="checkbox" id="vert" name="vert">
                                    <label for="vert" class="couleur vert"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filtre">Trier
                    <div class="dropdown">
                        <button onclick="dropdownOrdre()" class="dropbtn">Trier<i
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
                        <button onclick="dropdownCategorie()" class="dropbtn">Sélectionner la catégorie<i
                                class="fa-solid fa-caret-down mt-1"></i></button>
                        <div id="dropdownCategorie" class="dropdown-content">
                            <div class="container">
                                <ul>
                                    <li>
                                        <input type="checkbox" id="bureau" name="bureau" value="bureau">
                                        <label for="bureau">Bureau</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="table" name="table" value="table">
                                        <label for="table">Table</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="tableDeSalon" name="tableDeSalon"
                                            value="tableDeSalon">
                                        <label for="tableDeSalon">Table de salon</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">Rechercher</button>
            </div>
        </div>
        <div class="cartes">
            <div class="row gy-5">
                <div class="col-6">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('image/meuble1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <p class="price">195,99 €</p>
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
                            <a href="#"
                                class="btn btn-primary d-flex align-items-center justify-content-center">Voir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('image/meuble2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <p class="price">195,99 €</p>
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
                            <a href="#"
                                class="btn btn-primary d-flex align-items-center justify-content-center">Voir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('image/meuble3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <p class="price">195,99 €</p>
                        </div>
                        <div class="card-footer d-flex align-items-center space-between">
                            <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <p>(15)</p>
                            </div>
                            <a href="#"
                                class="btn btn-primary d-flex align-items-center justify-content-center">Voir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('image/meuble1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <p class="price">195,99 €</p>
                        </div>
                        <div class="card-footer d-flex align-items-center space-between">
                            <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <p>(15)</p>
                            </div>
                            <a href="#"
                                class="btn btn-primary d-flex align-items-center justify-content-center">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
