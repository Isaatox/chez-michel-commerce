<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/inscription_connexion.css">
</head>
<body>
    <div class="inscription_connexion">
        <div class="formulaire">
            <h1>Connexion</h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div id='element'>
                    <label for="email" :value="__('Email')">Email :
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    </label>
                </div>

                <!-- Password -->
                <div id='element'>
                    <label for="password" :value="__('Password')">Mot de passe :
                        <input id="password" type="password" name="password" required autocomplete="current-password" />
                    </label>
                </div>

                <!-- Remember Me -->
                <div id='element'>
                    <label for='remember_me'>Se souvenir de moi
                        <input id="remember_me" type="checkbox" name="remember">
                    </label>
                </div>

                <div id='element'>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Mot de passe oublié ?') }}</a>
                    @endif
                    <div class="bouton">
                        <button class="btn">{{ __('Connexion') }}</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</body>
</html>