@extends('layout')

@section('titre','Nouvelle reservation')

@section('content')

<div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Formulaire de demande</h3>
        </div>

        <form method="POST" action="{{ route('reservation.store') }}">
          <div class="card-body">

            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nom du voyageur</label>
                    <input type="text" class="form-control" placeholder="Nom">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Prénom(s) du voyageur</label>
                    <input type="text" class="form-control" placeholder="Prénom(s)">
                  </div>
                </div>
              </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="passport_num" class="col-sm-4 col-form-label">Numéro passport</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="passport_num" placeholder="Numéro passport">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="exampleInputFile" class="col-sm-4 col-form-label">Photo du Passport</label>
                      <div class="input-group col-sm-8">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choisir fichier</label>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="depart" class="col-sm-4 col-form-label">Date de départ</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="depart" placeholder="Depart">
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="retour" class="col-sm-4 col-form-label">Date de retour</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="retour" placeholder="Retour">
                        </div>
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="ville_depart" class="col-sm-4 col-form-label">Depart</label>
                      <div class="col-sm-8">
                        <select id="ville_depart" class="form-control select2" style="width: 100%;">
                          <option value=""> -- Choisir --  </option>
                          @foreach (getCapitalNames() as $ville)
                          <option> {{ $ville }} </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="ville_destination" class="col-sm-4 col-form-label">Destination</label>
                      <div class="col-sm-8">
                        <select id="ville_destination" class="form-control select2" style="width: 100%">
                            <option value=""> -- Choisir --  </option>
                            @foreach (getCapitalNames() as $ville)
                            <option> {{ $ville }} </option>
                            @endforeach
                        </select>
                      </div>
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
