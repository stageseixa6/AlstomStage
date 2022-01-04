<?php

class ActiviteLeaderController extends Controller
{

    function creer()
    {
        $modActivite = $this->loadModel('ActiviteLeader');
        $modPrestataire = $this->loadModel('Prestataire');
        $d['activite'] = $modActivite->find(array('conditions' => 1));
        $d['action'] = "creer";
        $projection = "ID,NOM";
        $params = array('projection' => $projection);
        $d['prestataires'] = $modPrestataire->find($params);
        $this->set($d);
    }

    //méthode créer
    function nouveau($id)
    {
        $modActivite = $this->loadModel('ActiviteLeader');
//recup les données du formulaire
        $donnees = array();
        $donnees["COUT_ADULTE"] = 0;
        $donnees["COUT_ENFANT"] = 0;
        $donnees["TARIF_FORFAIT"] = 0;
        $donnees["ID_DOMAINE"] = 1;
        $donnees["ID_LEADER"] = $_SESSION['ID_ADHERENT'];
        $donnees["ID_PRESTATAIRE"] = $_POST["ID_PRESTATAIRE"];
        $donnees["NOM"] = $_POST["NOM"];
        $donnees["DETAIL"] = $_POST["DETAIL"];
        $donnees["DATE_CREATION"] = date("Y-m-d");
        $donnees["ADRESSE"] = $_POST["ADRESSE"];
        $donnees["VILLE"] = $_POST["VILLE"];
        $donnees["CP"] = $_POST["CP"];
        $donnees["INDICATION_PARTICIPANT"] = $_POST["INDICATION_PARTICIPANT"];
        $donnees["INFO_IMPORTANT_PARTICIPANT"] = $_POST["INFO_IMPORTANT_PARTICIPANT"];
        $donnees["FORFAIT"] = $_POST["TYPE_FORFAIT"];
        if ($_POST["TYPE_FORFAIT"] == 'U') {
            // Choix "Unitaire"

            $donnees["COUT_ADULTE"] = $_POST["COUT_ADULTE"];
            if ($_POST["OUVERT_ENFANT"] == 1) {
                $donnees["COUT_ENFANT"] = $_POST["COUT_ENFANT"];
            }
        } else {
            // Choix "Forfait"
            $donnees["TARIF_FORFAIT"] = $_POST["TARIF_FORFAIT"];
            // TODO: Ajouter le coût et re vérifier la requête
        }

        if ($_POST["OUVERT_ENFANT"] == 0) {
            $donnees["AGE_MINIMUM"] = 18;

        } else {
            $donnees["AGE_MINIMUM"] = $_POST["AGE_MINIMUM"];

        }
        $donnees["OUVERT_EXT"] = $_POST["OUVERT_EXT"];
        $donnees["STATUT"] = 'A';

        $colonnes = array('COUT_ADULTE', 'COUT_ENFANT', 'TARIF_FORFAIT', 'ID_DOMAINE', 'ID_LEADER', 'ID_PRESTATAIRE', 'NOM', 'DETAIL', 'DATE_CREATION', 'ADRESSE', 'VILLE', 'CP', 'INDICATION_PARTICIPANT', 'INFO_IMPORTANT_PARTICIPANT', 'FORFAIT', 'AGE_MINIMUM', 'OUVERT_EXT', 'STATUT');
//appeler la méthode insertAI

        $ID_ACTIVITE = $modActivite->insertAI($colonnes, $donnees);
        if (is_numeric($ID_ACTIVITE)) {
            $d['info'] = "La création de l'activité " . $donnees["NOM"] . " a été effectuée";
            // $d['activite'] = $modActivite->findFirst(array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE)));
            //$modActivite = $this->loadModel('ActiviteLeader');
            //$modCreneau = $this->loadModel('ActiviteCreneauAdmin');
            //$d['activite'] = $modActivite->find(array('conditions' => 1));
            // $d['creneau'] = $modCreneau->find(array('conditions' => 1));
        } else {
            $d['info'] = "Problème pour créer l'activité";
        }
//dans tous les cas
//charger le tableau
        $this->set($d);
        $this->formulaireCreneau($ID_ACTIVITE);
    }

