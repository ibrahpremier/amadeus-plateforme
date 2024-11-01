@extends('layout')

@section('titre', 'Details de la réservation')
@section('content')
    {{-- @dump($errors->all()) --}}
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Details de la reservation</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nom du voyageur</label>
                                <input type="text" class="form-control"
                                    value="{{ $reservation->nom . ' ' . $reservation->prenom }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="passport_num" class="col-sm-4 col-form-label">Numéro passport</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="passport_num"
                                        value="{{ $reservation->numero_passport }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="pays" class="col-sm-4 col-form-label">Classe</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $reservation->classe }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="depart" class="col-sm-4 col-form-label">Date de départ</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="depart"
                                        value="{{ $reservation->date_depart }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="retour" class="col-sm-4 col-form-label">Date de retour</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="retour"
                                        value="{{ $reservation->date_retour }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="pays" class="col-sm-4 col-form-label">Depart</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $reservation->ville_depart }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="pays" class="col-sm-4 col-form-label">Destination</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $reservation->ville_destination }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    @if (getLoggedUser()->role == 'agent_ministere')
                        <div class="row">
                            {{-- <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary btn-block">Demande de modificaction</button>
                    </div> --}}
                        </div>
                    @elseif(getLoggedUser()->role == 'chef_cellule')
                        <div class="row">
                            <div class="col-md-6">
                                <u>Chargé de mission</u>:
                                <b>{{ $reservation->agent_ministere?->nom . ' ' . $reservation->agent_ministere?->prenom }}</b>
                            </div>
                            <div class="col-md-6 text-right">
                                @if ($reservation->agent_cellule)
                                    <u>Traité par</u>:
                                    <b>{{ $reservation->agent_cellule->nom . ' ' . $reservation->agent_cellule->prenom }}</b>
                                @else
                                    <form action="{{ route('reservation.update', $reservation->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row mb-0">
                                            <label for="agent_cellule" class="col-sm-4 col-form-label">Agent
                                                Traitant:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" style="width: 100%;" id="agent_cellule"
                                                    name="agent_cellule" required>
                                                    <option value=""> -- Choisir -- </option>
                                                    @foreach ($agents_cellule as $agent)
                                                        <option @if (old('agent_cellule') == $agent->id) selected @endif
                                                            value="{{ $agent->id }}">
                                                            {{ $agent->nom . ' ' . $agent->prenom }} </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="status" value="affecté">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <img src="{{ asset('dist/img/spinner/blinking.gif') }}" alt="blinking Gif"
                                                height="30px"> Affecter un agent
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        {{-- @foreach ($reservation->tickets as $ticket) --}}
        <div class="col-md-10 offset-md-1">
            <div class="tab-pane" id="timeline">
                <div class="timeline timeline-inverse">

                    {{-- TICKET DEMANDE --}}
                    <div class="time-label">
                        <span class="bg-danger">
                            {{ date('d/m/Y à H:i', strtotime($reservation->created_at)) }}
                        </span>
                    </div>
                    <div>
                        <i class="far fa-clock bg-gray"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header">
                                <u>{{ $reservation->demande_titre }}</u>: {{ $reservation->demande_message }}
                            </h3>
                            <div class="timeline-body ">
                                <div class="row">
                                    <div class="col-md-6 bg-warning p-3">
                                        <u>Départ:</u> le {{ date('d/m/Y', strtotime($reservation->date_depart)) }}<br>
                                        <i class="fas fa-plane-departure mr-2"></i>{{ $reservation->ville_depart }}<br>
                                        <i class="fas fa-plane-arrival mr-2"></i>{{ $reservation->ville_destination }}<br>
                                    </div>
                                    <div class="col-md-6 bg-success p-3">
                                        <u>Retour:</u> le {{ date('d/m/Y', strtotime($reservation->date_retour)) }}<br>
                                        <i
                                            class="fas fa-plane-departure mr-2"></i>{{ $reservation->ville_destination }}<br>
                                        <i class="fas fa-plane-arrival mr-2"></i>{{ $reservation->ville_depart }}<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- FIN TICKET DEMANDE --}}

                    @foreach ($reservation->tickets as $ticket )
                        @if ($loop->first && $ticket->status === 'traité')
                            @continue
                        @endif
                        <div class="time-label">
                            <span class="bg-danger">
                                {{ date('d/m/Y à H:i', strtotime($ticket->updated_at)) }}
                            </span>
                        </div>
                        {{-- @dd($ticket) --}}

                        <div>
                            <i class="far fa-clock bg-gray"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header">
                                    <strong>Réponse à la demande </strong>{{ $ticket->reponse_message }}
                                </h3>
                                {{-- @dump($ticket->status) --}}
                                @if ($ticket->status === 'nouveau' && getLoggedUser()->role != 'chef_cellule')
                                    <div class="timeline-body">
                                        En attente de traitement
                                    </div>
                                @else
                                    @if (Auth::user()->role === 'agent_ministere' && ($ticket->status === 'en cours' || $ticket->status === 'affecté'))
                                        <div class="timeline-body">
                                            en cours de traitement
                                        </div>
                                    @else
                                        <div class="timeline-body">
                                            <form method="POST"
                                                action="{{ route('ticket.store', ['oldTicket' => $ticket->id]) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('post')

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="reponse_date_depart"
                                                                class="col-sm-4 col-form-label">Date de
                                                                départ</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control"
                                                                    id="reponse_date_depart" name="reponse_date_depart"
                                                                    value="{{ old('reponse_date_depart', $ticket->reponse_date_depart) }}"
                                                                    @disabled(Auth::user()->role === 'agent_ministere' ||
                                                                            (in_array($ticket->status, ['approuvé', 'annulé', 'terminé', 'traité']) &&
                                                                                in_array(Auth::user()->role, ['chef_cellule', 'agent_cellule']))) required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="reponse_date_retour"
                                                                class="col-sm-4 col-form-label">Date de
                                                                retour</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control"
                                                                    id="reponse_date_retour" name="reponse_date_retour"
                                                                    value="{{ old('reponse_date_retour', $ticket->reponse_date_retour) }}"
                                                                    @disabled(Auth::user()->role === 'agent_ministere' ||
                                                                            (in_array($ticket->status, ['approuvé', 'annulé', 'terminé', 'traité']) &&
                                                                                in_array(Auth::user()->role, ['chef_cellule', 'agent_cellule']))) required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="reponse_ville_depart"
                                                                class="col-sm-4 col-form-label">Départ</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    id="reponse_ville_depart" name="reponse_ville_depart"
                                                                    required @disabled(Auth::user()->role === 'agent_ministere' ||
                                                                            (in_array($ticket->status, ['approuvé', 'annulé', 'terminé', 'traité']) &&
                                                                                in_array(Auth::user()->role, ['chef_cellule', 'agent_cellule'])))>
                                                                    <option value=""> -- Choisir --
                                                                    </option>
                                                                    @foreach (getCapitalNames() as $ville)
                                                                        <option value="{{ $ville }}"
                                                                            @if ($ticket->reponse_ville_depart == $ville) selected @endif>
                                                                            {{ $ville }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="reponse_ville_destination"
                                                                class="col-sm-4 col-form-label">Destination</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control select2"
                                                                    id="reponse_ville_destination"
                                                                    name="reponse_ville_destination" required
                                                                    @disabled(Auth::user()->role === 'agent_ministere' ||
                                                                            (in_array($ticket->status, ['approuvé', 'annulé', 'terminé', 'traité']) &&
                                                                                in_array(Auth::user()->role, ['chef_cellule', 'agent_cellule'])))>
                                                                    <option value=""> -- Choisir --
                                                                    </option>
                                                                    @foreach (getCapitalNames() as $ville)
                                                                        <option value="{{ $ville }}"
                                                                            @if ($ticket->reponse_ville_destination == $ville) selected @endif>
                                                                            {{ $ville }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        @if ($ticket->reponse_file)
                                                            <label for="reponse_file">Fichier
                                                                (image/pdf)</label>
                                                            <a href="{{ route('download.reponse_file', $ticket) }}"
                                                                target="_blank"
                                                                class="btn btn-outline-primary btn-sm">Télécharger
                                                                la
                                                                reservation
                                                            </a>
                                                        @else
                                                            <div class="form-group">
                                                                <label for="reponse_file">Joindre un
                                                                    fichier
                                                                    (image/pdf)</label>
                                                                <input type="file" class="form-control"
                                                                    id="reponse_file" name="reponse_file"
                                                                    @disabled(Auth::user()->role === 'agent_ministere' ||
                                                                            (in_array($ticket->status, ['approuvé', 'annulé', 'terminé', 'traité']) &&
                                                                                in_array(Auth::user()->role, ['chef_cellule', 'agent_cellule'])))>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="prix">Saisir le prix de la
                                                            réservation:</label>
                                                        <input type="number" name="prix" class="form-control"
                                                            placeholder="Entrer le montant"
                                                            value="{{ old('prix', $ticket->prix) }}" required
                                                            @disabled(Auth::user()->role === 'agent_ministere' ||
                                                                    (in_array($ticket->status, ['approuvé', 'annulé', 'terminé', 'traité']) &&
                                                                        in_array(Auth::user()->role, ['chef_cellule', 'agent_cellule'])))>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="commentaire">Commentaire:</label>
                                                            <textarea cols="30" rows="3" class="form-control"
                                                                placeholder="{{ $ticket->status === 'affecté' ? 'Saisissez votre commentaire si vous en avez un' : '' }}"
                                                                id="commentaire" name="commentaire" @disabled(Auth::user()->role === 'agent_ministere' ||
                                                                        (in_array($ticket->status, ['approuvé', 'annulé', 'terminé', 'traité']) &&
                                                                            in_array(Auth::user()->role, ['chef_cellule', 'agent_cellule'])))>{{ $ticket->response_commentaire }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="parent_ticket_id"
                                                    value="{{ $ticket->id }}">
                                                <input type="hidden" name="reservation_id"
                                                    value="{{ $ticket->reservation_id }}">
                                                <input type="hidden" name="charge_de_mission_id"
                                                    value="{{ $reservation->charge_de_mission_id }}">
                                                <input type="hidden" name="status"
                                                    value="{{ Auth::user()->role === 'agent_ministere' ? 'en cours' : 'traité' }}">

                                                @if ($ticket->status === 'affecté' && (Auth::user()->role === 'chef_cellule' || Auth::user()->role === 'agent_cellule'))
                                                    <div class="row">
                                                        <div class="col-md-6 offset-md-3">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-block">Enregistrer</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>
                                            @if ($ticket->status === 'traité' && getLoggedUser()->role == 'agent_ministere')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <form method="POST"
                                                                    action="{{ route('ticket.update', $ticket->id) }}">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="status"
                                                                        value="approuvé">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-block"
                                                                        onclick="return comfrim('Ete vous surs de vouloir approuve cette demande')">Approuver</button>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <form method="POST"
                                                                    action="{{ route('ticket.update', $ticket->id) }}">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="status" value="annulé">
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-block"
                                                                        onclick="return comfrim('Ete vous surs de vouloir annuler cette demande')">Annuler</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if ($ticket->status === 'approuvé' || $ticket->status === 'terminé')
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                                <div class="timeline-item">
                                    <span class="time">
                                        <em>par
                                            {{ $ticket->agent_cellule->nom . ' ' . $ticket->agent_cellule->prenom }}</em>
                                    </span>
                                    <h3 class="timeline-header">
                                        <u>Réponse à la demande
                                        </u>
                                    </h3>
                                    <div class="timeline-body">
                                        <div class="row">
                                            @if ($ticket->reponse_commentaire)
                                                <div class="col-md-12 text-justify">
                                                    <p>{{ $ticket->reponse_commentaire }}</p>
                                                </div>
                                            @endif

                                            {{-- Si un billet est présent, afficher le message à l'agent ministère --}}
                                            @if (!$ticket->reponse_billet && getLoggedUser()->role === 'agent_ministere')
                                                <div class="col-md-12 text-justify">
                                                    <p><strong>Ticket approuvé :</strong> Attente du billet par
                                                        l'agence.
                                                    </p>
                                                </div>
                                            @endif
                                            {{-- Si un billet est présent, afficher le message à l'agent cellule --}}
                                            {{-- @if ((!$ticket->reponse_billet && getLoggedUser()->role === 'chef_cellule') || getLoggedUser()->role === 'agent_cellule')
                                                <div class="col-md-12 text-justify">
                                                    <p><strong>Ticket approuvé :</strong>Attente de traitement par le
                                                        Ministère.</p>
                                                </div>
                                            @endif --}}
                                        </div>

                                        {{-- Afficher un récapitulatif si le billet est présent pour l'agent ministère avec les champs désactivés --}}
                                        @if ($ticket->reponse_billet)
                                            <div class="col-md-12 text-justify">
                                                <p><strong>Réservaion terminé :</strong> Vous pouvez telecharger Votre
                                                    Billet.</p>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <a href="#" class="btn btn-outline-primary btn-sm"
                                                            target="_blank">
                                                            Télécharger le billet
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <p><strong>Agence :</strong> {{ $ticket->agence->nom }}</p>
                                                </div>
                                                <div class="col">
                                                    <p><strong>Compagnie :</strong> {{ $ticket->compagnie->nom }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Fin de la timeline pour le chef_cellule ou agent_cellule si un billet est présent --}}
                                        @if (getLoggedUser()->role === 'chef_cellule' || getLoggedUser()->role === 'agent_cellule')
                                            @if ($ticket->reponse_billet)
                                                {{-- <div class="col-md-12 text-justify">

                                                    <p><strong>Réservaion terminé :</strong> Billet soumis.</p>
                                                </div> --}}
                                            @else
                                                {{-- Afficher le formulaire pour joindre un fichier même si le ticket est approuvé --}}
                                                <form method="POST" action="{{ route('ticket.update', $ticket->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="terminé">
                                                    <div class="form-group">
                                                        <label for="reponse_billet">Joindre le Billet
                                                            (image/pdf)</label>
                                                        <input type="file" class="form-control" id="reponse_billet"
                                                            name="reponse_billet" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="agence">Agence</label>
                                                        <select name="agence_id" id="agence" class="form-control"
                                                            required>
                                                            <option value="" @disabled(true)
                                                                @selected(true)>
                                                                Selectionner
                                                                une agence</option>
                                                            @foreach ($agences as $agence)
                                                                <option value="{{ $agence->id }}">
                                                                    {{ $agence->nom }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="compagnie">Compagnie</label>
                                                        <select name="compagnie_id" id="compagnie" class="form-control"
                                                            required>
                                                            <option value="" @disabled(true)
                                                                @selected(true)>
                                                                Selectionner
                                                                une compagnie</option>
                                                            @foreach ($compagnies as $compagnie)
                                                                <option value="{{ $compagnie->id }}">
                                                                    {{ $compagnie->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 offset-md-3">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-block">Soumettre le
                                                                fichier</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($ticket->status === 'annulé')
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                                <div class="timeline-item">
                                    <span class="time">
                                        <em>par
                                            {{ $ticket->agent_cellule->nom . ' ' . $ticket->agent_cellule->prenom }}</em>
                                    </span>
                                    <h3 class="timeline-header">
                                        <u>Réponse à la demande
                                        </u>
                                    </h3>
                                    <div class="timeline-body">
                                        <p class="lead w-100 text-center">Demande Annuler</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endforeach


                    <div>
                        <i class="fa fa-check-circle bg-success" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_js')
    <script>
        $(function() {
            $('.select2').select2()
        });
        document.getElementById('ticketForm').addEventListener('submit', function(event) {
            // Affiche le spinner
            document.getElementById('spinner').style.display = 'block';

            // Désactive le bouton pour éviter des clics multiples
            const button = document.querySelector('.btn-primary');
            button.disabled = true;
        });
    </script>
@endsection
