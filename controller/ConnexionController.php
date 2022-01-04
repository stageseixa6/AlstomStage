<?php

class ConnexionController extends Controller
{

    public function connexion()
    {
        $modConnexion = $this->loadModel('Connexion');
        $this->render('connexion');
    }

    public function authentification()
    {
        if (isset($_POST["MAIL"]) && (isset($_POST["PASSWORD"]))) {

            //


            //

            $modConnexion = $this->loadModel('Connexion');
            $condition = "MAIL ='" . $_POST["MAIL"] . "'";
            $params = array('conditions' => $condition);
            try {
                if ($modConnexion->findfirst($params) != '') {

                    $d['connexion'] = $modConnexion->findfirst($params);
                    //$d['info'] .= '<br>Mot de passe chiffré : ' . $d['connexion']->PASSWORD . '<br>non chiffré : ' . $_POST["PASSWORD"];
                    if (password_verify($_POST["PASSWORD"], $d['connexion']->PASSWORD)) {
                        Session::set('ID_ADHERENT', $d['connexion']->ID_ADHERENT);
                        Session::set('MAIL', $d['connexion']->MAIL);
                        Session::set('PASSWORD', $d['connexion']->PASSWORD);
                        Session::set('GRADE', $d['connexion']->GRADE);
                        Session::set('NOM', $d['connexion']->NOM);
                        Session::set('PRENOM', $d['connexion']->PRENOM);
                        Session::set('GENRE', $d['connexion']->GENRE);
                        Session::set('MATRICULE', $d['connexion']->MATRICULE);
                        Session::set('TELEPHONE', $d['connexion']->TELEPHONE);
                        Session::set('MEMBRE_ACTIF', $d['connexion']->MEMBRE_ACTIF);
                        Session::set('DATE_ADHESION', $d['connexion']->DATE_ADHESION);
                        Session::set('DATE_DEPART', $d['connexion']->DATE_DEPART);
                        $this->set($d);
                        $this->render('accueil');

                    } else {
                        $d['info'] .= "Nom d'utilisateur ou mot de passe incorrect.";
                        $this->set($d);
                        $this->connexion();
                    }


                } else {
                    $d['info'] .= "Erreur d'authentification";
                    $this->set($d);
                    $this->render('connexion');
                }
            } catch (PDOException $e) {

            }
        } else {
            $this->set($d);
            $this->connexion();
        }
    }

    function accueil()
    {
        if (empty(Session::get('GRADE'))) {
            $this->connexion();
        }
    }

    function deconnexion()
    {
        session_destroy();
        header('Location: connexion/connexion');
        $this->render('connexion');
    }

    public function changepassword()
    {
        $this->render('changepassword');
    }

    function changepwd()
    {
        $id = Session::get('ID_ADHERENT');
        // $currentpwd = Session::get('PASSWORD');
        $confirmpwd = $_POST['CONFIRMPWD'];
        $newpwd = $_POST['NEWPWD'];
        $message = "";


        if (strlen($newpwd) < 3) {
            $message .= "Erreur : Le mot de passe que vous avez saisie est trop court.";
        } else if ($newpwd == 'achanger') {
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
        $this->accueil();
        $this->render('accueil');
    }

}