    /*   function modifier($id)
       {
           $ID_ACTIVITE = $id;
           $modActivite = $this->loadModel('ActiviteLeader');
           //recup les données du form
           $donnees = array();
           //$donnees["ID_DOMAINE"] = 1;

           $donnees["NOM"] = $_POST["NOM"];
           $donnees["DETAIL"] = $_POST["DETAIL"];

           $donnees["ADRESSE"] = $_POST["ADRESSE"];
           $donnees["CP"] = $_POST["CP"];
           $donnees["VILLE"] = $_POST["VILLE"];
           $donnees["INDICATION_PARTICIPANT"] = $_POST["INDICATION_PARTICIPANT"];
           $donnees["INFO_IMPORTANT_PARTICIPANT"] = $_POST["INFO_IMPORTANT_PARTICIPANT"];
           $donnees["STATUT"] = $_POST["STATUT"];
           $donnees["ID_PRESTATAIRE"] = $_POST["ID_PRESTATAIRE"];
           $donnees["FORFAIT"] = $_POST["TYPE_FORFAIT"];
           $donnees["COUT_ADULTE"] = $_POST["COUT_ADULTE"];


           $donnees["TARIF_FORFAIT"] = $_POST["TARIF_FORFAIT"];
           $donnees["COUT_ENFANT"] = $_POST["COUT_ENFANT"];
           $donnees["AGE_MINIMUM"] = $_POST["AGE_MINIMUM"];
           $donnees["OUVERT_EXT"] = $_POST["OUVERT_EXT"];
           $donnees["PRIX_ADULTE"] = $_POST["PRIX_ADULTE"];
           $donnees["PRIX_ADULTE_EXT"] = $_POST["PRIX_ADULTE_EXT"];
           $donnees["PRIX_ENFANT"] = $_POST["PRIX_ENFANT"];

           $donnees["PRIX_ENFANT_EXT"] = $_POST["PRIX_ENFANT_EXT"];


           $tab = array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE), 'donnees' => $donnees);
   //appeler la methode update
           $modActivite->update($tab);
           $d['info'] = "Activité modifié";
   //charger le tableau
           $this->set($d);
           $this->liste();
           $this->render('liste');
       }*/

    function inscrits($id)
    {
        /*  $modInscription = $this->loadModel('ActiviteParticipantsLeader');

          $adinfo = $modInscription->find($projection);

          $modInvites = $this->loadModel('ActiviteParticipants');
          $projection['projection'] = "INVITE.PRENOM,INVITE.NOM";

          foreach ($adinfo as $i) {
              $projection['conditions'] = "INSCRIPTION.ID_ACTIVITE = {$id} AND INSCRIPTION.CRENEAU = {$i->CRENEAU}";
              $invites = $modInvites->find($projection);
              foreach ($invites as $p) {
                  $listeinvites[] = array('NOM' => $p->NOM, 'PRENOM' => $p->PRENOM);
              }
              $participants[] = array('ID_ACTIVITE' => $id, 'CRENEAU' => $i->CRENEAU, 'MONTANT' => $i->MONTANT, 'PRENOM' => $i->PRENOM, 'NOM' => $i->NOM, 'AUTO_PARTICIPATION' => $i->AUTO_PARTICIPATION,
                  'LISTE_INVITE' => $listeinvites);

          }

          $d['donnees'] = $participants;*/
        $modInscription = $this->loadModel('ActiviteParticipantsLeader');
        $projection['projection'] = 'INSCRIPTION.DATE_PAIEMENT, INSCRIPTION.ID, CRENEAU.DATE_CRENEAU, CRENEAU.HEURE_CRENEAU,INSCRIPTION.PAYE, INSCRIPTION.CRENEAU, INSCRIPTION.ID_ADHERENT, MONTANT, AUTO_PARTICIPATION, INSCRIPTION.ID_ACTIVITE, ADHERENT.NOM as ADN, ADHERENT.PRENOM as ADP, GROUP_CONCAT(INVITE.NOM, " ", INVITE.PRENOM separator "<br>") as INN';
        $projection['conditions'] = "INSCRIPTION.ID_ACTIVITE = {$id}";
        $projection['groupby'] = "ID_ADHERENT";
        $result = $modInscription->find($projection);
        $d['inscrits'] = $result;
        $this->set($d);
        $this->render('inscrits');

    }

