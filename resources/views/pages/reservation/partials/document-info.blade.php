<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="passport_num" class="col-sm-4 col-form-label">Numéro passport</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="passport_num" value="{{ $reservation->numero_passport }}" readonly>
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
                <input type="text" class="form-control" value="{{ $reservation->visa ? 'Oui' : 'Non' }}" readonly>
            </div>
        </div>
    </div>
</div> 