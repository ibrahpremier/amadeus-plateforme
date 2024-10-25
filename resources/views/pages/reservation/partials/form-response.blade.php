<form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
    @csrf
    @method('post')

    <div class="row">
        {{-- Date de départ --}}
        <div class="col-md-6">
            @include('pages.reservation.partials.form-input', [
                'label' => 'Date de départ',
                'name' => 'reponse_date_depart',
                'type' => 'date',
                'value' => $ticket->reponse_date_depart,
                'isDisabled' => $disableFields || !$isEditableStatus,
            ])
        </div>
        {{-- Date de retour --}}
        <div class="col-md-6">
            @include('pages.reservation.partials.form-input', [
                'label' => 'Date de retour',
                'name' => 'reponse_date_retour',
                'type' => 'date',
                'value' => $ticket->reponse_date_retour,
                'isDisabled' => $disableFields || !$isEditableStatus,
            ])
        </div>
    </div>

    {{-- Autres champs... --}}

    <input type="hidden" name="parent_ticket_id" value="{{ $ticket->id }}">
    <input type="hidden" name="reservation_id" value="{{ $ticket->reservation_id }}">
    <input type="hidden" name="charge_de_mission_id" value="{{ $reservation->charge_de_mission_id }}">
    <input type="hidden" name="status" value="traité">

    @if ($userRole !== 'agent_ministere')
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-primary btn-block" @disabled($disableFields || !$isEditableStatus)>
                    Enregistrer
                </button>
            </div>
        </div>
    @endif
</form>
