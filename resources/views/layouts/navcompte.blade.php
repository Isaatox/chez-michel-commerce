<div class="menu">
    <a href="#">Mes commandes</a>
    <a href="#">Mes informations</a>
    <a href="#">Mot de passe</a>
    <a href="#">Mes cartes de paiement</a>
    @if(Auth::user()->role === "admin")
        <a href="#">Administration</a>
    @else

    @endif
    <a href="{{ route('logout') }}">Se déconnecter</a>
</div>
<div class="menuPhone" >
    <a href="#"><i class="fa-solid fa-cart-shopping fa-lg"></i></a>
    <a href="#"><i class="fa-solid fa-circle-info fa-lg"></i></a>
    <a href="#"><i class="fa-solid fa-lock fa-lg"></i></a>
    <a href="#"><i class="fa-regular fa-credit-card fa-lg"></i></a>
    <a href="#"><i class="fa-solid fa-right-from-bracket fa-lg"></i></a>
</div>

