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
                                    <option value="agent_cellule" class="text-capitalize" @if (old('poste') == 'agent_cellule') selected @endif>Agent Cellule</option>
                                    <option value="agent_ministere" class="text-capitalize" @if (old('poste') == 'agent_ministere') selected @endif>Chargé de mission</option>
                                </select>
                                @error('poste')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-2 col-lg-6" id="ministereCol">
                                <label for="ministere">Ministère</label>
                                <select name="ministere" id="ministere"
                                    class="form-control @error('ministere') is-invalid @enderror">
                                    <option value=""> -- Choisir -- </option>
                                    @foreach ($ministeres as $ministere)
                                        <option value="{{ $ministere->id }}" class="text-capitalize" @if (old('ministere') == $ministere->id) selected @endif>{{ $ministere->nom }}</option>
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
                if (poste === 'agent_cellule') {
                    $('#ministereCol').hide();
                } else {
                    $('#ministereCol').fadeIn();
                }
            });

        });


    function typeChange(){
      
    }
    </script>
@endsection
