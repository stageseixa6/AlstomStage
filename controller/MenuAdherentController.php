<?php

class MenuAdherentController extends Controller {

    //function verif_statut() {
    //    if (isset($_SESSION['GRADE'])) {
    //        return true;
    //    }
    //    return false;
    //}

    function accueil() {
    //    if ($this->verif_statut() == true) {
            Session::set('STATUT_TMP','Adherent' );
            //$this->set($d);
            $this->render('../accueil/detail');
    //    } else {
    //        $this->render('../connexion/accueil');
    //    }
    }

}
