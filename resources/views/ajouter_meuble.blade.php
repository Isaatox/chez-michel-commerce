<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter meuble</title>
    <link rel="stylesheet" href="css/ajouter_meuble.css">
</head>
<body>
    <form action="{{route('enregistrer_meuble')}}" method="post" class="form_ajouter_meubles">
        @csrf
        <div class="premiere_partie" id='premiere_partie'>
            <label for="nom">Le nom du produit : </label>
            <input type="text" id="nom" name="nom" minlength="4" maxlength="30">
            <label for="categorie">La catégorie du produit : </label>
            <input id="categorie" type="text" name="categorie" list="typelist">
            <label for="couleur">La couleur du produit : </label>
            <input id="couleur" type="text" name="couleur" list="couleurlist">
            <label for="prix">Le prix du produit : </label>
            <input type="number" id="prix" name="prix" min="1" max="10000">
            <label for="stock">Le nombre de produit en stock : </label>
            <input type="number" id="stock" name="stock" min="1" max="10000">
            <label for="description">La description du produit : </label>
            <textarea id="description" name="description" rows="5" cols="33"> La description du produit... </textarea>
            <div class="centrer_bouton">
                <div class="suivant" onclick="suivant()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></div>
            </div>
        </div>
        <div class="seconde_partie" id='seconde_partie'>
            <input type="file" id="image1" name="image1" accept="image/png, image/jpeg, image/jpg">
            <input type="file" id="image2" name="image2" accept="image/png, image/jpeg, image/jpg">
            <input type="file" id="image3" name="image3" accept="image/png, image/jpeg, image/jpg">
            <button type="submit" value="Ajouter">Ajouter</button>
        </div>
    </form>

    <datalist id="typelist">
        <option value="Table">
        <option value="Chaise">
        <option value="Canapé">
        <option value="Fauteil">
        <option value="Table basse">
        <option value="Étagère">
    </datalist>

    <datalist id="couleurlist">
        <option value="rouge">
        <option value="vert">
        <option value="bleu">
        <option value="violet">
        <option value="jaune">
        <option value="orange">
        <option value="marron">
    </datalist>
</body>
</html>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>