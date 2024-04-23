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
            <div class="d-flex justify-content-between">
              <h3 class="card-title">DEMANDE PAR PERIODE</h3>
              <a href="javascript:void(0);">Details</a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">820</span>
                <span>Visitors Over Time</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 12.5%
                </span>
                <span class="text-muted">Depuis le mois dernier</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="visitors-chart" height="200"></canvas>
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
        <!-- /.card -->

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">TOP DEMANDES</h3>
            <div class="card-tools">
              <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
              </a>
              <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
              </a>
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
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                  Ministere de la santé
                </td>
                <td>6</td>
                <td class="text-success">3</td>
                <td class="text-success"> 50% </td>
              </tr>
              <tr>
                <td>
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                  Ministère de l'administration térritorial
                </td>
                <td>2</td>
                <td class="text-success">2</td>
                <td class="text-success">100% </td>
              </tr>
              <tr>
                <td>
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                  Ministère des affaires etrangères et des burkinabè de l'extérieur
                </td>
                <td>10</td>
                <td class="text-success">10</td>
                <td class="text-success">100%</td>
              </tr>
              <tr>
                <td>
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
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
        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">STATISTIQUES</h3>
              <a href="javascript:void(0);">Details</a>
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
        <!-- /.card -->

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">INDICATEURS DE PERFORMANCE</h3>
            <div class="card-tools">
              <a href="#" class="btn btn-sm btn-tool">
                <i class="fas fa-download"></i>
              </a>
              <a href="#" class="btn btn-sm btn-tool">
                <i class="fas fa-bars"></i>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
              <p class="text-success text-xl">
                <i class="ion ion-ios-refresh-empty"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  <i class="ion ion-android-arrow-up text-success"></i> 12%
                </span>
                <span class="text-muted">CONVERSION RATE</span>
              </p>
            </div>
            <!-- /.d-flex -->
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
              <p class="text-warning text-xl">
                <i class="ion ion-ios-cart-outline"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                </span>
                <span class="text-muted">SALES RATE</span>
              </p>
            </div>
            <!-- /.d-flex -->
            <div class="d-flex justify-content-between align-items-center mb-0">
              <p class="text-danger text-xl">
                <i class="ion ion-ios-people-outline"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  <i class="ion ion-android-arrow-down text-danger"></i> 1%
                </span>
                <span class="text-muted">REGISTRATION RATE</span>
              </p>
            </div>
            <!-- /.d-flex -->
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
@endsection
