<?php

class InviteController extends Controller
{

    public function listerInvite()
    {
        $modInvite = $this->loadModel('Invite');
        $d['invites'] = $modInvite->find(array('conditions' => array('ID_ADHERENT' => Session::get('ID_ADHERENT'))));
        $this->set($d);
        $this->render('listerInvite');
    }

    public function creer()
    {
        $modInvite = $this->loadModel('Invite');
        $d['invite'] = $modInvite->find(array('conditions' => 1));
        $d['action'] = "nouveauInvite";
        $this->set($d);
        $this->render('creer');
    }

    public function nouveauInvite()
    {
        $modInvite = $this->loadModel('Invite');
        $donnees = array();
        $donnees["ID_ADHERENT"] = $_SESSION["ID_ADHERENT"];
        $donnees["NOM"] = $_POST["NOM"];
        $donnees["PRENOM"] = $_POST["PRENOM"];
        $donnees['STATUT'] = $_POST['STATUT'];
        $donnees["DATE_NAISSANCE"] = $_POST["DATE_NAISSANCE"];
        $donnees["TELEPHONE"] = $_POST["TELEPHONE"];

        $colonne = array('ID_ADHERENT', 'NOM', 'PRENOM', 'STATUT', 'DATE_NAISSANCE', 'TELEPHONE');
        $ID_PERS_EXTERIEUR = $modInvite->insertAI($colonne, $donnees);
        if (is_numeric($ID_PERS_EXTERIEUR)) {
            $d['info'] = "Invité créer";
            $d['invite'] = $modInvite->findFirst(array('conditions' => array('ID_PERS_EXTERIEUR' => $ID_PERS_EXTERIEUR)));
            $modInvite = $this->loadModel('Invite');
            $d['invite'] = $modInvite->find(array('conditions' => 1));
        } else {
            $d['info'] = "Erreur de traitement";
        }
        $this->set($d);
        $this->listerInvite();
        $this->render('listerInvite');
    }

    public function modifierInvite($id)
    {
        $modInvite = $this->loadModel('Invite');
        $donnees = array();
        $donnees["ID_ADHERENT"] = $_SESSION["ID_ADHERENT"];
        $donnees["NOM"] = $_POST["NOM"];
        $donnees["PRENOM"] = $_POST["PRENOM"];
        $donnees['STATUT'] = $_POST['STATUT'];
        $donnees["DATE_NAISSANCE"] = $_POST["DATE_NAISSANCE"];
        $donnees["TELEPHONE"] = ':' . $_POST["TELEPHONE"];
        $tab = array('conditions' => array('ID_PERS_EXTERIEUR' => $id), 'donnees' => $donnees);
        $modInvite->update($tab);
        $this->set($d);
        $this->listerInvite();
    }

    public function supprimer($id){
        $modInvite = $this->loadModel('Invite');
        $tab = array('conditions' => array('ID_PERS_EXTERIEUR' => $id));
        //appeler la methode delete
        $modInvite->delete($tab);
        $d['info'] = "Invité supprimé avec succès.";
        $this->set($d);
        $this->listerInvite();
    }

    public function modifier($id)
    {
        $modInvite = $this->loadModel('Invite');
        $d['invite'] = $modInvite->findFirst(array('conditions' => array('ID_PERS_EXTERIEUR' => $id)));;
        $d['action'] = "modifierInvite";
        $this->set($d);
        $this->render('creer');
    }


}
