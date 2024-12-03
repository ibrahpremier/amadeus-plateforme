<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="pays" class="col-sm-4 col-form-label">Depart</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ $reservation->ville_depart }}" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="pays" class="col-sm-4 col-form-label">Destination</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ $reservation->ville_destination }}" readonly>
            </div>
        </div>
    </div>
</div> 