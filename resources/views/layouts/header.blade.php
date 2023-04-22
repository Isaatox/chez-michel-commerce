<link rel="stylesheet" href="{{ url('css/nav.css') }}">

<header>
    <a href="#" class="logo">
        <img src="image/chez_michel.png" alt="">
        Chez Michel
    </a>
    <div class="search">
        <input type="text" name="" placeholder="Rechercher un article" id="">
        <i class="fas fa-search"></i>
    </div>
    <div class="navigation">
        @if (Route::has('login'))
            @auth
                <div class="mon_profile" onclick="location.href='/compte'">
                    <p id="profile">Mon profil</p>
                    <i class="fas fa-user-circle fa-2x"></i>
                </div>
            @else
                <a href="{{ route('login') }}" id="connecter">Se connecter</a>
            @endauth
        @endif


    </div>
    <div class="panier" onclick="location.href='google.com'">
        <a href="#">Mon panier</a>
        <i class="fas fa-shopping-cart fa-2x"></i>
        <div class="circle">
            <p>1</p>
        </div>
    </div>
</header>
