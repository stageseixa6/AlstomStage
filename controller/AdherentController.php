<?php

class AdherentController extends Controller
{

    public function creer()
    {
        $modAdherent = $this->loadModel('Adherent');
        $d['adherent'] = $modAdherent->find(array('conditions' => 1));
        $this->set($d);
        $this->render('creer');

    }

    public function nouveauAdherent()
    {
        $modAdherent = $this->loadModel('Adherent');
        $donnees = array();
        $donnees["MAIL"] = $_POST["MAIL"];
        $password = 'achanger';

        $donnees["PASSWORD"] = password_hash($password, PASSWORD_DEFAULT);

        $donnees["NOM"] = $_POST["NOM"];
        $donnees["PRENOM"] = $_POST["PRENOM"];
        $donnees["GRADE"] = $_POST["GRADE"];
        $donnees["GENRE"] = $_POST["GENRE"];
        $donnees["MATRICULE"] = $_POST["MATRICULE"];
        $donnees["TELEPHONE"] = $_POST["TELEPHONE"];
        $donnees["MEMBRE_ACTIF"] = 1;
        $donnees["DATE_ADHESION"] = date("Y-m-d");
        $colonne = array('MAIL', 'PASSWORD', 'NOM', 'PRENOM', 'GRADE', 'GENRE', 'MATRICULE', 'TELEPHONE', 'MEMBRE_ACTIF', 'DATE_ADHESION');
        $ID_ADHERENT = $modAdherent->insertAI($colonne, $donnees);
        if (is_numeric($ID_ADHERENT)) {
            $d['info'] = "L'adhérent a été créé avec succès.";
        } else {
            $d['info'] = "Erreur de traitement";
        }
        $this->set($d);
        $this->liste();
    }

    function importer()
    {

        $modAdherent = $this->loadModel('Adherent');
        $adherents = $modAdherent->find(array('conditions' => 1));

        foreach ($adherents as $key) {

            if ($key->PASSWORD == '') {

                unset($donnees);
                 $encryptedpwd = password_hash('achanger', PASSWORD_DEFAULT);
                 $donnees['PASSWORD'] = $encryptedpwd;
                 $donnees = array('conditions' => "ID_ADHERENT = " . $key->ID_ADHERENT, 'donnees' => $donnees);
                 try {
                     $modAdherent->update($donnees);
                 } catch (Exception $ex) {
                     $ex->getCode() == 42000;
                 }
             }
             if ($key->GRADE == '') {
                 unset($donnees);
                 $donnees['GRADE'] = "M";
                 $donnees = array('conditions' => "ID_ADHERENT = " . $key->ID_ADHERENT, 'donnees' => $donnees);
                 try {
                     $modAdherent->update($donnees);
                 } catch (Exception $ex) {
                     $ex->getCode() == 42000;
                 }
             }
             if ($key->MEMBRE_ACTIF == '') {
                 unset($donnees);
                 $donnees['MEMBRE_ACTIF'] = 1;
                 $donnees = array('conditions' => "ID_ADHERENT = " . $key->ID_ADHERENT, 'donnees' => $donnees);
                 try {
                     $modAdherent->update($donnees);
                 } catch (Exception $ex) {
                     $ex->getCode() == 42000;
                 }
             }

        }

        $this->set($d);
        $this->liste();
        $this->render('liste');
    }

    public function liste()
    {
        $modAdherent = $this->loadModel('Adherent'); //instancier le modele 
        $d['adherent'] = $modAdherent->find(array('conditions' => 1, 'orderby' => "NOM"));
//fait un select * from tournois et met les donnés sous forme de tableau d'objet dans $d['tournois']
        //passer les informations à la vue qui s'appellera liste.php
        $this->set($d);
        $this->render('liste');
    }

    function detail($id)
    {
        $ID_ADHERENT = $id;
        $modAdherent = $this->loadModel('Adherent');
        $d['adherent'] = $modAdherent->findFirst(array('conditions' => array('ID_ADHERENT' => $ID_ADHERENT)));
        $this->set($d);
    }

    function modifier($id)
    {
        $ID_ADHERENT = $id;
        $modAdherent = $this->loadModel('Adherent');
        //recup les données du form
        $donnees = array();
        $donnees["MAIL"] = $_POST["MAIL"];
        $donnees["PASSWORD"] = $_POST["PASSWORD"];
        $donnees["GRADE"] = $_POST["GRADE"];
        $donnees["NOM"] = $_POST["NOM"];
        $donnees["PRENOM"] = $_POST["PRENOM"];
        $donnees["GENRE"] = $_POST["GENRE"];
        $donnees["MATRICULE"] = $_POST["MATRICULE"];
        $donnees["TELEPHONE"] = ':' . $_POST["TELEPHONE"];
        $donnees["MEMBRE_ACTIF"] = $_POST["MEMBRE_ACTIF"];
        $donnees["DATE_ADHESION"] = $_POST["DATE_ADHESION"];
        $tab = array('conditions' => array('ID_ADHERENT' => $ID_ADHERENT), 'donnees' => $donnees);
        //appeler la methode update
        $modAdherent->update($tab);
        $d['info'] = "Adhérent modifié";
        //charger le tableau 
        $d['adherent'] = $modAdherent->findFirst(array('conditions' => array('ID_ADHERENT' => $ID_ADHERENT)));
        $modAdherent = $this->loadModel('Adherent');
        $d['adherent'] = $modAdherent->find(array('conditions' => 1));
        $this->set($d);
        $this->render('liste');
    }

