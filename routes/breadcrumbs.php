<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


//Route pour compte en admin
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Admin', route('index'));
});

Breadcrumbs::for('ajouter_meubles', function ($trail) {
    $trail->parent('admin');
    $trail->push('Ajouter un meuble', route('ajouter_meubles'));
});

Breadcrumbs::for('unMeuble', function ($trail) {
    $trail->parent('ajouter_meubles');
    $trail->push('Un meuble', route('ajouter_meubles'));
});

Breadcrumbs::for('categorie', function ($trail) {
    $trail->parent('admin');
    $trail->push('Categorie', route('categorie'));
});

Breadcrumbs::for('couleur', function ($trail) {
    $trail->parent('admin');
    $trail->push('Couleur', route('couleur'));
});

Breadcrumbs::for('uneCouleur', function ($trail) {
    $trail->parent('couleur');
    $trail->push('La couleur', route('couleur'));
});

Breadcrumbs::for('uneCategorie', function ($trail) {
    $trail->parent('categorie');
    $trail->push('La categorie', route('categorie'));
});

//Route pour compte

Breadcrumbs::for('commandes', function ($trail) {
    //CHanger la route en compte après
    $trail->parent('admin');
    $trail->push('MesCommandes', route('mesCommandes'));
});

Breadcrumbs::for('utilisateur', function ($trail) {
    $trail->parent('admin');
    $trail->push('Utilisteurs', route('utilisateur'));
});

Breadcrumbs::for('unUtilisateur', function ($trail) {
    $trail->parent('utilisateur');
    $trail->push('Un utilisateur', route('utilisateur'));
});