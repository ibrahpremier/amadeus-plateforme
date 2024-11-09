<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de votre ticket de réservation - RAF Agence</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #0056b3, #007bff);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #ffffff;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #0056b3;
            margin-top: 0;
        }
        .details {
            margin: 20px 0;
            padding: 20px;
            background-color: #f1f8ff;
            border-left: 4px solid #007bff;
            border-radius: 4px;
        }
        .details p {
            margin: 10px 0;
            color: #555555;
        }
        .details p span {
            font-weight: 600;
            color: #0056b3;
        }
        .changes {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .changes h3 {
            margin-top: 0;
            color: #0056b3;
        }
        .footer {
            background: #f1f8ff;
            color: #555555;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 24px;
            background: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background: #0056b3;
        }
        @media (max-width: 600px) {
            .container {
                margin: 20px 10px;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">RAF Agence</div>
            <h1>Mise à jour de votre ticket de réservation</h1>
        </div>
        <div class="content">
            <h2>Bonjour {{ $ticket->reservation->agent_ministere->nom }},</h2>
            <p>Nous vous informons que votre ticket de réservation a été traité.Voici les détails mis à jour :</p>

            <div class="details">
                <p><span>Statut :</span> {{ $ticket->status }}</p>
                <p><span>Ville de départ :</span> {{ $ticket->reponse_ville_depart }}</p>
                <p><span>Ville de destination :</span> {{ $ticket->reponse_ville_destination }}</p>
                <p><span>Date de départ :</span> {{ \Carbon\Carbon::parse($ticket->reponse_date_depart)->format('d/m/Y') }}</p>
                <p><span>Date de retour :</span> {{ \Carbon\Carbon::parse($ticket->reponse_date_retour)->format('d/m/Y') }}</p>
                <p><span>Prix :</span> {{ $ticket->prix ?? 'Non précisé' }}</p>
                <p><span>Agence :</span> {{ $ticket->agence->nom ?? 'Non précisé' }}</p>
                <p><span>Companie :</span> {{ $ticket->compagnie->nom ?? 'Non précisé' }}</p>



                @if(!empty($ticket->response_commentaire))
                    <p><span>Commentaire de l'agent :</span> {{ $ticket->response_commentaire }}</p>
                @endif
            </div>

            @if(!empty($changes))
                <div class="changes">
                    <h4>Modifications apportées :</h4>
                    <ul>
                        @foreach($changes as $key => $change)
                        <li>
                            {{-- <strong>{{ ucfirst(str_replace('_', ' ', $key)) }} :</strong> --}}
                            de <span style="color: red;">"{{ $change['old'] }}"</span> à <span style="color: green;">"{{ $change['new'] }}"</span>
                        </li>
                    @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($ticket->reponse_file))
                <p>Un document important concernant votre réservation est disponible. Veuillez le télécharger en cliquant sur le bouton ci-dessous :</p>
                <a href="{{ asset('storage/' . $ticket->reponse_file) }}" class="btn">Télécharger le document</a>
            @endif

            <p>Si vous avez des questions ou besoin d'informations complémentaires, n'hésitez pas à nous contacter. Nous sommes là pour vous assister tout au long de votre processus de réservation.</p>
        </div>
        <div class="footer">
            <p>Cordialement,<br>L'équipe RAF Agence</p>
            <p>Tél : +XX XX XX XX XX | Email : contact@rafagence.com</p>
            <p>&copy; 2023 RAF Agence. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
