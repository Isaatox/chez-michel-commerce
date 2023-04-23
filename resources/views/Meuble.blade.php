@extends('layouts.main')

@section('content')
    <style>
        .rating {
            display: flex;
            align-items: flex-end;
        }

        .rating span {
            font-size: 1.2rem;
            color: #ffc107;
        }

        .rating span:not(.checked) {
            color: #ddd;
            text-shadow: 1px 1px #bbb;
        }
    </style>
    <div class="row m-0">
        <div class="col-md-6">
            <div class="d-flex">
                <div class="ml-2 d-flex flex-column align-items-center w-25 mt-5">
                    <img src="{{ asset('public/'.$meuble->photo2) }}" class="img-fluid w-50 shadow-lg p-3 mb-5 bg-white rounded" style="cursor: pointer" alt="..." onclick="selectImage(this)">
                    <img src="{{ asset('public/'.$meuble->photo3) }}" class="img-fluid w-50 mt-2 shadow-lg p-3 bg-white rounded" style="cursor: pointer" alt="..." onclick="selectImage(this)">
                </div>
                <div class="p-5">
                    <img id="mainImage" src="{{ asset('public/'.$meuble->photo1) }}" class="img-fluid flex-grow-1 h-auto w-auto shadow-lg p-3 mb-5 rounded" alt="...">
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-between">
                    <h3>{{ $meuble->nom }}</h3>
                    <h3>{{ $meuble->prix }} €</h3>
                </div>
                <p class="h6">{{ $meuble->description }}</p>
                <div class="rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p>(15)</p>
                </div>
                <hr>
                <p class="h5">{{$meuble->stock}} en stock !</p>
                <hr>
                <a href="#" class="btn btn-info text-uppercase fw-bold text-white">Ajouter au panier</a>
            </div>
        </div>
    </div>

    <script !src="">
        function selectImage(img) {
            var mainImage = document.getElementById("mainImage");
            var tempSrc = mainImage.src;
            mainImage.src = img.src;
            img.src = tempSrc;
        }
    </script>
@endsection
