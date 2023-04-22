<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//Breadcrumbs::for('home', function ($trail) {
//    $trail->push('Accueil', route('home'));
//});

//Breadcrumbs::for('products', function ($trail) {
//    $trail->parent('home');
//    $trail->push('Produits', route('products.index'));
//});

//Breadcrumbs::for('product', function ($trail, $product) {
//    $trail->parent('products');
//    $trail->push($product->name, route('products.show', $product));
//});

Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Admin', route('index'));
});

Breadcrumbs::for('ajouter_meubles', function ($trail) {
    $trail->parent('admin');
    $trail->push('Ajouter un meuble', route('ajouter_meubles'));
});

Breadcrumbs::for('categorie', function ($trail) {
    $trail->parent('admin');
    $trail->push('Categorie', route('categorie'));
});

Breadcrumbs::for('couleur', function ($trail) {
    $trail->parent('admin');
    $trail->push('Couleur', route('couleur'));
});

