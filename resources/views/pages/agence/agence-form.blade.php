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
        <div class="col-md-8 col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">

                    <h2 class="card-title">Nouvel utilisateur</h2> <br>
                    <small><em>Remplissez le formulaire pour créer un nouvel utilisateur</em></small>
                </div>
                <div class="card-body border">
                    <form class="forms-sample" method="post" action="{{ route('agence.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group mb-2 col-md-8">
                                <label for="nom">Nom <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    value="{{ old('nom') }}" id="nom" name="nom" placeholder="nom">
                                @error('nom')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-2 col-md-4">
                                <label for="nom">Taux (%)<sup class="text-danger">*</sup></label>
                                <input type="number" class="form-control @error('taux') is-invalid @enderror"
                                    value="{{ old('taux') }}" id="taux" name="taux" placeholder="taux">
                                @error('taux')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="row">


                        </div>

                        <div class="row">
                            <div class="form-group mb-2 col-md-5">
                                <label for="telephone">Téléphone <sup class="text-danger">*</sup></label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror"
                                    value="{{ old('telephone') }}" id="telephone" name="telephone" placeholder="Téléphone">
                                @error('telephone')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-2 col-md-7">
                                <label for="email">Email <sup class="text-danger">*</sup></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" id="email" name="email" placeholder="email">
                                @error('email')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-2 col-md-8">
                                <label for="description">Notes</label>
                                <textarea cols="30" rows="3" class="form-control"
                                    placeholder="Note" id="description" name="description"></textarea>
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
        });
    </script>
@endsection