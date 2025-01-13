<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Commande - Billet d'Avion</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f9; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #007BFF; }
        .header img { max-width: 150px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        /* th { background-color: #007BFF; color: #fff; } */
        .total { font-weight: bold; text-align: right; }
        hr { border: 0; border-top: 1px solid #ddd; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="header">
        <img src="path/to/logo.png" alt="Logo">
        <h1>Bon de Commande - Billet d'Avion</h1>
        <p>Numéro de commande : {{ $reservation->id }}</p>
        <p>Date : {{date('d/m/Y H:i',strtotime($reservation->created_at))}}</p>
    </div>
    <h3>Informations sur le client</h3>
    <p><strong>Nom :</strong> {{ $reservation->nom }} {{ $reservation->prenom }}</p>
    <hr>
    <h3>Détails du vol</h3>
    <table>
        <tr>
            <th>Type de vol</th>
            <td>{{ $reservation->type_voyage }} </td>
        </tr>
        <tr>
            <th>Trajet</th>
            <td>{{ $reservation->ville_depart }} => {{ $reservation->ville_destination }} </td>
        </tr>
        <tr>    
            <th>Date de départ</th>
            <td>{{ date('d/m/Y',strtotime($reservation->date_depart)) }} </td>
        </tr>
        @if($reservation->type_voyage == 'aller-retour')
        <tr>    
            <th>Date de retour</th>
            <td>{{ date('d/m/Y',strtotime($reservation->date_retour)) }} </td>
        </tr>
        @endif
        <tr>
            <th>Classe</th>
            <td>{{ $reservation->classe }}</td>
        </tr>
        <tr>
            <th>Visa</th>
            <td>{{ $reservation->visa ? 'Oui' : 'Non' }}</td>
        </tr>
    </table>
    <h3>Détails de la facturation</h3>
    <table>
        <tr class="total">
            <th>Tarif</th>
            <td>{{ number_format($reservation->montant_reservation, 0, ',', ' ') }} FCFA</td>
        </tr>
    </table>
</body>
</html>
