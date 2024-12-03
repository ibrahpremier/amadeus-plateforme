@if (getLoggedUser()->role == 'agent_ministere')
    {{-- Actions pour agent_ministere --}}
@elseif(getLoggedUser()->role == 'chef_cellule' || getLoggedUser()->role == 'coordinateur')
    <div class="row">
        <div class="col-md-6">
            <u>Chargé de mission</u>: <b>{{ $reservation->agent_ministere?->nom . ' ' . $reservation->agent_ministere?->prenom }}</b>
        </div>
        <div class="col-md-6 text-right">
            @if ($reservation->agent_cellule)
                <u>Traité par</u>: <b>{{ $reservation->agent_cellule->nom . ' ' . $reservation->agent_cellule->prenom }}</b>
            @elseif(!$reservation->chef_cellule_id && getLoggedUser()->role == 'coordinateur')
                {{-- Formulaire pour coordinateur --}}
            @elseif(getLoggedUser()->role == 'chef_cellule')
                {{-- Formulaire pour chef_cellule --}}
            @endif
        </div>
    </div>
@endif 