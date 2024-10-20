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

    <div class="card py-3 mb-4">
        <div class="card-header">
            <h5 class="card-title">Liste des tickets</h5>
        </div>
        <div class="card-body">
            @forelse ($agence->tickets as $ticket)
                <div class="col-md-10 offset-md-1">
                    <div class="tab-pane" id="timeline">
                        <div class="timeline timeline-inverse">

                            {{-- TICKET DEMANDE --}}
                            <div class="time-label">
                                <span class="bg-danger">
                                    {{ date('d/m/Y à H:i', strtotime($ticket->created_at)) }}
                                </span>
                            </div>
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                                <div class="timeline-item">
                                    {{-- <span class="time"><em>par {{ $ticket->agent_ministere->nom }}</em></span> --}}
                                    <h3 class="timeline-header"><u>{{ $ticket->demande_titre }}</u>:
                                        {{ $ticket->demande_message }}</h3>
                                    <div class="timeline-body ">
                                        <div class="row">
                                            <div class="col-md-6 bg-warning p-3">
                                                <u>Départ: </u> le
                                                {{ date('d/m/Y', strtotime($ticket->demande_date_depart)) }}<br>
                                                <i
                                                    class="fas fa-plane-departure mr-2"></i>{{ $ticket->demande_ville_depart }}
                                                <br>
                                                <i
                                                    class="fas fa-plane-arrival mr-2"></i>{{ $ticket->demande_ville_destination }}
                                                <br>

                                            </div>
                                            <div class="col-md-6 bg-success p-3">
                                                <u>Retour:</u> le
                                                {{ date('d/m/Y', strtotime($ticket->demande_date_retour)) }}<br>
                                                <i
                                                    class="fas fa-plane-departure mr-2"></i>{{ $ticket->demande_ville_destination }}
                                                <br>
                                                <i
                                                    class="fas fa-plane-arrival mr-2"></i>{{ $ticket->demande_ville_depart }}
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TICKET REPONSE --}}
                            @if ($ticket->status === 'approuvé')
                                {{-- <div class="time-label">
                                <span class="bg-danger">
                                    {{ date('d/m/Y à H:i', strtotime($ticket->updated_at)) }}
                                </span>
                            </div> --}}
                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                    <div class="timeline-item">
                                        <span class="time"><em>par
                                                {{ $ticket->agent_cellule->nom . ' ' . $ticket->agent_cellule->prenom }}</em></span>
                                        <h3 class="timeline-header">
                                            <u>{{ $ticket->reponse_titre }}</u>:{{ $ticket->reponse_message }}
                                        </h3>
                                        <div class="timeline-body">
                                            <div class="row">
                                                @if ($ticket->reponse_commentaire)
                                                    <div class="col-md-12 text-justify">
                                                        <p> {{ $ticket->reponse_commentaire }}</p>
                                                    </div>
                                                @endif
                                                @if ($ticket->reponse_file)
                                                    <div class="col-md-6 offset-md-3">
                                                        <a href="{{ route('download.reponse_file', $ticket) }}"
                                                            target="blank" class="btn btn-warning btn-block">
                                                            Télecharger le fichier
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- FIN TICKET REPONSE --}}
                            <div>
                                <i class="fa fa-check-circle bg-success" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="lead text-center">
                    Aucun tikets pour l'instant
                </p>
            @endforelse
        </div>
    </div>
@endsection
