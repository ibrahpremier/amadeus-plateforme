@extends('layout')

@section('titre')
    detail de {{ $compagnie->nom }}
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card py-3 mb-4">
            <div class="card-header">
                <h5 class="card-title">Liste des tickets</h5>
            </div>
            <div class="card-body">
                @forelse ($compagnie->tickets as $ticket)
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

    </div>
@endsection

@section('custom_js')
    <script></script>
@endsection
