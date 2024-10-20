@extends('layout')

@section('titre')
    Détails de l'Agence
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-primary text-white me-2">
                <i class="fas fa-building"></i>
            </span> Détails de l'Agence: {{ $agence->nom }}
        </h3>
    </div>

    <div class="card py-3">

        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h5>Informations de l'Agence</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item"><strong>Nom:</strong> {{ $agence->nom }}</li>
                            <li class="list-group-item"><strong>Téléphone:</strong> {{ $agence->telephone }}</li>
                            <li class="list-group-item"><strong>Email:</strong> <a
                                    href="mailto:{{ $agence->email }}">{{ $agence->email }}</a></li>
                            <li class="list-group-item"><strong>Description:</strong> {{ $agence->description }}</li>
                        </ul>

                        <h5>Marges</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Marge Éco:</strong> {{ $agence->marge_eco }} %</li>
                            <li class="list-group-item"><strong>Marge Business:</strong> {{ $agence->marge_business }} %
                            </li>
                            <li class="list-group-item"><strong>Marge First:</strong> {{ $agence->marge_first }} %</li>
                            <li class="list-group-item"><strong>Marge Jet:</strong> {{ $agence->marge_jet }} %</li>
                        </ul>

                        <a href="{{ route('agence.index') }}" class="btn btn-secondary mt-4">Retour à la liste des
                            agences</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
