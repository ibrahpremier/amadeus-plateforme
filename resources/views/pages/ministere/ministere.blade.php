@extends('layout')

@section('titre')
    Liste des Ministères
@endsection

@section('content')
    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="clearfix mb-3">
        <a href="{{ route('ministere.create') }}" class="btn btn-primary float-right mr-5">Créer un ministère</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="card-title text-center">Ministères enregistrés</h4>
                    <p class="text-center text-muted">
                        <em>Ci-dessous la liste des ministères enregistrés dans le système</em>
                    </p>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>Nom</th>
                                <th>Plafond Budgétaire</th>
                                <th>Notes</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ministeres as $ministere)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $ministere->nom }}</td>
                                    <td>{{ $ministere->dotation }} F CFA</td>
                                    <td>{{ $ministere->description ?? 'Pas de notes' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('ministere.edit', $ministere->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="mdi mdi-pencil"></i> Modifier
                                            </a>
                                            <form action="{{ route('ministere.destroy', $ministere->id) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce ministère ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="mdi mdi-delete"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
