<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Commande - Billet d'Avion</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bon de Commande - Billet d'Avion</h1>
        <p>Numéro de commande : {{ $reservation->id }}</p>
        <p>Date : {{date('d/m/Y H:i',strtotime($reservation->created_at))}}</p>
    </div>
    <h3>Informations sur le client</h3>
    <p><strong>Nom :</strong> {{ $reservation->nom }} {{ $reservation->prenom }}</p>
    {{-- <p><strong>Contact :</strong> {{ $reservation->client_contact }}</p> --}}
    <hr>
    <h3>Détails du vol</h3>
    <table>
        <tr>
            <th>Depart</th>
            <td>{{ $reservation->ville_depart }} <br>{{date('d/m/Y',strtotime($reservation->date_depart))}}</td>
        </tr>
        <tr>
            <th>Destination</th>
            <td>{{ $reservation->ville_destination }} <br>{{date('d/m/Y',strtotime($reservation->date_retour))}}</td>
        </tr>
        <tr>
            <th>Classe</th>
            <td>{{ $reservation->classe }}</td>
        </tr>
        <tr>
            <th>Visa</th>
            <td>{{ $reservation->visa }}</td>
        </tr>
    </table>
    <h3>Détails de la facturation</h3>
    <table>
        <tr class="total">
            <th>Tarif</th>
            <td>{{ number_format($reservation->total, 0, ',', ' ') }} FCFA</td>
        </tr>
    </table>
</body>
</html>
