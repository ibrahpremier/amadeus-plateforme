<?php

// namespace App\Helpers;

use App\Models\Activite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

 


  if (!function_exists('saveLog')) {
    /**
     * Enregistrement d'un log
     *
     * @param string $action
     * @param int $user
     */
    function SaveLog(string $action, int $user = null)
    {
        Activite::create([
            "action" => $action,
            "user_id" => $user
        ]);
    }

}



if (!function_exists('getLoggedUser')) {

    function getLoggedUser()
    {

        // $user = new User();
        // $user->id = 1;
        // $user->nom = 'Bassia';
        // $user->prenom = 'Théophile';
        // $user->role = 'cellule_manager';
        // $user->ministere = 'Ministere des transports';
        // $user->poste = 'Chargé de mission';
        // $user->telephone = '76555545';
        // $user->email = 'bassiat@transport.gov';

        if (Auth::user()) {
            return Auth::user();
        }
        return null;
    }
}


if (!function_exists('statusBg')) {
    function statusBg($status): string
    {
        switch ($status) {
            case 'nouveau':
                $color = 'bg-danger';
                break;
            case 'terminé':
                $color = 'bg-success';
                break;
            case 'traitement':
                $color = 'bg-secondary';
                break;
            case 'mission en cours':
                $color = 'bg-info';
                break;
            case 'approuvé':
                $color = 'bg-success';
                break;

            default:
                $color = 'bg-light';
                break;
        }
        return $color;
    }
}


if (!function_exists('getCapitalNames')) {

    function getCapitalNames()
    {
      return  [
        'Kabul',
        'Tirana',
        'Algiers',
        'Andorra la Vella',
        'Luanda',
        'Saint John\'s',
        'Buenos Aires',
        'Yerevan',
        'Canberra',
        'Vienna',
        'Baku',
        'Nassau',
        'Manama',
        'Dhaka',
        'Bridgetown',
        'Minsk',
        'Brussels',
        'Belmopan',
        'Porto-Novo',
        'Thimphu',
        'La Paz',
        'Sarajevo',
        'Gaborone',
        'Brasilia',
        'Bandar Seri Begawan',
        'Sofia',
        'Ouagadougou',
        'Gitega',
        'Phnom Penh',
        'Yaounde',
        'Ottawa',
        'Praia',
        'Bangui',
        'N\'Djamena',
        'Santiago',
        'Beijing',
        'Bogota',
        'Moroni',
        'Brazzaville',
        'Kinshasa',
        'San Jose',
        'Abidjan',
        'Zagreb',
        'Havana',
        'Nicosia',
        'Prague',
        'Copenhagen',
        'Djibouti',
        'Roseau',
        'Santo Domingo',
        'Dili',
        'Quito',
        'Cairo',
        'San Salvador',
        'Malabo',
        'Asmara',
        'Tallinn',
        'Addis Ababa',
        'Suva',
        'Helsinki',
        'Paris',
        'Libreville',
        'Banjul',
        'Tbilisi',
        'Berlin',
        'Accra',
        'Athens',
        'Saint George\'s',
        'Guatemala City',
        'Conakry',
        'Bissau',
        'Georgetown',
        'Port-au-Prince',
        'Tegucigalpa',
        'Budapest',
        'Reykjavik',
        'New Delhi',
        'Jakarta',
        'Tehran',
        'Baghdad',
        'Dublin',
        'Jerusalem*',
        'Rome',
        'Kingston',
        'Tokyo',
        'Amman',
        'Astana',
        'Nairobi',
        'Tarawa Atoll',
        'Pyongyang',
        'Seoul',
        'Pristina',
        'Kuwait City',
        'Bishkek',
        'Vientiane',
        'Riga',
        'Beirut',
        'Maseru',
        'Monrovia',
        'Tripoli',
        'Vaduz',
        'Vilnius',
        'Luxembourg',
        'Skopje',
        'Antananarivo',
        'Lilongwe',
        'Kuala Lumpur',
        'Male',
        'Bamako',
        'Valletta',
        'Majuro',
        'Nouakchott',
        'Port Louis',
        'Mexico City',
        'Palikir',
        'Chisinau',
        'Monaco',
        'Ulaanbaatar',
        'Podgorica',
        'Rabat',
        'Maputo',
        'Rangoon (Yangon)',
        'Windhoek',
        'no official capital',
        'Kathmandu',
        'Amsterdam',
        'Wellington',
        'Managua',
        'Niamey',
        'Abuja',
        'Oslo',
        'Muscat',
        'Islamabad',
        'Melekeok',
        'Panama City',
        'Port Moresby',
        'Asuncion',
        'Lima',
        'Manila',
        'Warsaw',
        'Lisbon',
        'Doha',
        'Bucharest',
        'Moscow',
        'Kigali',
        'Basseterre',
        'Castries',
        'Kingstown',
        'Apia',
        'San Marino',
        'Sao Tome',
        'Riyadh',
        'Dakar',
        'Belgrade',
        'Victoria',
        'Freetown',
        'Singapore',
        'Bratislava',
        'Ljubljana',
        'Honiara',
        'Mogadishu',
        'Pretoria (administrative)',
        'Juba',
        'Madrid',
        'Colombo',
        'Khartoum',
        'Paramaribo',
        'Mbabane',
        'Stockholm',
        'Bern',
        'Damascus',
        'Taipei',
        'Dushanbe',
        'Dar es Salaam',
        'Bangkok',
        'Lome',
        'Nuku\'alofa',
        'Port-of-Spain',
        'Tunis',
        'Ankara',
        'Ashgabat',
        'Vaiaku village, Funafuti province',
        'Kampala',
        'Kyiv',
        'Abu Dhabi',
        'London',
        'Washington, D.C.',
        'Montevideo',
        'Tashkent',
        'Port-Vila',
        'Vatican City',
        'Caracas',
        'Hanoi',
        'Sanaa',
        'Lusaka',
        'Harare',
      ];
    }
}
