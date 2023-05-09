<link rel="stylesheet" href="{{ url('css/nav.css') }}">

<header>
    <a href="{{route('index')}}" class="logo">
        <img src="{{ asset('image/chez_michel.png') }}" alt="">
        Chez Michel
    </a>
    <div class="search">
        <input type="text" name="" placeholder="Rechercher un article" id="">
        <i class="fas fa-search"></i>
    </div>
    <div class="navigation">
        @if (Route::has('login'))
            @auth
                <div class="mon_profile" onclick="location.href='/moncompte/mesinformations'">
                    <p id="profile">Mon profil</p>
                    <i class="fas fa-user-circle fa-2x"></i>
                </div>
            @else
                <a href="{{ route('login') }}" id="connecter">Se connecter</a>
            @endauth
        @endif


    </div>
    <div class="panier" onclick="location.href='{{route('monPanier.detail')}}'">
        <a href="#">Mon panier</a>
        <i class="fas fa-shopping-cart fa-2x"></i>
        @if(isset($countPanierItems) && $countPanierItems > 0)
          <div class="circle">
          <p>{{$countPanierItems}}</p>
         </div>
        @endif
    </div>
</header>
