@extends('layout')

@section('titre', 'Details de la réservation')
@section('content')
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
                        <button type="submit" class="btn btn-primary btn-block">Demande de correction</button>
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
                                <form action="{{ route("reservation.update",$reservation->id) }}" method="post">
                                    @csrf
                                    @method("put")
                                    <div class="form-group row mb-0">
                                        <label for="agent_cellule" class="col-sm-4 col-form-label">Agent Traitant:</label>
                                        <div class="col-sm-8">
                                                <select class="form-control select2" style="width: 100%;" id="agent_cellule"  name="agent_cellule" required>
                                                <option value=""> -- Choisir -- </option>
                                                @foreach ($agents_cellule as $agent)
                                                    <option @if (old('agent_cellule') == $agent->id) selected @endif value="{{ $agent->id }}"> {{ $agent->nom.' '.$agent->prenom }} </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="status" value="affecté">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <img src="{{ asset("dist/img/spinner/blinking.gif") }}" alt="blinking Gif" height="30px"> Affecter un agent
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if (getLoggedUser()->role == 'agent_ministere')
            <div class="col-md-10 offset-md-1">
                <div class="tab-pane" id="timeline">
                    <div class="timeline timeline-inverse">
                        {{-- ELEMENT TIMELINE --}}
                        <div class="time-label">
                            <span class="bg-danger">
                                17 Avril 2024 14:39
                            </span>
                        </div>
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                            <div class="timeline-item">
                                <span class="time"><em>par Coulibaly Anatole</em></span>
                                <h3 class="timeline-header"><a href="#" class="text-success">Demande traité</a>:
                                    Report de la date de retour appliqué</h3>
                                <div class="timeline-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="https://www.coursehero.com/file/43160696/Billet-dAvion-1pdf/"
                                                target="blank" class="btn btn-warning btn-block">Télecharger le billet</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- FIN ELEMENT TIMELINE --}}

                        {{-- ELEMENT TIMELINE --}}
                        <div class="time-label">
                            <span class="bg-danger">
                                21 Avril 2024 10:02
                            </span>
                        </div>
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                            <div class="timeline-item">
                                <span class="time"><em>par Kaboré Inoussa</em></span>
                                <h3 class="timeline-header"><a href="#" class="text-success">Fin de mission</a>
                                    Cout total du billet: 556 000 FCFA TTC</h3>
                                <div class="timeline-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="https://www.kafeo.com/factures/Modele-facture-Kafeo.doc"
                                                target="blank" class="btn btn-warning btn-block">Télecharger la
                                                facture</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- FIN ELEMENT TIMELINE --}}
                        <div>
                            <i class="fa fa-check-circle bg-success" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
        @endif

        @foreach ($reservation->tickets as $ticket)
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
                                            Départ: <i
                                                class="fas fa-plane-departure mr-2"></i>{{ $ticket->demande_ville_depart }}
                                            le  {{ date('d/m/Y', strtotime($ticket->demande_date_depart)) }}
                                        </div>
                                        <div class="col-md-6 bg-success p-3">
                                            Destination: <i class="fas fa-plane-arrival mr-2"></i>{{ $ticket->demande_ville_destination }}
                                            le {{ date('d/m/Y', strtotime($ticket->demande_date_retour)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- FIN TICKET DEMANDE --}}

                        {{-- TICKET REPONSE AGENT && CHEF FORM --}}
                        @if (($ticket->status === 'affecté') 
                                && ((getLoggedUser()->role == 'agent_cellule') || (getLoggedUser()->role == 'chef_cellule')))
                            
                        <div class="time-label">
                            <span class="bg-danger">Aujourd'hui</span>
                        </div>
                            <div>
                            <i class="far fa-clock bg-gray"></i>
                                <div class="timeline-item">
                                    {{-- <span class="time"><em>par Kaboré Inoussa</em></span> --}}
                                    <h3 class="timeline-header">Reponse à la requête: {{ $ticket->demande_message }}</h3>
                                    <div class="timeline-body">


                                        <form method="POST" action="{{ route('ticket.update', $ticket->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6 offset-md-3">
                                                    <h5 class="text-center text-danger">ATTENTION</h3>
                                                    <p class="text-danger text-center"> Veuillez a modifier les dates et/ou les villes de départ et de destination si celles-ci ne correspondent pas au billet disponible</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="reponse_date_depart"
                                                            class="col-sm-4 col-form-label">Date de départ</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" id="reponse_date_depart" name="reponse_date_depart" value="{{ $ticket->demande_date_depart }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="reponse_date_retour" class="col-sm-4 col-form-label">Date de retour</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" id="reponse_date_retour" name="reponse_date_retour" value="{{ $ticket->demande_date_retour }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="reponse_ville_depart"
                                                            class="col-sm-4 col-form-label">Depart</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control select2" style="width: 100%;" id="reponse_ville_depart" name="reponse_ville_depart"
                                                                required>
                                                                <option value=""> -- Choisir -- </option>
                                                                @foreach (getCapitalNames() as $ville)
                                                                    <option @if ($ticket->demande_ville_depart == $ville) selected @endif> {{ $ville }} </option>
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
                                                            <select class="form-control select2" style="width: 100%"
                                                                id="reponse_ville_destination"
                                                                name="reponse_ville_destination" required>
                                                                <option value=""> -- Choisir -- </option>
                                                                @foreach (getCapitalNames() as $ville)
                                                                    <option @if ($ticket->demande_ville_destination == $ville) selected @endif> {{ $ville }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="file_reponse">Joindre un fichier (image/pdf)</label>
                                                        <input type="file" class="form-control" id="file_reponse"
                                                            name="file_reponse">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label for="commentaire">Commentaire(Facultatif):</label>
                                                      <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Saisissez votre commentaire si vous en avez un" id="commentaire" name="commentaire"></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block">Enregistrer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- FIN TICKET REPONSE AGENT FORM --}}

                        {{-- TICKET REPONSE CHEF FORM --}}
                        @if ($ticket->status === 'traité')
                            <div class="time-label">
                                <span class="bg-danger">
                                    {{ date('d/m/Y à H:i', strtotime($ticket->updated_at)) }}
                                </span>
                            </div>
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                                <div class="timeline-item">
                                    <span class="time"><em>traité par: <b>{{ $ticket->agent_cellule }}</b></em></span>
                                    <h3 class="timeline-header">{{ $ticket->reponse_titre }}:
                                        {{ $ticket->reponse_message }}</h3>
                                    <div class="timeline-body">
                                        <div class="row">
                                            <div class="col-md-6 offset-md-3">
                                                <a href="" target="blank"
                                                    class="btn btn-success btn-block">Approuver et transmettre au demandeur
                                                </a>
                                            </div>
                                            {{-- <div class="col-md-6">
                                          <a href="#"
                                              target="blank" class="btn btn-warning btn-block">Autre option(à preciser)
                                            </a>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- FIN TICKET REPONSE CHEF FORM --}}
                        <div>
                            <i class="fa fa-check-circle bg-success" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
        @endforeach

    </div>
@endsection

@section('custom_js')
    <script>
        $(function() {
            $('.select2').select2()
        });
    </script>
@endsection
