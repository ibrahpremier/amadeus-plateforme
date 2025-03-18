@extends('layout')

@section('content')
<div class="container py-5">
    <!-- Budget Details Section -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">{{ $budget->ministere->nom }}</h2>
            <p class="mb-0">Budget {{ $budget->annee_budgetaire }} | Ajouté le {{ $budget->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Année Budgétaire</h5>
                            <p class="card-text">{{ $budget->annee_budgetaire }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Dotation</h5>
                            <p class="card-text">{{ number_format($budget->dotation, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Solde</h5>
                            <p class="card-text">{{ number_format($budget->solde, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0">Transactions</h3>
        </div>
        <div class="card-body">
            @if($budget->transactions->isEmpty())
                <p class="text-muted">Aucune transaction trouvée </p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>montant</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budget->transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>
                                        @if ($transaction->type == 'in')
                                        <span class="text-success">
                                            <sup>+</sup>
                                            {{ number_format($transaction->montant, 0, ',', ' ') }} FCFA
                                        </span>
                                        @else
                                            <span class="text-danger">-
                                                {{ number_format($transaction->montant, 0, ',', ' ') }} FCFA
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