    function detail($id)
    {
        $ID_ACTIVITE = $id;
        $modActivite = $this->loadModel('ActiviteLeader');
        $d['activite'] = $modActivite->findFirst(array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE)));
        // requete 2 pour récupérer le nom
        $modNomLeader = $this->loadModel('NomLeader');
        $projection ['projection'] = "ADHERENT.NOM as NOMLEADER, ADHERENT.PRENOM as PRENOMLEADER";
        $projection['conditions'] = "ID_ACTIVITE = " . $ID_ACTIVITE;
        // $d['nomleader'] = $modNomLeader->findfirst($projection);
        $d['leader'] = $modNomLeader->findfirst($projection);
        // prestataires
        $modPrestataire = $this->loadModel('Prestataire');
        $projection = "ID,NOM";
        $params = array('projection' => $projection);
        $d['prestataires'] = $modPrestataire->find($params);
        $this->set($d);
    }

    public function gerer($id)
    {

        // Récupérer l'adhérent et l'activité associé.
        $modInscription = $this->loadModel('Inscription');
        $projection['projection'] = 'CRENEAU, ID, ID_ACTIVITE, ID_ADHERENT, PAYE, DATE_PAIEMENT';
        $projection['conditions'] = "ID = " . $id;
        $d['donnees'] = $modInscription->findfirst($projection);

        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');
        $projection['projection'] = 'NUM_CRENEAU, DATE_CRENEAU, HEURE_CRENEAU';
        $projection['conditions'] = "STATUT = 'O' AND ID_ACTIVITE = ". $d['donnees']->ID_ACTIVITE;
        $d['creneaux'] = $modCreneau->find($projection);


        // Rendu du formulaire
        $this->set($d);
        $this->render('gerer');


    }

    function modifier($id)
    {
        $ID_ACTIVITE = $id;
        $modActivite = $this->loadModel('ActiviteAdmin');
        //recup les données du form
        $donnees = array();
        $donnees["ID_DOMAINE"] = 1;
        $donnees["NOM"] = $_POST["NOM"];
        $donnees["DETAIL"] = $_POST["DETAIL"];

        $donnees["ADRESSE"] = $_POST["ADRESSE"];
        $donnees["CP"] = $_POST["CP"];
        $donnees["VILLE"] = $_POST["VILLE"];
        $donnees["INDICATION_PARTICIPANT"] = $_POST["INDICATION_PARTICIPANT"];
        $donnees["INFO_IMPORTANT_PARTICIPANT"] = $_POST["INFO_IMPORTANT_PARTICIPANT"];
        //$donnees["STATUT"] = $_POST["STATUT"];
        $donnees["ID_PRESTATAIRE"] = $_POST["ID_PRESTATAIRE"];
        $donnees["FORFAIT"] = $_POST["TYPE_FORFAIT"];
        $donnees["COUT_ADULTE"] = $_POST["COUT_ADULTE"];

        $donnees["TARIF_FORFAIT"] = $_POST["TARIF_FORFAIT"];
        $donnees["COUT_ENFANT"] = $_POST["COUT_ENFANT"];

        if($_POST["OUVERT_ENFANT"] == 1){
            $donnees["AGE_MINIMUM"] = $_POST["AGE_MINIMUM"];
        }else{
            $donnees["AGE_MINIMUM"] = 18;
        }

        $donnees["OUVERT_EXT"] = $_POST["OUVERT_EXT"];

        $tab = array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE), 'donnees' => $donnees);
//appeler la methode update
        $modActivite->update($tab);
        $d['info'] = "Activité modifié";
//charger le tableau
        $this->liste();
        $this->render('liste');
    }

