@extends('layout')

@section('titre')
    <i class="fas fa-building"></i> Détails de l'Agence: {{ $agence->nom }}
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de l'Agence</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="text-muted">Nom</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        <input type="text" class="form-control" value="{{ $agence->nom }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted">Téléphone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control" value="{{ $agence->telephone }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="text" class="form-control" value="{{ $agence->email }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted">Description</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $agence->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Marges</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="text-muted">Marge sur Économique</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" value="{{ $agence->marge_eco }}" readonly>
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted">Marge sur Business</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" value="{{ $agence->marge_business }}" readonly>
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted">Marge sur First</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" value="{{ $agence->marge_first }}" readonly>
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted">Marge sur Jet</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" value="{{ $agence->marge_jet }}" readonly>
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('agence.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste des agences
                    </a>
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
