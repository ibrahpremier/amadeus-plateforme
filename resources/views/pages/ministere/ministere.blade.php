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

                <div class="card-body">

            <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                  <th>Ministères</th>
                  <th class="text-right">Nouvelles demandes</th>
                  <th class="text-right">Demandes traités</th>
                  <th class="text-right">Solde disponible</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($ministeres as $ministere)
                  <tr>
                    <td>{{ $ministere->nom }}</td>
                    <td class="text-right">{{ $ministere->reservations_news }}</td>
                    <td class="text-right text-success"> {{ $ministere->reservations_traites }} </td>
                    <td class="text-right" > {{ $ministere->solde }} </td>
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
