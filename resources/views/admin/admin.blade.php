@extends('layouts.mainCompteAdmin')
@section('content')
    <style>
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            border: 1px solid rgba(0, 0, 0, .05);
            border-radius: .375rem;
            background-color: #fff;
            background-clip: border-box;
        }

        .card-body {
            padding: 1.5rem;
            flex: 1 1 auto;
        }

        .card-title {
            margin-bottom: 1.25rem;
        }
        .card-stats .card-body {
            padding: 1rem 1.5rem;
        }

        .icon {
            width: 3rem;
            height: 3rem;
        }

        .icon i {
            font-size: 2.25rem;
        }

        .icon-shape {
            display: inline-flex;
            padding: 12px;
            text-align: center;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="columns-md w-100" style="padding: 15px">



    <div class="container-fluid">
        <div class="breadcrumbs">
            {{ Breadcrumbs::render('admin') }}
        </div>
        <hr>
        <div class="header-body">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Nouveau utilisateurs</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $newUsersThisWeek }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                @if ($diffPercent > 0)
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($diffPercent, 2) }}%</span>
                                @elseif ($diffPercent < 0)
                                    <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ number_format(abs($diffPercent), 2) }}%</span>
                                @else
                                    <span class="text-warning mr-2"><i class="fa fa-arrow-right"></i> {{ number_format($diffPercent, 2) }}%</span>
                                @endif
                                <span class="text-nowrap">Depuis la semaine dernière</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Commandes actives</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $activeOrdersThisWeek }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                @if ($diffPercentOrders > 0)
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($diffPercentOrders, 2) }}%</span>
                                @elseif ($diffPercentOrders < 0)
                                    <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ number_format(abs($diffPercentOrders), 2) }}%</span>
                                @else
                                    <span class="text-warning mr-2"><i class="fa fa-arrow-right"></i> {{ number_format($diffPercentOrders, 2) }}%</span>
                                @endif
                                <span class="text-nowrap">Depuis la semaine dernière</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Commandes effectuées</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$executeOrdersThisWeek}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                @if ($diffPercentOrdersExecute > 0)
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($diffPercentOrdersExecute, 2) }}%</span>
                                @elseif ($diffPercentOrdersExecute < 0)
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> {{ number_format($diffPercentOrdersExecute, 2) }}%</span>
                                @else
                                    <span class="text-warning mr-2"><i class="fa fa-arrow-right"></i> {{ number_format($diffPercentOrdersExecute, 2) }}%</span>
                                @endif
                                <span class="text-nowrap">Depuis la semaine dernière</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Meubles</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$meubles}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
