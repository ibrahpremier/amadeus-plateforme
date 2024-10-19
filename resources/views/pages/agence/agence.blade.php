@extends('layout')

@section('titre')
    Liste des Agences
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Agences</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nom</th>
                                <th>Marge Éco (%)</th>
                                <th>Marge Business (%)</th>
                                <th>Marge First (%)</th>
                                <th>Marge Jet (%)</th>
                                <th>Contact</th>
                                <th>Description</th>
                                <th>Actions</th> <!-- Colonne pour les boutons d'actions -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agences as $agence)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $agence->nom }}</td>
                                    <td>{{ $agence->marge_eco }} %</td>
                                    <td>{{ $agence->marge_business }} %</td>
                                    <td>{{ $agence->marge_first }} %</td>
                                    <td>{{ $agence->marge_jet }} %</td>
                                    <td>
                                        {{ $agence->telephone }} <br>
                                        <a href="mailto:{{ $agence->email }}">{{ $agence->email }}</a>
                                    </td>
                                    <td>{{ $agence->description }}</td>
                                    <td>
                                        <!-- Boutons d'actions -->
                                        <a href="{{ route('agence.show', $agence->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        <a href="{{ route('agence.edit', $agence->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <form action="{{ route('agence.destroy', $agence->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?');">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- Pagination -->
    {{ $agences->links() }}
@endsection
