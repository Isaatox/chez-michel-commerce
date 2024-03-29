<div class="menu">
    <a href="{{route('mescommandes')}}">Mes commandes</a>
    <a href="{{route('mesInformations')}}">Mes informations</a>
    <a href="{{route('motedepasse')}}">Mot de passe</a>
    <a href="{{route('cartepaiement')}}">Mes cartes de paiement</a>
    @if(Auth::user()->role === "admin")
        <a href="{{route('indexAdmin')}}">Administration</a>
    @endif
    <a href="{{ route('logout') }}">Se déconnecter</a>
</div>
<div class="menuPhone" >
    <a href="{{route('mescommandes')}}"><i class="fa-solid fa-cart-shopping fa-lg"></i></a>
    <a href="{{route('mesInformations')}}"><i class="fa-solid fa-circle-info fa-lg"></i></a>
    <a href="{{route('motedepasse')}}"><i class="fa-solid fa-lock fa-lg"></i></a>
    <a href="{{route('cartepaiement')}}"><i class="fa-regular fa-credit-card fa-lg"></i></a>
    @if(Auth::user()->role === "admin")
        <a href="{{route('indexAdmin')}}"><i class="fa-solid fa-screwdriver-wrench fa-lg"></i></a>
    @endif
    <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket fa-lg"></i></a>
</div>
