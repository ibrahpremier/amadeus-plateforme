@extends('layout')

@section('titre','Nouvelle reservation')

@section('content')

<div class="row">
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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="date_depart" class="col-sm-4 col-form-label">Date de départ</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="date_depart" name="date_depart" required>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="retour" class="col-sm-4 col-form-label">Date de retour</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="retour" name="date_retour" required>
                        </div>
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                      <label for="ville_depart">Depart</label>
                      {{-- <div class="col-sm-8"> --}}
                        <select class="form-control select2" style="width: 100%;" id="ville_depart" name="ville_depart" required>
                          <option value=""> -- Choisir --  </option>
                          @foreach (getCapitalNames() as $ville)
                          <option @if (old('ville_depart') == $ville) selected @endif> {{ $ville }} </option>
                          @endforeach
                        </select>
                      {{-- </div> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="ville_destination">Destination</label>
                      {{-- <div class="col-sm-8"> --}}
                        <select class="form-control select2" style="width: 100%" id="ville_destination" name="ville_destination" required>
                            <option value=""> -- Choisir --  </option>
                            @foreach (getCapitalNames() as $ville)
                            <option @if (old('ville_destination') == $ville) selected @endif> {{ $ville }} </option>
                            @endforeach
                        </select>
                      {{-- </div> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                      <label for="classe">Classe</label>
                      {{-- <div class="col-sm-8"> --}}
                        <select class="form-control" style="width: 100%" id="classe" name="classe" required>
                            <option @if (old('classe') == 'economique') selected @endif value="economique">Economique </option>
                            <option @if (old('classe') == 'business') selected @endif value="business">Business </option>
                            <option @if (old('classe') == 'first') selected @endif value="first">First </option>
                        </select>
                      {{-- </div> --}}
                    </div>
                </div>
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
        });
    </script>
@endsection
