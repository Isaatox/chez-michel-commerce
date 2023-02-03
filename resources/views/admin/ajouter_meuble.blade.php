<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter meuble</title>
    <link rel="stylesheet" href="{{ url('css/ajouter_meuble.css') }}">
</head>
<body>
    <form action="{{route('enregistrer_meuble')}}" method="post" class="form_ajouter_meubles">
        @csrf
        <div class="elements">
            <label for="nom">Le nom du produit : </label>
            <input type="text" id="nom" name="nom" minlength="4" maxlength="30">
        </div>

        <div class="elements">
            <label for="categorie">La catégorie du produit : </label>
            <input id="categorie" type="text" name="categorie" list="typelist">
        </div>

        <div class="elements">
            <label for="couleur">La couleur du produit : </label>
            <input id="couleur" type="text" name="couleur" list="couleurlist">
        </div>

        <div class="elements">
            <label for="prix">Le prix du produit : </label>
            <input type="number" id="prix" name="prix" min="1" max="10000">
        </div>

        <div class="elements">
            <label for="stock">Le nombre de produit en stock : </label>
            <input type="number" id="stock" name="stock" min="1" max="10000">
        </div>

        <div class="elements">
            <label for="description">La description du produit : </label>
            <textarea id="description" name="description" rows="5" cols="33"> La description du produit... </textarea>
        </div>        
        
        <input type="file" id="image1" name="image1" accept="image/png, image/jpeg, image/jpg">
        <input type="file" id="image2" name="image2" accept="image/png, image/jpeg, image/jpg">
        <input type="file" id="image3" name="image3" accept="image/png, image/jpeg, image/jpg">
        <button type="submit" value="Ajouter">Ajouter</button>
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