<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="depart" class="col-sm-4 col-form-label">Date de départ</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="depart" value="{{ $reservation->date_depart }}" readonly>
            </div>
        </div>
    </div>
    @if($reservation->date_retour)
    <div class="col-md-6">
        <div class="form-group row">
            <label for="retour" class="col-sm-4 col-form-label">Date de retour</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="retour" value="{{ $reservation->date_retour }}" readonly>
            </div>
        </div>
    </div>
    @endif
</div> 