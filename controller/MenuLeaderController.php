<?php

class MenuLeaderController extends Controller {

    function verif_statut() {
        if (isset($_SESSION['GRADE'])) {
            if ($_SESSION['GRADE'] == 'L') {
                return true;
            }
        } else {
            return false;
        }
    }
    
    function accueil() {
    //    if ($this->verif_statut() == true) {
            Session::set('STATUT_TMP','Leader' );
            //$this->set($d);
            $this->render('../accueil/detail');
    //    } else {
    //        $this->render('../connexion/accueil');
    //    }

    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

