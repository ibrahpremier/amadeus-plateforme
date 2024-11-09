@extends('layout')

@section('titre', 'Tableau de bord')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>

                    <p>Demande en cours</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Taux de traitement</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>

                    <p>Demandes en attentes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Demandes nos traités</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">TOP DEMANDES</h3>
            <div class="card-tools">
              {{-- <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
              </a> --}}
              {{-- <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
              </a> --}}
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Ministères</th>
                <th>Demandes reçu</th>
                <th>Demandes traités</th>
                <th>Taux traitement</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>
                  Ministere de la santé
                </td>
                <td>6</td>
                <td class="text-success">3</td>
                <td class="text-success"> 50% </td>
              </tr>
              <tr>
                <td>
                  Ministère de l'administration térritorial
                </td>
                <td>2</td>
                <td class="text-success">2</td>
                <td class="text-success">100% </td>
              </tr>
              <tr>
                <td>
                  Ministère des affaires etrangères et des burkinabè de l'extérieur
                </td>
                <td>10</td>
                <td class="text-success">10</td>
                <td class="text-success">100%</td>
              </tr>
              <tr>
                <td>
                  Ministère de l'économie
                </td>
                <td>1</td>
                <td class="text-success">1</td>
                <td class="text-success">100%</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">STATISTIQUES</h3>
              {{-- <a href="javascript:void(0);">Details</a> --}}
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">18 230 FCFA</span>
                <span>Sales Over Time</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 33.1%
                </span>
                <span class="text-muted">Depuis le mois dernier</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="sales-chart" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> Ce mois
              </span>

              <span>
                <i class="fas fa-square text-gray"></i> Mois dernier
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('custom_js')
<!-- Chart -->
<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
@endsection
