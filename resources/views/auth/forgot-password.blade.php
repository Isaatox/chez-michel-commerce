<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mot de passe oublier</title>
    <link rel="stylesheet" href="css/inscription_connexion.css">
</head>
<body>
    <div class="inscription_connexion">
        <div class="formulaire">
            <p>Vous avez oublié votre mot de passe ? pas de problème, on va vous envoyer un email de récupération ! </p>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div id="element">
                    <label for="email" :value="__('Email')" >Email
                        <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </label>
                </div>

                <div class="bouton">
                    <button class="btn">{{ __('Envoyer email de récupération') }}</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

        

