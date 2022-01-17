<?php

class ActiviteAdminController extends Controller {

    public function liste() {
        $modActivite = $this->loadModel('ActiviteAdmin'); //instancier le modele 
        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');
        $projection['projection'] = "ID_LEADER,ID_ACTIVITE,NOM,DETAIL,ADRESSE,CP,VILLE,INDICATION_PARTICIPANT,INFO_IMPORTANT_PARTICIPANT,
        AGE_MINIMUM,FORFAIT,TARIF_FORFAIT,TARIF_UNIT,OUVERT_EXT,COUT_ADULTE,COUT_ENFANT,STATUT,DATE_CREATION,PRIX_ADULTE,
        PRIX_ENFANT,PRIX_ADULTE_EXT,PRIX_ENFANT_EXT";
        $d['activite'] = $modActivite->find($projection);
        $d['creneau'] = $modCreneau->find(array('conditions' => 1));
        $this->set($d);
    }

    function detail($id) {
        $ID_ACTIVITE = $id;
        $modActivite = $this->loadModel('ActiviteAdmin');
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

    function modifier($id) {
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
        $donnees["STATUT"] = $_POST["STATUT"];
        $donnees["ID_PRESTATAIRE"] = $_POST["ID_PRESTATAIRE"];
        $donnees["FORFAIT"] = $_POST["TYPE_FORFAIT"];
        $donnees["COUT_ADULTE"] = $_POST["COUT_ADULTE"];


        $donnees["TARIF_FORFAIT"] = $_POST["TARIF_FORFAIT"];
        $donnees["COUT_ENFANT"] = $_POST["COUT_ENFANT"];
        $donnees["AGE_MINIMUM"] = $_POST["AGE_MINIMUM"];
        $donnees["OUVERT_EXT"] = $_POST["OUVERT_EXT"];
        if(isset($_POST["PRIX_ADULTE"])) {
            $donnees["PRIX_ADULTE"] = $_POST["PRIX_ADULTE"];
            var_dump($_POST["PRIX_ADULTE"]);
        }
        else{
            $donnees["PRIX_ADULTE"] = $_POST["COUT_ADULTE"];
        }
        if($_POST["PRIX_ADULTE_EXT"]!='') {
            $donnees["PRIX_ADULTE_EXT"] = $_POST["PRIX_ADULTE_EXT"];
            var_dump($_POST["PRIX_ADULTE_EXT"]);
        }
        else{
            $donnees["PRIX_ADULTE_EXT"] = 0;
        }
        if($_POST["PRIX_ENFANT"]!='') {
            $donnees["PRIX_ENFANT"] = $_POST["PRIX_ENFANT"];
        }
        else{
            $donnees["PRIX_ENFANT"] = 0;
        }
        if($_POST["PRIX_ENFANT_EXT"]!='') {
            $donnees["PRIX_ENFANT_EXT"] = $_POST["PRIX_ENFANT_EXT"];
        }
        else{
            $donnees["PRIX_ENFANT_EXT"] = 0;
        }


        $tab = array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE), 'donnees' => $donnees);
//appeler la methode update
        $modActivite->update($tab);
        $d['info'] = "Activité modifié";
//charger le tableau
        $this->liste();
        $this->render('liste');
    }

    function archivage($id) {

        $modActivite = $this->loadModel('ActiviteAdmin');
//recup les données du formulaire
        if (isset($_POST['ids'])) {
            $donnees = array();
            $donnees['STATUT'] = 'F';
            $ids = $_POST['ids'];
            foreach ($ids as $id) {
                $tab = array('conditions' => 'ID_ACTIVITE = ' . $id, 'donnees' => $donnees);
                try {
                    $modActivite->update($tab);
                } catch (PDOException $e) {
                    $info .= "<br>Erreur";
                }
            }

        }
        $this->liste();
        $this->render('liste');
    }

    function formulaireCreneau($id) {
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
    }

    function creerCreneau($id) {
        $ID_ACTIVITE = $id;

        //$modActivite = $this->loadModel('ActiviteAdmin');
        $donnees["ID_ACTIVITE"] = $ID_ACTIVITE;
        $donnees["DATE_CRENEAU"] = $_POST['DATE_CRENEAU'];
        $donnees["HEURE_CRENEAU"] = $_POST['HEURE_CRENEAU'];
        if(isset($_POST['DATE_PAIEMENT'])) {
            $donnees["DATE_PAIEMENT"] = $_POST['DATE_PAIEMENT'];
        }
        else{
            $donnees["DATE_PAIEMENT"] = '2000-01-01';
        }
        $donnees["EFFECTIF_CRENEAU"] = $_POST["EFFECTIF_CRENEAU"];
        $donnees["COMMENTAIRE"] = "";
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

        var_dump($donnees);
        $colonnes = array('ID_ACTIVITE', 'DATE_CRENEAU', 'HEURE_CRENEAU', 'DATE_PAIEMENT', 'EFFECTIF_CRENEAU', 'COMMENTAIRE', 'STATUT', 'NUM_CRENEAU' );
        //appeler la méthode insert
        $modCreneau->insert($colonnes, $donnees);

        $this->liste();
        //$this->redirect('liste');
        header('Location: ../liste');
    }

    function modifierCreneau($id) {
        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');

        $ids = explode("_", $id);
        $ID_ACTIVITE = $ids[0];
        $NUM_CRENEAU = $ids[1];

        $modActivite = $this->loadModel('ActiviteAdmin');
        $donnees["ID_ACTIVITE"] = $ID_ACTIVITE;
        $donnees["DATE_CRENEAU"] = $_POST['DATE_CRENEAU'];
        $donnees["HEURE_CRENEAU"] = $_POST['HEURE_CRENEAU'];
        $donnees["EFFECTIF_CRENEAU"] = $_POST["EFFECTIF_CRENEAU"];
        $donnees["STATUT"] = $_POST["STATUT"];
        $donnees["COMMENTAIRE"] = $_POST["COMMENTAIRE"];
        $colonnes = array('ID_ACTIVITE', 'DATE_CRENEAU', 'HEURE_CRENEAU', 'EFFECTIF_CRENEAU', 'STATUT', 'NUM_CRENEAU', 'COMMENTAIRE');
        $tab = array('conditions' => array('ID_ACTIVITE' => $ID_ACTIVITE, 'NUM_CRENEAU' => $NUM_CRENEAU), 'donnees' => $donnees);
        //appeler la methode update
//        $this->mailLeader($ID_ACTIVITE);
        $modCreneau->update($tab);
        $this->liste();
        header('Location: ../liste');
    }

    function supprimerCreneau($id) {
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

    function mailLeader($id){
        $modInscription = $this->loadModel('NomLeader');
        $projection['projection'] = 'ADHERENT.mail';
        $projection['conditions'] = "ACTIVITE.ID = {$id}";
        $result = $modInscription->find($projection);
        var_dump($id);
        var_dump($result);
    }

}
