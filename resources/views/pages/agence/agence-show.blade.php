@extends('layout')

@section('titre')
    Détails de l'Agence
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-primary text-white me-2">
                <i class="fas fa-building"></i>
            </span> Détails de l'Agence: {{ $agence->nom }}
        </h3>
    </div>

    <div class="card py-3">
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h5>Informations de l'Agence</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item"><strong>Nom:</strong> {{ $agence->nom }}</li>
                            <li class="list-group-item"><strong>Téléphone:</strong> {{ $agence->telephone }}</li>
                            <li class="list-group-item"><strong>Email:</strong> <a
                                    href="mailto:{{ $agence->email }}">{{ $agence->email }}</a></li>
                            <li class="list-group-item"><strong>Description:</strong> {{ $agence->description }}</li>
                        </ul>

                        <h5>Marges</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Marge Éco:</strong> {{ $agence->marge_eco }} %</li>
                            <li class="list-group-item"><strong>Marge Business:</strong> {{ $agence->marge_business }} %
                            </li>
                            <li class="list-group-item"><strong>Marge First:</strong> {{ $agence->marge_first }} %</li>
                            <li class="list-group-item"><strong>Marge Jet:</strong> {{ $agence->marge_jet }} %</li>
                        </ul>

                        <a href="{{ route('agence.index') }}" class="btn btn-secondary mt-4">Retour à la liste des
                            agences</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="reservations" class="mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Réservations</h3>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="simple-results.html">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg"
                                    placeholder="Faire une recherche">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i> Recherche
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dossier N°</th>
                            @if (getLoggedUser()->role == 'chef_cellule')
                                <th>Demandeur</th>
                            @endif
                            <th>Trajet</th>
                            <th>Date départ</th>
                            <th>Date retour</th>
                            <th>Nom</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <a
                                        href="{{ route('reservation.show', $reservation->id) }}">{{ $reservation->numero_dossier }}</a>
                                    <br>
                                    <a href="{{ route('reservation.show', $reservation->id) }}"
                                        class="btn btn-primary btn-sm">voir details</a>
                                </td>
                                @if (getLoggedUser()->role == 'chef_cellule')
                                    <td>{{ $reservation->agent_ministere->nom }}
                                        {{ $reservation->agent_ministere->prenom }}</td>
                                @endif
                                <td>
                                    <i class="fas fa-plane-departure mr-2"></i>{{ $reservation->ville_depart }}
                                    <i class="fas fa-plane-arrival mr-2"></i>{{ $reservation->ville_destination }}
                                    <span
                                        class="badge badge-info">{{ strtoupper($reservation->classe) == 'ECONOMIQUE' ? 'Eco' : strtoupper($reservation->classe) }}</span>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($reservation->date_depart)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($reservation->date_retour)) }}</td>
                                <td>{{ $reservation->nom }} {{ $reservation->prenom }}</td>
                                <td><span
                                        class="badge {{ statusBg($reservation->status) }} p-2">{{ $reservation->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->isCellChief() ? 8 : 7 }}">
                                    <p class="w-100 lead text-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        Aucune réservation trouvée
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
    </section>
@endsection
