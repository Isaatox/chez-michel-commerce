<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter meuble</title>
</head>
<body>
    <form action="{{route('enregistrer_meuble')}}" method="post">
        @csrf
        <input type="text" id="nom" name="nom" required minlength="4" maxlength="30">
        <input id="categorie" type="text" name="categorie" list="typelist">
        <input id="couleur" type="text" name="couleur" list="couleurlist">
        <input type="number" id="prix" name="prix" min="1" max="10000">
        <input type="number" id="stock" name="stock" min="1" max="10000">
        <textarea id="description" name="description" rows="5" cols="33"> La description du produit... </textarea>
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