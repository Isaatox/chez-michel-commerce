@extends('layouts.mainCompte')

@section('content')
<div class="breadcrumbs">
    {{ Breadcrumbs::render('cartes') }}
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">{{ __('Ajouter carte bancaire') }}</div>
                    <form action="{{route('ajouter.carte')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom_carte">Nom sur la carte</label>
                            <input type="text" class="form-control" id="nom_carte" name="nom_carte">
                        </div>
                        <div class="form-group">
                            <label for="numero_carte">Numéro de carte</label>
                            <input type="text" class="form-control" id="numero_carte" name="numero_carte">
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="date_expiration">Date d'expiration (MM/AA)</label>
                                <input type="text" class="form-control" id="date_expiration" name="date_expiration">
                            </div>
                            <div class="col">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control" id="cvc" name="cvc">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info mt-2 mb-2">Ajouter la carte</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
