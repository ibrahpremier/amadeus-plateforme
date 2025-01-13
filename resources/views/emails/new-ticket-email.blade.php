<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande de réservation - CVE </title>
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
            <div class="logo">CVE Agence</div>
            <h1>Nouvelle demande de réservation</h1>
        </div>
        <div class="content">
            <h2>Bonjour,</h2>

            @if(!$affectation)
            <p>Une nouvelle demande à été soumise 
                @if ($ticket->reservation->ministere)
                    par le {{ $ticket->reservation->ministere->nom }}.
                @endif
            </p>
            @else
            <p>
                Une nouvelle demande soumise 
                @if ($ticket->reservation->ministere)
                    par le {{ $ticket->reservation->ministere->nom }}
                @endif
                &nbsp;vous à été affecté;
            </p>
            @endif

            <div class="details">
                <p>
                    <strong><u>Trajet </u></strong><br><br>
                   <i class="fas fa-plane-departure mr-2"></i>{{$ticket->reponse_ville_depart}} --> <i class="fas fa-plane-arrival mr-2"></i> {{$ticket->reponse_ville_destination}} ({{date('d/m/Y',strtotime($ticket->reponse_date_depart))}})<br>
                   <i class="fas fa-plane-departure mr-2"></i>{{$ticket->reponse_ville_destination}} --> <i class="fas fa-plane-arrival mr-2"></i> {{$ticket->reponse_ville_depart}} ({{date('d/m/Y',strtotime($ticket->reponse_date_retour))}})<br>
                </p>
            </div>

            <div class="my-4 my-2 d-flex justify-content-center align-items-center">
                <a href="{{route('reservation.show',$ticket->reservation->id)}}" class="btn btn-primary">Consulter la demande</a>
            </div>
            
        <div class="card">
            <div class="card-body">
                <p>
                    Si le bouton ne s'affiche pas correctement, ouvrez ce lien directement :
                    <a href="{{route('reservation.show',$ticket->reservation->id)}}">{{route('reservation.show',$ticket->reservation->id)}}</a>
                </p>
            </div>
        </div>

        </div>
        <div class="footer">
            <p>Cordialement,<br>L'équipe CVE</p>
            <p>Tél : +XX XX XX XX XX | Email : contact@rafagence.com</p>
            <p>&copy; CVE 2024 . Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
