@extends('layout')

@section('titre')
    Liste des compagnies
@endsection

@section('content')
    <div class="container-fluid">
        <h2 class="my-4">Gestion des Compagnies</h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card py-3 mb-4">
            <div class="card-body">
                <form action="{{ route('compagnie.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom"
                            name="nom" value="{{ old('nom') }}" placeholder="Nom de la compagnie" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Ajouter Compagnie</button>
                        </div>
                    </div>
                    @error('nom')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </form>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search" placeholder="Rechercher une compagnie..."
                        aria-label="Rechercher">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Chercher</button>
                    </div>
                </div>

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compagnies as $compagnie)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $compagnie->nom }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $compagnie->id }}">
                                        <i class="fas fa-edit"></i> Modifier
                                    </button>
                                    <form action="{{ route('compagnie.destroy', $compagnie->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette compagnie ?');">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal pour la mise à jour -->
                            <div class="modal fade" id="editModal{{ $compagnie->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel{{ $compagnie->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $compagnie->id }}">Modifier
                                                Compagnie</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('compagnie.update', $compagnie->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nom">Nom de la compagnie</label>
                                                    <input type="text"
                                                        class="form-control @error('nom') is-invalid @enderror"
                                                        id="nom" name="nom" value="{{ $compagnie->nom }}"
                                                        required>
                                                    @error('nom')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{ $compagnies->links() }} <!-- Pagination -->
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function() {
            // Ajoutez des fonctionnalités de recherche si nécessaire.
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
