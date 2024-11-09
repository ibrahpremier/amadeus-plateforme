@extends('layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Gestion des Ministères
        </h3>
    </div>

    {{-- @dump($errors->all()) --}}

    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-light">
                    <h2 class="card-title text-center">Nouveau Ministère</h2>
                    <small class="d-block text-center text-muted"><em>Remplissez le formulaire ci-dessous</em></small>
                </div>
                <div class="card-body border p-4">
                    <form class="forms-sample" method="post" action="{{ route('ministere.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group mb-4 col-md-8">
                                <label for="nom">Nom du Ministère <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    value="{{ old('nom') }}" id="nom" name="nom" placeholder="Entrer le nom">
                                @error('nom')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4 col-md-4">
                                <label for="dotation">Plafond Budgétaire (facultatif)</label>
                                <input type="number" class="form-control @error('dotation') is-invalid @enderror"
                                    value="{{ old('dotation') }}" id="dotation" name="dotation"
                                    placeholder="Montant en F CFA">
                                @error('dotation')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group mb-4 col-md-12">
                                <label for="description">Notes (Facultatif)</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    placeholder="Ajoutez des notes supplémentaires ici">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-row mt-4">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-secondary" href="{{ url()->previous() }}">Annuler</a>
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
            console.log("Form ready");
        });
    </script>
@endsection
