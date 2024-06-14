@extends('layout')

@section('titre')
    Liste des demandes {{isset($_GET['encours'])?'en cours':'   '}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              {{-- <h3 class="card-title">Bordered Table</h3> --}}

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="simple-results.html">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" placeholder="Faire une recherche">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                    Recherche
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Dossier N°</th>
                    @if(getLoggedUser()->role=='chef_cellule')<th>Demandeur</th>@endif
                    <th>Trajet</th>
                    <th>Date depart</th>
                    <th>Date retour</th>
                    <th>Nom</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>
                      <a href="{{route('reservation.show',$reservation->id)}}">{{$reservation->numero_dossier}}</a>  <br>
                      <a href="{{route('reservation.show',$reservation->id)}}" class="btn btn-primary btn-sm">voir details</a> 
                    </td>
                    @if(getLoggedUser()->role=='chef_cellule')
                    <td>
                      {{ $reservation->agent_ministere->nom }} {{ $reservation->agent_ministere->prenom }} <br> 
                      <small>{{ $reservation->agent_ministere?->ministere->nom }}
                    </td>
                    @endif
                    <td>
                      <i class="fas fa-plane-departure mr-2"></i>{{$reservation->ville_depart}} <br>
                      <i class="fas fa-plane-arrival mr-2"></i>{{$reservation->ville_destination}} 
                      <span class="badge badge-info">
                        @if ($reservation->classe=="economique") Eco @else {{ strtoupper($reservation->classe) }} @endif
                      </span>
                    </td>
                    <td>{{date('d/m/Y',strtotime($reservation->date_depart))}}</td>
                    <td>{{date('d/m/Y',strtotime($reservation->date_retour))}}</td>
                    <td>{{$reservation->nom}} {{$reservation->prenom}}</td>
                    <td><span class="badge {{statusBg($reservation->status)}} p-2">{{$reservation->status}}</span></td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.card -->
    </div>
</div>
@endsection
