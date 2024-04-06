@extends('layout')

@section('titre','Details de la réservation')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Details de la reservation</h3>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Nom du voyageur</label>
                        <input type="text" class="form-control" value="{{$reservation_fake->nom}}" readonly>
                      </div>
                    </div>
                  </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="passport_num" class="col-sm-4 col-form-label">Numéro passport</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="passport_num" value="{{$reservation_fake->num_passport}}AAA" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="depart" class="col-sm-4 col-form-label">Date de départ</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="depart" value="{{$reservation_fake->date_depart}}" readonly>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="retour" class="col-sm-4 col-form-label">Date de retour</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="retour" value="{{$reservation_fake->date_retour}}" readonly>
                            </div>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label for="pays" class="col-sm-4 col-form-label">Depart</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="pays" value="{{$reservation_fake->depart}}" readonly>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label for="pays" class="col-sm-4 col-form-label">Destination</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="pays" value="{{$reservation_fake->destination}}" readonly>
                          </div>
                        </div>
                    </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Demande de correction</button>
              </div>
            </div>
        </div>

        <div class="col-md-10 offset-md-1">
            <div class="tab-pane" id="timeline">
              <div class="timeline timeline-inverse">
                {{-- ELEMENT TIMELINE --}}
                <div class="time-label">
                  <span class="bg-danger">
                    17 Avril 2024 12:05
                  </span>
                </div>
                <div>
                <i class="far fa-clock bg-gray"></i>
                  <div class="timeline-item">
                    <span class="time"><em>par Kaboré Inoussa</em></span>
                    <h3 class="timeline-header"><a href="#">Modification de billet</a>: Report de la date de retour</h3>
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="pays" class="col-sm-6 col-form-label">Ancienne date</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control" id="pays" value="15/04/2024" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-1">
                                <div class="form-group row">
                                    <label for="pays" class="col-sm-6 col-form-label">Nouvelle date</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control" id="pays" value="15/04/2024" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                  </div>
                </div>
                {{-- FIN ELEMENT TIMELINE --}}
                {{-- ELEMENT TIMELINE --}}
                <div class="time-label">
                    <span class="bg-danger">
                      17 Avril 2024 14:39
                    </span>
                  </div>
                  <div>
                  <i class="far fa-clock bg-gray"></i>
                    <div class="timeline-item">
                      <span class="time"><em>par Coulibaly Anatole</em></span>
                      <h3 class="timeline-header"><a href="#" class="text-success">Demande traité</a>: Report de la date de retour appliqué</h3>
                      <div class="timeline-body">
                          <div class="row">
                              <div class="col-md-6">
                                       <a href="https://www.coursehero.com/file/43160696/Billet-dAvion-1pdf/" target="blank" class="btn btn-warning btn-block">Télecharger le billet</a>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  {{-- FIN ELEMENT TIMELINE --}}

                {{-- ELEMENT TIMELINE --}}
                <div class="time-label">
                    <span class="bg-danger">
                      21 Avril 2024 10:02
                    </span>
                  </div>
                  <div>
                  <i class="far fa-clock bg-gray"></i>
                    <div class="timeline-item">
                      <span class="time"><em>par Kaboré Inoussa</em></span>
                      <h3 class="timeline-header"><a href="#" class="text-success">Fin de mission</a> Cout total du billet: 556 000 FCFA TTC</h3>
                      <div class="timeline-body">
                          <div class="row">
                              <div class="col-md-6">
                                       <a href="https://www.kafeo.com/factures/Modele-facture-Kafeo.doc" target="blank" class="btn btn-warning btn-block">Télecharger la facture</a>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  {{-- FIN ELEMENT TIMELINE --}}


                <div>
                  <i class="fa fa-check-circle bg-success" aria-hidden="true"></i>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
        </div>
    </div>
@endsection
