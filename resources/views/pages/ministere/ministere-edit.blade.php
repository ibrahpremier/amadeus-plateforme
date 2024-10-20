@extends('layout')

@section('titre')
    Modifier le Ministère
@endsection

@section('content')
    {{-- <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-warning text-white me-2">
                <i class="mdi mdi-pencil"></i>
            </span> Modifier le Ministère
        </h3>
    </div> --}}

    <div class="row justify-content-center">
        <div class="col-md-8 col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="card-title text-center">Modifier le Ministère</h4>
                    <p class="text-center text-muted"><em>Modifiez les informations du ministère</em></p>
                </div>

                <div class="card-body border">
                    <form class="forms-sample" method="post" action="{{ route('ministere.update', $ministere->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group mb-2 col-md-8">
                                <label for="nom">Nom <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    value="{{ old('nom', $ministere->nom) }}" id="nom" name="nom"
                                    placeholder="Nom du ministère">
                                @error('nom')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-2 col-md-4">
                                <label for="dotation">Plafond budgétaire <small>(facultatif)</small></label>
                                <input type="number" class="form-control @error('dotation') is-invalid @enderror"
                                    value="{{ old('dotation', $ministere->dotation) }}" id="dotation" name="dotation"
                                    placeholder="Montant en F CFA">
                                @error('dotation')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-2 col-md-12">
                                <label for="description">Notes <small>(facultatif)</small></label>
                                <textarea cols="30" rows="3" class="form-control @error('description') is-invalid @enderror" id="description"
                                    name="description" placeholder="Notes sur le ministère">{{ old('description', $ministere->description) }}</textarea>
                                @error('description')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-6">
                                <button type="submit" class="btn btn-success btn-block">Mettre à jour</button>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-secondary btn-block" href="{{ url()->previous() }}">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
