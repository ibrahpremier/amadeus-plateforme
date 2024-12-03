<div class="time-label">
    <span class="bg-danger">
        {{ date('d/m/Y à H:i', strtotime($reservation->created_at)) }}
    </span>
</div>
<div>
    <i class="far fa-clock bg-gray"></i>
    <div class="timeline-item">
        <h3 class="timeline-header">
            <strong>Demande de reservation</strong>
        </h3>
        <div class="timeline-body">
            <div class="row">
                <div class="col-md-6 bg-warning p-3">
                    <u>Départ:</u> le {{ date('d/m/Y', strtotime($reservation->date_depart)) }}<br>
                    <i class="fas fa-plane-departure mr-2"></i>{{ $reservation->ville_depart }}<br>
                    <i class="fas fa-plane-arrival mr-2"></i>{{ $reservation->ville_destination }}<br>
                </div>
                <div class="col-md-6 bg-success p-3">
                    <u>Retour:</u> le {{ date('d/m/Y', strtotime($reservation->date_retour)) }}<br>
                    <i class="fas fa-plane-departure mr-2"></i>{{ $reservation->ville_destination }}<br>
                    <i class="fas fa-plane-arrival mr-2"></i>{{ $reservation->ville_depart }}<br>
                </div>
            </div>
        </div>
    </div>
</div> 