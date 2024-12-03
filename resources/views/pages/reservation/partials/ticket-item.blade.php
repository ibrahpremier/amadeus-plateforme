<div class="time-label">
    <span class="bg-danger">
        {{ date('d/m/Y à H:i', strtotime($ticket->updated_at)) }}
    </span>
</div>
<div>
    <i class="far fa-clock bg-gray"></i>
    <div class="timeline-item">
        <h3 class="timeline-header">
            <strong>{{ $ticket->reponse_message }}</strong>
        </h3>
        {{-- Logique pour afficher le contenu du ticket selon le statut et le rôle --}}
    </div>
</div> 