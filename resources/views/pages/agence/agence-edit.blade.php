@extends('layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-warning text-white me-2">
                <i class="fas fa-building"></i>
            </span> Modifier l'agence
        </h3>
    </div>

    {{-- @dump($errors->all()) --}}
    <div class="card py-3">
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <form action="{{ route('agence.update', $agence->id) }}" method="post">
                            @csrf <!-- Protection contre les attaques CSRF -->
                            @method('PUT') <!-- Méthode PUT pour la mise à jour -->

                            <!-- Section 1: Informations principales -->
                            <div class="row">
                                <!-- Colonne pour Nom, Téléphone, Email -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nom">Nom</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                                id="nom" name="nom" value="{{ old('nom', $agence->nom) }}"
                                                placeholder="Nom de l'agence" required>
                                        </div>
                                        @error('nom')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="telephone">Téléphone</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="text"
                                                class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                                                name="telephone" value="{{ old('telephone', $agence->telephone) }}"
                                                placeholder="Téléphone" required>
                                        </div>
                                        @error('telephone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $agence->email) }}"
                                                placeholder="Email" required>
                                        </div>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Colonne pour la description -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            cols="30" rows="6" placeholder="Description de l'agence">{{ old('description', $agence->description) }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Marges -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="marge_eco">Marge économique</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                            <input type="number"
                                                class="form-control @error('marge_eco') is-invalid @enderror" id="marge_eco"
                                                name="marge_eco" value="{{ old('marge_eco', $agence->marge_eco) }}"
                                                placeholder="%" required>
                                        </div>
                                        @error('marge_eco')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="marge_business">Marge business</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                            <input type="number"
                                                class="form-control @error('marge_business') is-invalid @enderror"
                                                id="marge_business" name="marge_business"
                                                value="{{ old('marge_business', $agence->marge_business) }}"
                                                placeholder="%" required>
                                        </div>
                                        @error('marge_business')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="marge_first">Marge first</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                            <input type="number"
                                                class="form-control @error('marge_first') is-invalid @enderror"
                                                id="marge_first" name="marge_first"
                                                value="{{ old('marge_first', $agence->marge_first) }}" placeholder="%"
                                                required>
                                        </div>
                                        @error('marge_first')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="marge_jet">Marge jet</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                            <input type="number"
                                                class="form-control @error('marge_jet') is-invalid @enderror"
                                                id="marge_jet" name="marge_jet"
                                                value="{{ old('marge_jet', $agence->marge_jet) }}" placeholder="%"
                                                required>
                                        </div>
                                        @error('marge_jet')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Bouton de soumission -->
                            <button type="submit" class="btn btn-warning mt-4 w-100">Modifier l'agence</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function() {
            console.log("Formulaire de modification chargé");
        });
    </script>
@endsection