@extends('layouts.main')

@section('content')
    <style>
        .ratingAll {
            display: flex;
            align-items: flex-end;
        }

        .ratingAll span {
            font-size: 1.2rem;
            color: #ffc107;
        }

        .ratingAll span:not(.checked) {
            color: #ddd;
            text-shadow: 1px 1px #bbb;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 20px;
            width: 100%;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border-radius: 6px;
            -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1)
        }

        .comment-box{
            padding:5px;
        }

        .comment-area textarea{
            width: 100%;
            resize: none;
            border: 1px solid #ad9f9f;
        }


        .form-control:focus {
            color: #000000FF;
            background-color: #fff;
            border-color: #ffffff;
            outline: 0;
            box-shadow: 0 0 0 1px rgb(255, 193, 7) !important;
        }

        .send {
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .send:hover {
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .rating {
            display: flex;
            margin-top: -10px;
            flex-direction: row-reverse;
            margin-left: -4px;
            float: left;
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 19px;
            font-size: 25px;
            color: #ffc107;
            cursor: pointer;
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }

        footer {
            position: fixed !important;
        }

        @media screen and (max-width: 768px) {
            footer {
                position: relative !important;
            }
        }
    </style>

    <div class="row m-0">
        <div class="col-md-6">
            <div class="d-flex">
                <div class="ml-2 d-flex flex-column align-items-center w-25 mt-5">
                    @if ($meuble->photo2)
                        <img src="{{ asset('public/'.$meuble->photo2) }}" class="img-fluid w-50 shadow-lg p-3 mb-5 bg-white rounded" style="cursor: pointer" alt="..." onclick="selectImage(this)">
                    @endif
                    @if ($meuble->photo3)
                        <img src="{{ asset('public/'.$meuble->photo3) }}" class="img-fluid w-50 mt-2 shadow-lg p-3 bg-white rounded" style="cursor: pointer" alt="..." onclick="selectImage(this)">
                    @endif
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
                <div class="ratingAll">
                    @php($moyenne = round($meuble->avis->avg('note')))
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $moyenne)
                            <span class="fa fa-star checked"></span>
                        @else
                            <span class="fa fa-star"></span>
                        @endif
                    @endfor
                    <p>({{ $meuble->avis->count() }})</p>
                </div>
                <hr>
                @if ($meuble->stock > 0)
                    <p class="h5">{{ $meuble->stock }} en stock !</p>
                    <hr>
                    <form action="{{ route('meuble.ajouter-au-panier', $meuble->id) }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="number" name="quantite" class="form-control" value="1" min="1" max="{{ $meuble->stock }}">
                            <button type="submit" class="btn btn-info text-uppercase fw-bold text-white" {{ $meuble->stock <= 0 ? 'disabled' : '' }}>
                                Ajouter au panier
                            </button>
                        </div>
                    </form>
                @else
                    <p class="h5 text-danger">Stock épuisé</p>
                @endif
            </div>
        </div>
        <hr>
    </div>
    <div class="container">
    @auth
        <div class="card">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="comment-box ml-2">
                        <form action="{{ route('avis-meuble.ajouterAvis') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_meuble" value="{{ $meuble->id }}">
                            <h4>Laisse un commentaire</h4>
                            <div class="rating">
                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                <input type="radio" name="rating" value="1" id="1" checked><label for="1">☆</label>
                            </div>
                            <div class="comment-area">
                                <textarea class="form-control" name="commentaire" placeholder="Donnez votre avis ?" rows="4"></textarea>
                            </div>
                            <div class="comment-btns mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="pull-right d-flex justify-content-end">
                                            <button class="btn btn-success send btn-sm">Envoyer <i class="fa fa-long-arrow-right ml-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
        <div class="row">
            @php($count = 0)
            @foreach ($meuble->avis as $avis)
                @php($count++)
                <div class="col-8 w-100 {{ $count > 4 ? 'd-none' : 'd-flex' }}" id="commentaire">
                <div class="card card-white post">
                    <div class="post-heading">
                        <div class="float-left meta">
                            <div class="title h5">
                                <b>{{ $avis->utilisateur->nom }}&nbsp;{{ $avis->utilisateur->prenom }}</b>
                                a posté un commentaire.
                            </div>
                            <h6 class="text-muted time">{{ $avis->created_at->locale('fr_FR')->diffForHumans() }}</h6>
                        </div>
                    </div>
                    <div class="post-description">
                        <p>{{$avis->commentaire}}</p>
                    </div>
                    <div class="ratingAll">
                        @for ($i = 1; $i <= $avis->note; $i++)
                            <span class="fa fa-star checked"></span>
                        @endfor
                        @for ($i = $avis->note + 1; $i <= 5; $i++)
                            <span class="fa fa-star"></span>
                        @endfor
                    </div>
                </div>
            </div>
            @endforeach
            @if ($count > 4)
                <div class="col-8 w-100 d-flex justify-content-center mt-2">
                    <button class="btn btn-primary" id="voir-plus">Voir plus</button>
                </div>
            @endif
        </div>

    </div>

    <script !src="">
        function selectImage(img) {
            var mainImage = document.getElementById("mainImage");
            var tempSrc = mainImage.src;
            mainImage.src = img.src;
            img.src = tempSrc;
        }

        const voirPlus = document.getElementById('voir-plus');
        const commentaires = document.querySelectorAll('#commentaire');

        let index = 4;

        voirPlus.addEventListener('click', () => {
            for (let i = index; i < index + 4 && i < commentaires.length; i++) {
                commentaires[i].classList.add('d-flex');
                commentaires[i].classList.remove('d-none');
                console.log(commentaires[i])
            }
            index += 4;
            if (index >= commentaires.length) {
                voirPlus.style.display = 'none';
            }
        });
    </script>
@endsection
