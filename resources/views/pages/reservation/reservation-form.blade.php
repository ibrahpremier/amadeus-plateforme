@extends('layout')

@section('titre','Nouvelle reservation')

@section('content')

<div class="row">
    @if($errors->any())
        <div class="col-md-10 offset-md-1 mb-3">
            <pre>{{ print_r($errors->all(), true) }}</pre>
        </div>
    @endif
    
    <div class="col-md-10 offset-md-1">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Formulaire de demande</h3>
        </div>

        <form method="POST" action="{{ route('reservation.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="card-body">

            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="nom">Nom du voyageur</label>
                    <input type="text" class="form-control" placeholder="Nom" id="nom" name="nom" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="prenom">Prénom(s) du voyageur</label>
                    <input type="text" class="form-control" placeholder="Prénom(s)" id="prenom" name="prenom" required>
                  </div>
                </div>
              </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_passport">Numéro passport</label>
                        <input type="text" class="form-control" id="numero_passport" placeholder="Numéro passport" name="numero_passport" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="file_passport">Scan du Passport(image/pdf)</label>
                      <input type="file" class="form-control" id="file_passport" name="file_passport">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="type_voyage">Type de voyage</label>
                  <select class="form-control" id="type_voyage" name="type_voyage" required onchange="toggleRetourDate()">
                    <option value="aller_retour" @if(old('type_voyage') == 'aller_retour') selected @endif>Aller-retour</option>
                    <option value="aller_simple" @if(old('type_voyage') == 'aller_simple') selected @endif>Aller simple</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group row">
                  <label for="classe">Classe</label>
                    <select class="form-control" style="width: 100%" id="classe" name="classe" required>
                        <option @if (old('classe') == 'economique') selected @endif value="economique">Economique </option>
                        <option @if (old('classe') == 'business') selected @endif value="business">Business </option>
                        <option @if (old('classe') == 'first') selected @endif value="first">First </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                  <label for="visa">Visa</label>
                    <select class="form-control" style="width: 100%" id="visa" name="visa" required>
                        <option @if (old('visa') === '0') selected @endif value="0">Non</option>
                        <option @if (old('visa') === '1') selected @endif value="1">Oui</option>
                    </select>
                </div>
            </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
                    <label for="ville_depart" class="col-sm4 col-form-label">Depart</label>
                    <div class="col-sm-8">
                      <select class="form-control select2" style="width: 100%;" id="ville_depart" name="ville_depart" required>
                        <option value=""> -- Choisir --  </option>
                        @foreach (getCapitalNames() as $ville)
                        <option @if(old('ville_depart') && old('ville_depart') == $ville) selected @elseif($ville=='Ouagadougou') selected  @endif> {{ $ville }} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group row">
                    <label for="ville_destination" class="col-sm-4 col-form-label">Destination</label>
                    <div class="col-sm-8">
                      <select class="form-control select2" style="width: 100%" id="ville_destination" name="ville_destination" required>
                          <option value=""> -- Choisir --  </option>
                          @foreach (getCapitalNames() as $ville)
                          <option @if (old('ville_destination') == $ville) selected @endif> {{ $ville }} </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
              </div>
          </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="date_depart" class="col-sm-4 col-form-label">Date de départ</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="date_depart" name="date_depart" required>
                        </div>
                      </div>
                </div>
                <div class="col-md-6" id="retour_date_div">
                    <div class="form-group row">
                        <label for="retour" class="col-sm-4 col-form-label">Date de retour</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="retour" name="date_retour">
                        </div>
                      </div>
                </div>
            </div>


            <div class="form-group">
                <label for="motif">Motif du voyage</label>
                <textarea class="form-control" id="motif" name="motif" rows="3" placeholder="Décrivez le motif de votre voyage" required>{{ old('motif') }}</textarea>
            </div>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-block">envoyer</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
</div>
@endsection
@section('custom_js')
    <script>
        $(function () {
            $('.select2').select2()
            toggleRetourDate(); // Initial check
        });

        function toggleRetourDate() {
            const typeVoyage = document.getElementById('type_voyage').value;
            const retourDiv = document.getElementById('retour_date_div');
            const retourInput = document.getElementById('retour');
            
            if (typeVoyage === 'aller_simple') {
                retourDiv.style.display = 'none';
                retourInput.removeAttribute('required');
                retourInput.value = '';
            } else {
                retourDiv.style.display = 'block';
                retourInput.setAttribute('required', 'required');
            }
        }
    </script>
@endsection