    function archiver()
    {
        $modAdherent = $this->loadModel('Adherent');
        if (isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $donnees = array();
            $donnees["DATE_DEPART"] = date("Y-m-d");
            $donnees["MEMBRE_ACTIF"] = 0;
            foreach ($ids as $id) {
                $tab = array('conditions' => "ID_ADHERENT = " . $id, 'donnees' => $donnees);
                try {
                    $modAdherent->update($tab);
                } catch (Exception $ex) {
                    $ex->getCode() == 42000;
                }
            }
            $this->liste();
            $this->render('liste');
        }
    }

    function consultercompte($message)
    {
        $d['info'] = $message;
        $this->set($d);
    }

    function modifiermdp()
    {
        $id = $_SESSION['ID_ADHERENT'];

        $modConnexion = $this->loadModel('Connexion');
        $condition = "ID ='" . $_POST["MAIL"];

        $currentpwd = $_POST['CURRENTPWD'];
        $confirmpwd = $_POST['CONFIRMPWD'];
        $newpwd = $_POST['NEWPWD'];
        $message = "";

        if (password_verify($currentpwd, $_SESSION['PASSWORD'])) {
            if (strlen($newpwd) < 3) {
                $message .= "Erreur : Le mot de passe que vous avez saisie est trop court.";
            } else if ($newpwd == $currentpwd) {
                $message .= "Erreur : Vous ne pouvez pas saisir le même mot de passe !";
            } else if ($newpwd != $confirmpwd) {
                $message .= "Erreur : Les mots de passe saisies ne correspondent pas.";
            } else {
                $modAdherent = $this->loadModel('Adherent');
                $encryptedpwd = password_hash($newpwd, PASSWORD_DEFAULT);
                $donnees['PASSWORD'] = $encryptedpwd;
                $donnees = array('conditions' => "ID_ADHERENT = " . $id, 'donnees' => $donnees);
                try {
                    $modAdherent->update($donnees);
                    Session::set('PASSWORD', $encryptedpwd);
                    $message .= "Votre mot de passe a été modifié avec succès.";
                } catch (Exception $ex) {
                    $ex->getCode() == 42000;
                }
            }
        } else {
            $message .= "Erreur : Le mot de passe saisie ne correspond pas à votre mot de passe actuel.";
        }
        $this->consultercompte($message);
        $this->render('consultercompte');

    }

    function modifiertel()
    {
        $id = $_SESSION['ID_ADHERENT'];
        $newtel = $_POST['TELEPHONE'];
        $message = "";

        $modAdherent = $this->loadModel('Adherent');
        $donnees['TELEPHONE'] = ':' . $newtel;
        $donnees = array('conditions' => "ID_ADHERENT = " . $id, 'donnees' => $donnees);
        try {
            $modAdherent->update($donnees);
            $_SESSION['TELEPHONE'] = $newtel;
        } catch (Exception $ex) {
            $ex->getCode() == 42000;
        }
        $this->consultercompte($message);
        $this->render('consultercompte');
    }

    function resetMdp($id){
        $modAdherent = $this->loadModel('Adherent');
        $encryptedpwd = password_hash('achanger', PASSWORD_DEFAULT);
        $donnees['PASSWORD'] = $encryptedpwd;
        $donnees = array('conditions' => "ID_ADHERENT = " . $id, 'donnees' => $donnees);
        try {
            $modAdherent->update($donnees);
        } catch (Exception $ex) {
            $ex->getCode() == 42000;
        }
        $d['info'] = 'Mot de passe réinitialisé avec succès. Nouveau mot de passe: achanger';
        $this->set($d);
        $this->liste();
    }

    /*function supprimer() {
        $modAdherent = $this->loadModel('Adherent');
        if (isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $where = '';
            foreach ($ids as $id) {
                $tab = array('conditions' => "ID_ADHERENT = " . $id);
                try {
                    $modAdherent->delete($tab);
                } catch (Exception $ex) {
                    $e->getCode() == 42000;
                }
            }
            $this->liste();
            $this->render('liste');
        }
    }*/

}
