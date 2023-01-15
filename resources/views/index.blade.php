@extends('layouts.main')

@section('content')
    <style>
        .h3 {
            font-weight: 400;
            margin-top: 1rem;
        }

        .filtres {
            display: flex;
            justify-content: space-evenly;
        }

        .dropbtn {
            /* background-color: #3498DB; */
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            color: black;
            padding: 13px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 10px
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #6c6c6c;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);
            z-index: 1;
            width: 25rem;
            height: 8rem;
            border-radius: 10px;
            margin-top: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }

        .mt-1 {
            margin-left: 1rem;
        }

        .price-input {
            width: 100%;
            display: flex;
            margin: 30px 0 35px;
            justify-content: space-evenly
        }

        .price-input .field {
            display: flex;
            width: 35%;
            height: 25px;
            align-items: center;
        }

        .field input {
            width: 100%;
            height: 100%;
            outline: none;
            font-size: 19px;
            margin-left: 12px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #999;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .price-input .separator {
            width: 130px;
            display: flex;
            font-size: 19px;
            align-items: center;
            justify-content: center;
        }

        .slider {
            height: 5px;
            position: relative;
            background: #ddd;
            border-radius: 5px;
        }

        .slider .progress {
            height: 100%;
            left: 25%;
            right: 25%;
            position: absolute;
            border-radius: 5px;
            background: #17A2B8;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            top: -5px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 50%;
            background: #17A2B8;
            pointer-events: auto;
            -webkit-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        input[type="range"]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #17A2B8;
            pointer-events: auto;
            -moz-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        .item {
            display: flex;
            flex-wrap: wrap;
        }

        .couleur {
            border: 1px black solid;
            border-radius: 100%;
            width: 2rem;
            clip-path: ellipse(50% 50%);
            height: 2rem;
            margin-left: 15px;
            margin-top: 15px;
            padding: 20px
        }

        .couleur:hover {
            cursor: pointer;
            border: 1px #00ddff solid
        }

        .marron {
            background-color: brown
        }

        .bleu {
            background-color: blue
        }

        .rouge {
            background-color: red
        }

        .rose {
            background-color: pink
        }

        .vert {
            background-color: green
        }

        .gris {
            background-color: grey
        }

        .blanc {
            background-color: white
        }

        .noir {
            background-color: black
        }

        .item input {
            opacity: 0;
        }

        .container input:checked+label::before {
            content: '\2714';
            font-size: 16px;
        }

        #dropdownOrdre ul {
            list-style-type: none;
            padding: 0;
        }

        #dropdownOrdre li {
            display: flex;
            align-items: center;
            padding: 8px;
        }

        #dropdownOrdre input[type="radio"] {
            margin-right: 8px;
        }

        #dropdownOrdre input[type="radio"]:checked+label {
            font-weight: bold;
        }



        #dropdownCategorie ul {
            list-style-type: none;
            padding: 0;
        }

        #dropdownCategorie li {
            display: flex;
            align-items: center;
            padding: 8px;
        }

        #dropdownCategorie input[type="checkbox"] {
            margin-right: 8px;
        }

        #dropdownCategorie input[type="checkbox"]:checked+label {
            font-weight: bold;
        }

        .btn {
            height: 3rem;
            width: 7rem;
            margin-top: 1.5rem;
        }

        @media only screen and (max-width: 600px) {
            .h3 {
                font-size: 1rem;
            }

            .filtres {
                gap: 1rem;
                display: flex;
                justify-content: space-evenly;
                flex-direction: column;
            }

            .btn {
                width: auto;
            }

            .dropbtn {
                padding: 1rem;
                width: 100%;
            }

            .dropdown-content a {
                font-size: 1.2rem;
            }

            .field input {
                width: 80%;
                font-size: 1.2rem;
            }

            .price-input .separator {
                width: 80px;
            }
        }
    </style>
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
                                        <label for="nom">Table de salon</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">Rechercher</button>
            </div>
        </div>
    </main>
    <script>
        function dropdownPrix() {
            document.getElementById("dropdownPrix").classList.toggle("show");

            document.getElementById("dropdownCouleur").classList.remove("show");
            document.getElementById("dropdownOrdre").classList.remove("show");
            document.getElementById("dropdownCategorie").classList.remove("show");
        }

        function dropdownCouleur() {
            document.getElementById("dropdownCouleur").classList.toggle("show");

            document.getElementById("dropdownOrdre").classList.remove("show");
            document.getElementById("dropdownCategorie").classList.remove("show");
            document.getElementById("dropdownPrix").classList.remove("show");
        }

        function dropdownOrdre() {
            document.getElementById("dropdownOrdre").classList.toggle("show");


            document.getElementById("dropdownCouleur").classList.remove("show");
            document.getElementById("dropdownCategorie").classList.remove("show");
            document.getElementById("dropdownPrix").classList.remove("show");
        }

        function dropdownCategorie() {
            document.getElementById("dropdownCategorie").classList.toggle("show");


            document.getElementById("dropdownCouleur").classList.remove("show");
            document.getElementById("dropdownOrdre").classList.remove("show");
            document.getElementById("dropdownPrix").classList.remove("show");
        }

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });

        var inputs = document.querySelectorAll('.container input');
        inputs.forEach(function(input) {
            input.addEventListener('change', function() {
                if (this.checked) {
                    this.nextElementSibling.classList.add('selected');
                    this.setAttribute('checked', '');
                } else {
                    this.nextElementSibling.classList.remove('selected');
                    this.removeAttribute('checked', '');

                }
            });
        });
        var inputs = document.querySelectorAll('#dropdownOrdre input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('change', function() {
                var previouslyChecked = document.querySelector("#dropdownOrdre input[checked]");
                if (previouslyChecked) previouslyChecked.removeAttribute("checked");
                this.setAttribute("checked", '');
                sortProducts(this.value);
            });
        }
    </script>
@endsection
