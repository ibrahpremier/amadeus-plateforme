<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 5px;
        }

        .header {
            text-align: right;
            margin-bottom: 20px;
        }

        .no-border {
            border: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    {{-- <div class="header">
        <small><i>Émis par la plateforme à l'endroit de l'agence de voyage pour émission</i></small>
    </div> --}}

    <h2 class="text-center">BON DE COMMANDE</h2>
    <div style="margin-bottom: 10px;">
        <span>N° BDC.........................</span>
        <span style="float: right;">Date : ....../....../......</span>
    </div>

    <table>
        <tr>
            <td style="width: 50%;">
                <strong>Nom de la structure :</strong>
                {{ $reservation->agent_ministere && $reservation->agent_ministere->ministere ? $reservation->agent_ministere->ministere->nom : ' Centrale' }}<br>
                <strong>Ordonnateur :</strong> {{ $reservation->agent_ministere->nom }}
                {{ $reservation->agent_ministere->prenom }}<br>
                <strong>BDC établi par :</strong> PRABA<br>
                <strong>Livraison prévue :</strong>
            </td>
            <td>
                <strong>Compagnie:</strong> {{ $reservation->compagnie->nom }} <br>
                <strong>Agence de voyage:</strong> {{ $reservation->agence->nom }} <br>
                <p>
                    {{ $reservation->agence->telephone }}, {{ $reservation->agence->email }} <br>
                    {{ $reservation->agence->description }}
                </p>
            </td>
        </tr>
    </table>

    <table style="margin-top: 20px;">
        <tr>
            <th>Désignation article</th>
            <th>Unité achat</th>
            <th>Nbre de billets</th>
            <th>P.U. Net</th>
            <th>Montant HT</th>
        </tr>
        <tr>
            <td>
                Billet d'avion classe {{ $reservation->classe }}, <br>
                {{ $reservation->date_retour ? 'Aller retour' : 'Aller simple' }},
                {{ $reservation->ville_depart }} - {{ $reservation->ville_destination }}</td>
            <td>1</td>
            <td>1</td>
            <td class="text-right">{{ number_format($reservation->montant_reservation, 0, ',', ' ') }}</td>
            <td class="text-right">{{ number_format($reservation->montant_reservation, 0, ',', ' ') }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><strong>Total HT</strong></td>
            <td class="text-right">{{ number_format($reservation->montant_reservation, 0, ',', ' ') }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right">Commission classe {{ $reservation->classe }}</td>
            <td class="text-right">
                @php
                    $commission = 0;
                    switch ($reservation->classe) {
                        case 'economique':
                            $commission = $reservation->agence->marge_eco;
                            break;
                        case 'business':
                            $commission = $reservation->agence->marge_business;
                            break;
                        case 'first':
                            $commission = $reservation->agence->marge_first;
                            break;
                        case 'jet':
                            $commission = $reservation->agence->marge_jet;
                            break;
                    }
                @endphp
                {{ number_format($commission, 0, ',', ' ') }}
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><strong>Total TTC</strong></td>
            <td class="text-right">
                @php
                    $total = $reservation->montant_reservation + $commission;
                @endphp
                <strong> {{ number_format($total, 0, ',', ' ') }}</strong>
            </td>
        </tr>
    </table>


    <div style="margin-top: 20px;">
        <p>

            Arrêté le présent bon de commande à la somme de :
            @php
                function numberToWords($number)
                {
                    $units = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
                    $tens = [
                        '',
                        'dix',
                        'vingt',
                        'trente',
                        'quarante',
                        'cinquante',
                        'soixante',
                        'soixante-dix',
                        'quatre-vingt',
                        'quatre-vingt-dix',
                    ];
                    $teens = [
                        'dix',
                        'onze',
                        'douze',
                        'treize',
                        'quatorze',
                        'quinze',
                        'seize',
                        'dix-sept',
                        'dix-huit',
                        'dix-neuf',
                    ];

                    if ($number == 0) {
                        return 'zéro';
                    }

                    $words = '';

                    if (floor($number / 1000000) > 0) {
                        if (floor($number / 1000000) == 1) {
                            $words .= 'un million ';
                        } else {
                            $words .= numberToWords(floor($number / 1000000)) . ' millions ';
                        }
                        $number %= 1000000;
                    }

                    if (floor($number / 1000) > 0) {
                        if (floor($number / 1000) == 1) {
                            $words .= 'mille ';
                        } else {
                            $words .= numberToWords(floor($number / 1000)) . ' mille ';
                        }
                        $number %= 1000;
                    }

                    if (floor($number / 100) > 0) {
                        if (floor($number / 100) == 1) {
                            $words .= 'cent ';
                        } else {
                            $words .= $units[floor($number / 100)] . ' cent ';
                        }
                        $number %= 100;
                    }

                    if ($number > 0) {
                        if ($number < 10) {
                            $words .= $units[$number];
                        } elseif ($number < 20) {
                            $words .= $teens[$number - 10];
                        } else {
                            $words .= $tens[floor($number / 10)];
                            if ($number % 10 > 0) {
                                $words .= '-' . $units[$number % 10];
                            }
                        }
                    }

                    return trim($words);
                }
            @endphp
            <strong>{{ ucfirst(numberToWords($total)) }} ({{ number_format($total, 0, ',', ' ') }}) Francs
                CFA</strong>
        </p>

        <div style="border: 1px solid #000; padding: 10px; margin-top: 20px;">
            <strong>Modalité du règlement :</strong><br>
            (x) Virement au compte<br>
            ( ) Chèque de banque
        </div>
    </div>
</body>

</html>
