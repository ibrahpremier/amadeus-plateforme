@extends('layout')

@section('titre')
    @if ((getLoggedUser()->role == 'chef_cellule' || getLoggedUser()->role == 'coordinateur') && isset($ministere))
        {{ $ministere->nom }} | Solde: {{ $ministere->currentBudget()->solde }}
    @endif
@endsection

@section('content')
    {{-- @dump($errors->all()) --}}
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Details de la reservation</h3>
                </div>
                <div class="card-body">
                    {{-- Informations voyageur --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nom du voyageur</label>
                                <input type="text" class="form-control"
                                    value="{{ $reservation->nom . ' ' . $reservation->prenom }}" readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Informations passport/classe/visa --}}<div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="passport_num" class="col-sm-4 col-form-label">Numéro passport</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="passport_num"
                                        value="{{ $reservation->numero_passport }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="pays" class="col-sm-4 col-form-label">Classe</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $reservation->classe }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="visa" class="col-sm-4 col-form-label">Visa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"
                                        value="{{ $reservation->visa ? 'Oui' : 'Non' }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Dates voyage --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="type_voyage" class="col-sm-4 col-form-label">Type de voyage</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="type_voyage"
                                        value="{{ $reservation->type_voyage }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="depart" class="col-sm-4 col-form-label">Date de départ</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="depart"
                                        value="{{ $reservation->date_depart }}" readonly>
                                </div>
                            </div>
                        </div>
                        @if ($reservation->date_retour)
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="retour" class="col-sm-4 col-form-label">Date de retour</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="retour"
                                            value="{{ $reservation->date_retour }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Villes départ/destination --}}
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
                                    <input type="text" class="form-control"
                                        value="{{ $reservation->ville_destination }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informations voyage (motif et type) --}}
                    <div class="row">
                        <div class="col-md-12">
                            @if(getLoggedUser()->role == 'coordinateur')
                                <div class="form-group row">
                                    <label for="motif" class="col-sm-2 col-form-label">Motif du voyage</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="motif" rows="3" readonly>{{ $reservation->motif }}</textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @include('pages.reservation.partials.actions-footer', [
                        'reservation' => $reservation,
                        'agents_cellule' => $agents_cellule ?? null,
                    ])
                </div>
            </div>
        </div>

        <div class="col-md-10 offset-md-1">
            <div class="tab-pane" id="timeline">
                <div class="timeline timeline-inverse">
                    {{-- Ticket initial --}}
                    @include('pages.reservation.partials.ticket-initial', ['reservation' => $reservation])

                    {{-- Liste des tickets --}}
                    @foreach ($reservation->tickets as $ticket)
                        @include('pages.reservation.partials.ticket-item', [
                            'ticket' => $ticket,
                            'agences' => $agences ?? [],
                            'compagnies' => $compagnies ?? [],
                        ])
                    @endforeach
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
