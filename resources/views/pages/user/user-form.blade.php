@extends('layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Gestion des Utilisateur
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-10 col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">

                    <h2 class="card-title">Nouvel utilisateur</h2> <br>
                    <small><em>Remplissez le formulaire pour créer un nouvel utilisateur</em></small>
                </div>
                <div class="card-body border">
                    <form class="forms-sample" method="post" action="{{ route('user.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group mb-2 col-lg-6">
                                <label for="poste">Poste <sup class="text-danger">*</sup></label>
                                <select name="poste" id="poste"
                                    class="form-control @error('poste') is-invalid @enderror" required>
                                    <option value=""> -- Choisir -- </option>
                                    <option value="cellule" class="text-capitalize"
                                        @if (old('poste') == 'cellule') selected @endif>Agent Cellule</option>
                                    <option value="charge_mission" class="text-capitalize"
                                        @if (old('poste') == 'charge_mission') selected @endif>Chargé de mission</option>
                                    <option value="comptable" class="text-capitalize"
                                        @if (old('poste') == 'comptable') selected @endif>Comptable</option>
                                </select>
                                @error('poste')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-2 col-lg-6" id="ministereCol">
                                <label for="ministere">Ministère</label>
                                <select name="ministere" id="ministere"
                                    class="form-control @error('ministere') is-invalid @enderror" required>
                                    <option value=""> -- Choisir -- </option>
                                    @foreach ($ministeres as $ministere)
                                        <option value="{{ $ministere->id }}" class="text-capitalize"
                                            @if (old('ministere') == $ministere->id) selected @endif>{{ $ministere->nom }}</option>
                                    @endforeach
                                </select>
                                @error('ministere')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group mb-2 col-lg-2">
                                <label for="civilite">Civilité <sup class="text-danger">*</sup></label>
                                <select name="civilite" id="civilite"
                                    class="form-control @error('civilite') is-invalid @enderror" required>
                                    <option value=""> -- </option>
                                    <option value="M." class="text-capitalize"
                                        @if (old('civilite') == 'M.') selected @endif>M.</option>
                                    <option value="Mme." class="text-capitalize"
                                        @if (old('civilite') == 'Mme.') selected @endif>Mme</option>
                                </select>
                                @error('civilite')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="form-group mb-2 col-lg-4">
                                <label for="nom">Nom <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    value="{{ old('nom') }}" id="nom" name="nom" placeholder="nom">
                                @error('nom')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-2 col-lg-6">
                                <label for="prenom">Prénom(s)</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                    value="{{ old('prenom') }}" id="prenom" name="prenom" placeholder="prenom">
                                @error('prenom')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group mb-2 col-md-6">
                                <label for="telephone">Téléphone <sup class="text-danger">*</sup></label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror"
                                    value="{{ old('telephone') }}" id="telephone" name="telephone" placeholder="Téléphone">
                                @error('telephone')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-2 col-md-6">
                                <label for="email">Email <sup class="text-danger">*</sup></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" id="email" name="email" placeholder="email">
                                @error('email')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- <div class="row">
    <div class="form-group mb-2 col-lg-6 ">
        <label for="contrat_type">Type de contrat</label>
        <select onchange="typeChange()" name="contrat_type" id="type" class="form-control @error('contrat_type') is-invalid @enderror" value="{{old("contrat_type")}}" required>
            <option value=""> -- Choisir --  </option>
            <option value="stage"> Stage </option>
            <option value="consultant"> Consultance </option>
          <option value="CDD"> CDD </option>
          <option value="CDI"> CDI </option>
        </select>
        @error('contrat_type')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group mb-2 col-3">
        <label for="contrat_start">Date de debut</label>
        <input type="date" class="form-control @error('contrat_start') is-invalid @enderror" value="{{old('contrat_start')}}" id="contrat_start" name="contrat_start">
        @error('contrat_start')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-2 col-3" id="contrat_end_group">
        <label for="contrat_end">Date de fin</label>
        <input type="date" class="form-control @error('contrat_end') is-invalid @enderror" value="{{old('contrat_end')}}" id="contrat_end" name="contrat_end">
        @error('contrat_end')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>

</div> --}}

                        {{-- <div class="row">
    <div class="form-group col-12">
        <label for="note">Joindre le contrat</label>
        <input type="file" name="contrat_file" class="form-control">
        @error('note')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-2">
    <div class="form-group col-12">
        <label for="note">Note</label>
        <textarea class="form-control @error('note') is-invalid @enderror" value="{{old('note')}}" id="note" name="note" placeholder="Notes particulières à propos de cet employé"></textarea>
        @error('note')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>
</div> --}}

                        <div class="row mt-5">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-secondary" href="{{ url()->previous() }}">annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_js')
    <script>
        $(document).ready(function() {
            console.log("BONJOUR");

            $('#poste').change(function() {
                var poste = $(this).val();
                console.log("POSTE: ", poste);
                if (poste === 'cellule') {
                    $('#ministereCol').hide();
                    // $('#ministere').prop('disabled', true);
                } else {
                    $('#ministereCol').fadeIn();
                    // $('#ministere').prop('disabled', false);
                }
            });

        });
    </script>
@endsection
