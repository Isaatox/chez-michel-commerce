<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/inscription_connexion.css">

</head>
<body>
    <div class="inscription_connexion">
        <div class="formulaire">
            <h1>Incription</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div class="element">
                    <label for="name" :value="__('Name')" >Nom :<br>
                        <input id="name"type="text" name="name" :value="old('name')" required autofocus />
                    </label>
                </div>

                <!-- Entreprise -->
                <div class="element">
                    <label for="entreprise" :value="__('Entreprise')" >Entreprise :<br>
                        <input id="entreprise" type="text" name="entreprise" :value="old('entreprise')" required autofocus />
                    </label>
                </div>
            
                <!-- Email Address -->
                <div class="element">
                    <label for="email" :value="__('Email')">Email :<br>
                        <input id="email" type="email" name="email" :value="old('email')" required />
                    </label>
                </div>
            
                <!-- Password -->
                <div class="element">
                    <label for="password" :value="__('Password')" >Mot de passe : <br>
                        <input id="password" type="password" name="password" required autocomplete="new-password" />
                    </label>
                </div>
            
            
                <!-- Confirm Password -->
                <div class="element">
                    <label for="password_confirmation" :value="__('Confirm Password')" >Confirmer votre mot de passe : <br>
                        <input id="password_confirmation" type="password" name="password_confirmation" required />
                    </label>
                </div>
            
                <a href="{{ route('login') }}">{{ __('Déjà inscrit ?') }}</a><br>
                <div class="bouton">
                    <button class="btn">{{ __('Inscription') }}</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>