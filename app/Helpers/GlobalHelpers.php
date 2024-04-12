<?php

// namespace App\Helpers;

use App\Models\Activite;
use App\Models\User;



    if(! function_exists('getLoggedUser')) {
        /**
         * Enregistrement d'un log
         *
         * @param string $action
         * @param int $user
         */
        function SaveLog(string $action, int $user=null){
            Activite::create([
                "action" => $action,
                "user_id" => $user
            ]);
        }
    }


    if(! function_exists('getLoggedUser')) {
    
       function getLoggedUser()
        {

            $user = new User();
            $user->id = 1;
            $user->nom = 'Bassia';
            $user->prenom = 'Théophile';
            $user->role = 'cellule_manager';
            $user->ministere = 'Ministere des transports';
            $user->poste = 'Chargé de mission';
            $user->telephone = '76555545';
            $user->email = 'bassiat@transport.gov';

            // if(Auth::user()){
            //     return Auth::user();
            // }
            return $user;
        }
    }