//    public function liste() {
//        $modActiviteLeader = $this->loadModel('ActiviteLeader'); //instancier le modele 
//        $d['activiteleader'] = $modActiviteLeader->find(array('conditions' => 1));
//        $this->set($d);
//    }
    public function liste()
    {
        $modActiviteLeader = $this->loadModel('ActiviteLeader'); //instancier le modele 
        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');
        $projection['projection'] = "ID_LEADER,ID_ACTIVITE,ID_PRESTATAIRE,NOM,DETAIL,ADRESSE,CP,VILLE,INDICATION_PARTICIPANT,INFO_IMPORTANT_PARTICIPANT,AGE_MINIMUM,FORFAIT,TARIF_FORFAIT,TARIF_UNIT,OUVERT_EXT,COUT_ADULTE,COUT_ENFANT,STATUT";
        $projection['conditions'] = "ID_LEADER = " . $_SESSION['ID_ADHERENT'];
        $d['leader'] = array("leader", $projection['conditions']);
        $d['activite'] = $modActiviteLeader->find($projection);
        $d['creneau'] = $modCreneau->find(array('conditions' => 1));

        //passer les informations à la vue qui s'appellera liste.php
        $this->set($d);
//methode pour afficher le formulaire de création du tournois


        /* function supprimer($id){

          $modActivite=$this->loadModel('ActiviteLeader');
          //recup les données du formulaire
          if (isset($_POST['ids'])) {
          $ids = $_POST['ids'];
          foreach ($ids as $id) {
          $tab=array('conditions'=> 'ID_ACTIVITE = '.$id);
          $modActivite->delete($tab);

          }
          try {
          $modActivite->delete($tab);
          } catch (PDOException $e) {
          $info = $info . "<br>Erreur";

          }
          }
          $this-> liste();
          $this->render('liste');
          }
         * 
         */
    }


    function formulaireCreneau($id)
    {
        $modActivite = $this->loadModel('ActiviteAdmin');
        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');
        if (strpos($id, '_') !== FALSE) {
            $ids = explode("_", $id);
            // NUM_ACTIVITE : $ids[1]
            $ID_ACTIVITE = $ids[0];
            $NUM_CRENEAU = $ids[1];
            $d['creneauP'] = $modCreneau->find(array('conditions' => array('CRENEAU.NUM_CRENEAU' => $NUM_CRENEAU, 'CRENEAU.ID_ACTIVITE' => $ID_ACTIVITE)));
        } else {
            $ID_ACTIVITE = $id;
        }
        $d['activite'] = $modActivite->findFirst(array('conditions' => array('ACTIVITE.ID_ACTIVITE' => $ID_ACTIVITE)));
        $d['creneauG'] = $modCreneau->find(array('conditions' => array('CRENEAU.ID_ACTIVITE' => $ID_ACTIVITE)));
        $this->set($d);
        $this->render('formulaireCreneau');
    }

    function creerCreneau($id)
    {
        $ID_ACTIVITE = $id;

        //$modActivite = $this->loadModel('ActiviteAdmin');
        $donnees["ID_ACTIVITE"] = $ID_ACTIVITE;
        $donnees["DATE_CRENEAU"] = $_POST['DATE_CRENEAU'];
        $donnees["HEURE_CRENEAU"] = $_POST['HEURE_CRENEAU'];
        $donnees["DATE_PAIEMENT"] = $_POST['DATE_PAIEMENT'];
        $donnees["EFFECTIF_CRENEAU"] = $_POST["EFFECTIF_CRENEAU"];
        $donnees["STATUT"] = 'A';

        // Récupération du nombre de créneau pour une activité
        $modActivite = $this->loadModel('ActiviteAdmin');
        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');
        $proj['activite'] = $modActivite->findFirst(array('conditions' => array('ACTIVITE.ID_ACTIVITE' => $ID_ACTIVITE)));
        $proj['creneau'] = $modCreneau->find(array('conditions' => array('CRENEAU.ID_ACTIVITE' => $ID_ACTIVITE)));
        $nbCreneau = 0;
        foreach ($proj['creneau'] as $c) {
            $nbCreneau = $nbCreneau + 1;
        }
        $donnees["NUM_CRENEAU"] = $nbCreneau + 1;

        $colonnes = array('ID_ACTIVITE', 'DATE_CRENEAU', 'HEURE_CRENEAU', 'DATE_PAIEMENT', 'EFFECTIF_CRENEAU', 'STATUT', 'NUM_CRENEAU');
        //appeler la méthode insert
        $modCreneau->insert($colonnes, $donnees);

        $this->liste();
        //$this->redirect('liste');
        header('Location: ../liste');
    }

    function modifierCreneau($id)
    {
        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');

        $ids = explode("_", $id);
        $ID_ACTIVITE = $ids[0];
        $NUM_CRENEAU = $ids[1];

        //$modActivite = $this->loadModel('ActiviteAdmin');
        $donnees["ID_ACTIVITE"] = $ID_ACTIVITE;
        $donnees["DATE_CRENEAU"] = $_POST['DATE_CRENEAU'];
        $donnees["HEURE_CRENEAU"] = $_POST['HEURE_CRENEAU'];
        $donnees["EFFECTIF_CRENEAU"] = $_POST["EFFECTIF_CRENEAU"];
        $donnees["STATUT"] = $_POST["STATUT"];
        $donnees["COMMENTAIRE"] = $_POST["COMMENTAIRE"];
        $colonnes = array('ID_ACTIVITE', 'DATE_CRENEAU', 'HEURE_CRENEAU', 'EFFECTIF_CRENEAU', 'STATUT', 'NUM_CRENEAU', 'COMMENTAIRE');
        $tab = array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE, 'NUM_CRENEAU' => $NUM_CRENEAU), 'donnees' => $donnees);
        //appeler la methode update
        $modCreneau->update($tab);
        $this->liste();
        header('Location: ../liste');
    }

    function supprimerCreneau($id)
    {
        if ($id != FALSE) {
            $modCreneau = $this->loadModel('ActiviteCreneauAdmin');
            $ids = explode("_", $id);
            $ID_ACTIVITE = $ids[0];
            $NUM_CRENEAU = $ids[1];
            //$modActivite = $this->loadModel('ActiviteAdmin');
            $tab = array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE, 'NUM_CRENEAU' => $NUM_CRENEAU));
            //appeler la methode delete
            $modCreneau->delete($tab);
        }
        $this->liste();
        header('Location: ../liste');
    }

    function ouvrir($id)
    {
        if ($id != FALSE) {
            $modActivite = $this->loadModel("ActiviteLeader");
            $donnees["STATUT"] = 'O';
            $tab = array('conditions' => array('ID_ACTIVITE' => $id), 'donnees' => $donnees);
            $modActivite->update($tab);

        }
        $this->liste();
        $this->render('liste');
    }

    public function paye($id)
    {
        // Récupérer l'adhérent et l'activité associé.
        $modInscription = $this->loadModel('Inscription');
        $projection['projection'] = 'ID_ACTIVITE, ID_ADHERENT';
        $projection['conditions'] = "ID = " . $id;
        $infoi = $modInscription->findfirst($projection);

        $donnees["PAYE"] = 1;
        $donnees["DATE_PAIEMENT"] = date("Y-m-d");
        $tab = array('conditions' => array('ID_ADHERENT' => $infoi->ID_ADHERENT, 'ID_ACTIVITE' => $infoi->ID_ACTIVITE), 'donnees' => $donnees);
        $modInscription->update($tab);

        $d['info'] = "Le paiement de l'adhérent a été validé avec succès.";
        $this->set($d);
        $this->gerer($id);
    }
    public function deplacerCreneau($id){

        // Récupérer l'adhérent et l'activité associé.
        $modInscription = $this->loadModel('Inscription');
        $projection['projection'] = 'ID_ACTIVITE, ID_ADHERENT';
        $projection['conditions'] = "ID = " . $id;
        $infoi = $modInscription->findfirst($projection);

        $donnees["CRENEAU"] = $_POST["CRENEAU"];
        $tab = array('conditions' => array('ID' => $id), 'donnees' => $donnees);
        $modInscription->update($tab);

        $d['info'] = "Le créneau de l'adhérent a été déplacé avec succès.";
        $this->set($d);
        $this->gerer($id);

    }

    public function desinscrire($id){
        $modInscription = $this->loadModel('Inscription');
        $projection['projection'] = 'ID_ACTIVITE, ID_ADHERENT';
        $projection['conditions'] = "ID = " . $id;
        $infoi = $modInscription->findfirst($projection);

        $tab = array('conditions' => array('ID' => $id));
        $modInscription->delete($tab);

        $d['info'] = "L'adhérent a été désinscrit avec succès.";
        $this->set($d);
        $this->inscrits($infoi->ID_ACTIVITE);

    }
}

