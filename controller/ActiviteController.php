<?php

class ActiviteController extends Controller
{

    //Liste d'attente non fonctionelle
    /*
    public function positionListeAttente($numinscription)
    {
        $modActiviteInscrit = $this->loadModel('ActiviteInscrit');
        $req['projection'] = 'INSCRIPTION.ID_ADHERENT, INSCRIPTION.ID_ACTIVITE, INSCRIPTION.CRENEAU';
        $req['conditions'] = 'ID = ' . $numinscription;
        $infosinscription = $modActiviteInscrit->findfirst($req);

        $idactivite = $infosinscription->ID_ACTIVITE;
        $idadherent = $infosinscription->ID_ADHERENT;
        $creneau = $infosinscription->CRENEAU;


        $modActiviteInscritC = $this->loadModel('ActiviteParticipantsLeader');
        $req['projection'] = 'ROW_NUMBER() OVER(ORDER BY INSCRIPTION.ID) AS placeFile, INSCRIPTION.ID_ADHERENT as idadh, INVITE.ID_PERS_EXTERIEUR';
        $req['conditions'] = 'INSCRIPTION.ID_ACTIVITE = ' . $idactivite;
        $inscrits = $modActiviteInscritC->find($req);
        

        // Effectif
        $modActiviteInscritC = $this->loadModel('ActiviteInscriptionCreneau');

        $req['projection'] = 'CRENEAU.EFFECTIF_CRENEAU';
        $req['conditions'] = 'CRENEAU.ID_ACTIVITE = ' . $idactivite . ' AND CRENEAU.NUM_CRENEAU = ' . $creneau;
        $effectif = $modActiviteInscritC->findfirst($req)->EFFECTIF_CRENEAU;

        foreach($inscrits as $i)
        {
            if ($i->idadh == $idadherent)
            {
                $position = $i->placeFile;
                break;
            }
        }

        if($position < $effectif){
            return 0;
        }else{
            return $position - $effectif;
        }

    }
    */

// Lister les activités ouvertes aux adhérents
    public function listerActivite()
    {
        $modActivite = $this->loadModel('ListeActiviteOuverte'); //instancier le modele
        $projection = "ID_ACTIVITE,NOM,DETAIL,VILLE";
        $condition = 'STATUT = "O"';
        $params = array('projection' => $projection, 'conditions' => $condition);
        $d['activites'] = $modActivite->find($params);
        //passer les informations à la vue qui s'appellera liste.php
        $this->set($d);
    }

    function consulter($id)
    {
        $ID_ACTIVITE = $id;

        // requete 1
        $modActivite = $this->loadModel('ListeActiviteOuverte');
        $projection ['projection'] = "OUVERT_EXT, ACTIVITE.ID_ACTIVITE, ACTIVITE.ID_LEADER, ACTIVITE.NOM, ACTIVITE.DETAIL, ACTIVITE.ADRESSE, ACTIVITE.CP, ACTIVITE.VILLE, ACTIVITE.AGE_MINIMUM,ACTIVITE.PRIX_ADULTE,ACTIVITE.PRIX_ENFANT,ACTIVITE.PRIX_ADULTE_EXT,ACTIVITE.PRIX_ENFANT_EXT, ACTIVITE.INDICATION_PARTICIPANT, ACTIVITE.INFO_IMPORTANT_PARTICIPANT";
        $projection['conditions'] = "ID_ACTIVITE = " . $ID_ACTIVITE;
        $d['donnees'] = $modActivite->findfirst($projection);

        // requete 2 pour récupérer le nom
        $modNomLeader = $this->loadModel('NomLeader');
        $projection ['projection'] = "ADHERENT.NOM as NOMLEADER, ADHERENT.PRENOM as PRENOMLEADER";
        $projection['conditions'] = "ID_ACTIVITE = " . $ID_ACTIVITE;
        // $d['nomleader'] = $modNomLeader->findfirst($projection);
        $d['leader'] = $modNomLeader->findfirst($projection);

        // requete 3 pour récupérer la liste des créneau
        $modListeCreneau = $this->loadModel('ListeCreneau');
        $projection ['projection'] = "CRENEAU.NUM_CRENEAU, CRENEAU.DATE_CRENEAU, HEURE_CRENEAU, EFFECTIF_CRENEAU";
        $projection['conditions'] = "ID_ACTIVITE = " . $ID_ACTIVITE;

        // requete 4 pour récupérer la liste des participants par créneau

        $modInscription = $this->loadModel('ActiviteParticipantsAdherent');

        /*$projection['projection'] =
            'c.DATE_CRENEAU, 
    c.HEURE_CRENEAU, 
    c.EFFECTIF_CRENEAU,
    GROUP_CONCAT(inv.NOM, " ", inv.PRENOM SEPARATOR "<br>") as listeinv,
	CASE 
    	WHEN AUTO_PARTICIPATION=1 THEN GROUP_CONCAT(DISTINCT a.NOM, " ", a.PRENOM SEPARATOR "<br>") 
    END as adh,
    CASE 
    	WHEN AUTO_PARTICIPATION=1 THEN COUNT(DISTINCT i.ID) + COUNT(li.ID_INVITE)
    	ELSE COUNT(li.ID_INVITE)
    END as effectif';*/
        $projection['projection'] = 'i.DATE_PAIEMENT, i.ID, c.DATE_CRENEAU, c.HEURE_CRENEAU,c.EFFECTIF_CRENEAU,
i.PAYE, i.CRENEAU, i.ID_ADHERENT, 
MONTANT, AUTO_PARTICIPATION, i.ID_ACTIVITE, 
GROUP_CONCAT(a.NOM, a.PRENOM) as adh, 
GROUP_CONCAT(inv.NOM, " ", inv.PRENOM separator "<br>") as listeinv,
COUNT(DISTINCT i.ID) + COUNT(li.ID_INVITE)as effectif';
        /*$projection['conditions'] = "i.ID_ACTIVITE = {$id}";
        //$projection['groupby'] = "ID_ADHERENT";
        $result = $modInscription->find($projection);
        $d['inscrits'] = $result;
        $this->set($d);*/

        $projection['conditions'] = "c.ID_ACTIVITE = {$id} AND c.STATUT = 'O' AND i.ATTENTE = 0";

        $projection['groupby'] = "c.NUM_CRENEAU, c.ID_ACTIVITE";
        $result = $modInscription->find($projection);
        $d['inscrits'] = $result;
        $this->set($d);

    }


    public function formulaireInscription($id)
    {
        $ID_ACTIVITE = $id;
        $modActivite = $this->loadModel('ListeActiviteOuverte');
        $projection['conditions'] = "ID_ACTIVITE = " . $ID_ACTIVITE;
        $d['donnees'] = $modActivite->findfirst($projection);
        //Verification inscription
        $modActivite = $this->loadModel('Inscription');
        $projection['conditions'] = "ID_ACTIVITE = " . $ID_ACTIVITE . " AND ID_ADHERENT = " . Session::get('ID_ADHERENT');
        $d['inscription'] = $modActivite->findfirst($projection);

        // Récupération de la liste des invités.


        $modInvite = $this->loadModel('Invite');
        $projection['conditions'] = "STATUT = 'FAMILLE' AND ID_ADHERENT = " . Session::get('ID_ADHERENT');
        $d['invitesfamille'] = $modInvite->find($projection);

        $projection['conditions'] = "STATUT = 'EXTERNE' AND ID_ADHERENT = " . Session::get('ID_ADHERENT');
        $d['invitesext'] = $modInvite->find($projection);

        // Récupération des créneaux.
        $modCreneau = $this->loadModel('ActiviteCreneauAdmin');
        $projection['conditions'] = "ID_ACTIVITE = {$id} AND STATUT = 'O'";
        $projection['orderby'] = "DATE_CRENEAU, HEURE_CRENEAU";
        $d['creneaux'] = $modCreneau->find($projection);


        $this->set($d);
    }

// Permet de savoir si le même invité a été renseigné plus d'une fois.
    function has_dupes($array)
    {
        $dupe_array = array();
        foreach ($array as $val) {
            if (++$dupe_array[$val] > 1) {
                return true;
            }
        }
        return false;
    }

    function getAge($date)
    {
        $dob = new DateTime($date);
        $now = new DateTime();
        $difference = $now->diff($dob);
        $age = $difference->y;
        return $age;
    }

    function calculMontant($activite, $participation, $invites)
    {


        $modInvite = $this->loadModel("Invite");
        // Récupération des prix de l'activité:
        $modActivite = $this->loadModel("ActiviteLeader");
        $projection['conditions'] = "ID_ACTIVITE = " . $activite;
        $infosActivite = $modActivite->findfirst($projection);

        $montant = 0;


        if (isset($invites)) {
            foreach ($invites as $inv) {
//                echo "invites=";
//                var_dump($invites);
//                echo "nouvel invité";
//                var_dump($inv);
                if ($inv->STATUT == 'FAMILLE') {
                    $famille[] = $inv->ID_INVITE;
                } else if ($inv->STATUT == 'EXTERNE') {
                    $ext[] = $inv->ID_INVITE;
                }
            }


            if (isset($famille)) {
                foreach ($famille as $invf) { // FAMILLE

                    // Enfant ?
                    $projection['conditions'] = "ID_PERS_EXTERIEUR = " . $invf;
                    $age = $this->getAge($modInvite->findfirst($projection)->DATE_NAISSANCE);
                    if ($age >= 18) { // adulte
                        $montant += $infosActivite->PRIX_ADULTE;

                    } else { // enfant
                        $montant += $infosActivite->PRIX_ENFANT;
                    }
                }

            }

            if (isset($ext)) {
                foreach ($ext as $inve) { // EXTERIEUR
                    // Enfant ?

                    $projection['conditions'] = "ID_PERS_EXTERIEUR = " . $inve;
                    $age = $this->getAge($modInvite->findfirst($projection)->DATE_NAISSANCE);

                    if ($age >= 18) { // adulte
                        $montant += $infosActivite->PRIX_ADULTE_EXT;

                    } else { // enfant
                        $montant += $infosActivite->PRIX_ENFANT_EXT;

                    }

                }

            }
        }


        if (!($participation == 'non')) {
            $montant += $infosActivite->PRIX_ADULTE;
        }

        return $montant;
    }


    public function modificationActivite($id)
    {

        $modInscription = $this->loadModel('Inscription');
        $req['projection'] = "CRENEAU, ID_ACTIVITE, MONTANT, AUTO_PARTICIPATION";
        $req['conditions'] = "ID = ${id}";
        $inscription = $modInscription->findfirst($req);

        // Vérification des places dispo :
        $modInscription = $this->loadModel('ActiviteParticipantsAdherent');
        $reqI['projection'] =
            'i.AUTO_PARTICIPATION as ap,
            CASE 
    	        WHEN AUTO_PARTICIPATION=1 THEN COUNT(DISTINCT i.ID) + COUNT(li.ID_INVITE)
    	        ELSE COUNT(li.ID_INVITE)
            END as inscrits,
            c.EFFECTIF_CRENEAU as places';
        $reqI['conditions'] = "c.ID_ACTIVITE = {$inscription->ID_ACTIVITE} AND c.NUM_CRENEAU = {$inscription->CRENEAU}";
        // $projection['groupby'] = "c.NUM_CRENEAU, c.ID_ACTIVITE";
        $effectifc = $modInscription->findfirst($reqI);

        $nombreinscription = 0;
        if (isset($_POST['famille'])) $nombreinscription += count($_POST['famille']);
        if (isset($_POST['ext'])) $nombreinscription += count($_POST['ext']);
        if ($_POST['AUTO_PARTICIPATION'] == 1 && $effectifc->ap == 0) $nombreinscription++;


        if (!($nombreinscription > $effectifc->places - $effectifc->inscrits)) {

            $ID_ADHERENT = Session::get('ID_ADHERENT');
            $ID_ACTIVITE = $id;
            $donnees = array();

            if (isset($_POST['famille']) && $this->has_dupes($_POST['famille']) == true) {
                $d['info'] .= "Une erreur est survenue : vous ne pouvez pas incrire la même personne plusieurs fois !";
            } elseif (isset($_POST['ext']) && $this->has_dupes($_POST['ext']) == true) {
                $d['info'] .= "Une erreur est survenue : vous ne pouvez pas incrire la même personne plusieurs fois !";
            } else {


                if ($_POST['AUTO_PARTICIPATION'] == 1) {
                    $donnees['AUTO_PARTICIPATION'] = 1;
                    $adh = Session::get('ID_ADHERENT');
                } else $adh = "non";


                //// Liste des invités ////
                $modListeInvite = $this->loadModel('ListeInvite');
                $proj['projection'] = 'ID_INVITE';
                $proj['conditions'] = 'ID_INSCRIPTION = ' . $id;


                $listeinvites = $modListeInvite->find($proj);

                $valid = true;

                $colonnes = array('ID_INSCRIPTION', 'ID_INVITE');

                $donneesInvite['ID_INSCRIPTION'] = $id;
                if (isset($_POST['famille'])) {
                    foreach ($_POST['famille'] as $key) {
                        if ($key == 'none') {
                            // ne rien faire
                        } else {
                            foreach ($listeinvites as $i) {
                                if ($i->ID_INVITE == $key) {
                                    $valid = false;
                                    $d['info'] = 'Vous ne pouvez pas inscrire plusieurs fois la même personne !';
                                    break;
                                }
                            }
                            if ($valid) {
                                $donneesInvite['ID_INVITE'] = $key;
                                $modListeInvite->insert($colonnes, $donneesInvite);
                            } else {
                                break;
                            }
                        }

                    }
                }

                if (isset($_POST['ext'])) {

                    foreach ($_POST['ext'] as $key) {

                        if ($key == 'none') {
                            // ne rien faire
                        } else {
                            foreach ($listeinvites as $i) {
                                if ($i->ID_INVITE == $key) {
                                    $valid = false;
                                    $d['info'] = 'Vous ne pouvez pas inscrire plusieurs fois la même personne !';
                                    break;
                                }
                            }
                            if ($valid) {
                                $donneesInvite['ID_INVITE'] = $key;
                                $modListeInvite->insert($colonnes, $donneesInvite);
                            } else {
                                break;
                            }
                        }


                    }
                }

                $modListeInviteNom = $this->loadModel('ListeInviteNom');

                $proj['projection'] = 'ID_INVITE, STATUT';
                $data['MONTANT'] = $this->calculMontant($inscription->ID_ACTIVITE, $adh, $modListeInviteNom->find($proj));
                if($adh != -1){
                    $data['AUTO_PARTICIPATION'] = 1;
                }

                $tab = array('conditions' => array('ID' => $id), 'donnees' => $data);
                $modInscription->update($tab);




                if ($valid) {
                    $d['info'] .= "L'inscription à l'activité a été effectuée";
                } /* else {
                $d['info'] .= " Un problème est servenu lors de l'inscription à l'activité";
            }
            */
            }
            $this->set($d);
            $this->mesActivites($inscription->ID_ACTIVITE);
        }else{
            $d['info'] = "Une erreur est servenue : ce créneau de l'activité est plein !";
            $this->set($d);
            $this->formulaireInscription($id);
            $this->render('formulaireInscription');
        }



    }


    public
    function inscriptionActivite($id)
    {


        /*
         *
         *  Fonctionnement BDD :
         * Si l'ID_ADHERENT est saisi mais pas l'ID invité : cela signifie que l'adhérent s'auto-inscrit.
         * Si l'ID_ADHERENT est saisi ET l'ID invité AUSSI : cela signifie que l'invité s'insrit, et qu'il est lié à cet adhérent.
         *
         */

        // Vérification des places dispo :
        $modInscription = $this->loadModel('ActiviteParticipantsAdherent');
        $reqI['projection'] =
            'CASE 
    	        WHEN (i.AUTO_PARTICIPATION=1) THEN COUNT(DISTINCT i.ID) + COUNT(li.ID_INVITE)
    	        ELSE COUNT(li.ID_INVITE)
            END as inscrits,
            c.EFFECTIF_CRENEAU as places';
        $reqI['conditions'] = "i.ID_ACTIVITE = {$id} AND i.CRENEAU = {$_POST['CRENEAU']} AND i.ATTENTE = 0";
        // $projection['groupby'] = "c.NUM_CRENEAU, c.ID_ACTIVITE";
        $effectifc = $modInscription->findfirst($reqI);
//        "SELECT COUNT(*) FROM liste_invites
//join inscription on inscription.ID = liste_invites.ID_INSCRIPTION
//where inscription.ID_ACTIVITE=163 and inscription.creneau = 3";

        //compter les personnes en attente
        $reqIA['projection'] =
            'CASE 
    	        WHEN (i.AUTO_PARTICIPATION=1) THEN COUNT(DISTINCT i.ID) + COUNT(li.ID_INVITE)
    	        ELSE COUNT(li.ID_INVITE)
            END as inscrits,
            c.EFFECTIF_CRENEAU as places';
        $reqIA['conditions'] = "c.ID_ACTIVITE = {$id} AND c.NUM_CRENEAU = {$_POST['CRENEAU']} AND i.ATTENTE = 1";
        $effectifca = $modInscription->findfirst($reqIA);

        $nombreinscription = 0;
        if (isset($_POST['famille'])) $nombreinscription += count($_POST['famille']);
        if (isset($_POST['ext'])) $nombreinscription += count($_POST['ext']);
        if ($_POST['AUTO_PARTICIPATION'] == 1) $nombreinscription++;
//        echo 'nombreinscription';
//        var_dump($nombreinscription);
//        echo'places';
//        var_dump($effectifc->places);
//        echo'inscrits';
//        var_dump($effectifc->inscrits);$donnees = array();
//        echo'places attente';
//        var_dump(($effectifca->places*3));
//        echo'inscrits attente';
//        var_dump(($effectifca->inscrits));
        $donnees['ID_ACTIVITE'] = $id;
        $donnees['ID_ADHERENT'] = $_SESSION['ID_ADHERENT'];
        if ($_POST['AUTO_PARTICIPATION'] == 1) {
            $adh = Session::get('ID_ADHERENT');

        } else {
            $adh = "non"; // l'adhérent ne participe pas
        }
        $donnees['AUTO_PARTICIPATION'] = $_POST['AUTO_PARTICIPATION'];
        $donnees['CRENEAU'] = $_POST['CRENEAU'];
        $donnees['DATE_INSCRIPTION'] = date('Y-m-d H:i:s');
        $inscription = true;
        if(isset($_POST['famille'])) {
            $donnees['MONTANT'] = $this->calculMontant($id, $adh, $_POST['famille']);
        }
        elseif (isset($_POST['ext'])){
            $donnees['MONTANT'] = $this->calculMontant($id, $adh, $_POST['ext']);
        }
        else{
            $donnees['MONTANT'] = $this->calculMontant($id, $adh, NULL);
        }
        //SI il reste de la place dans la liste principale
        if (!($nombreinscription > $effectifc->places - $effectifc->inscrits)) {
            $colonnes = array('ID_ACTIVITE', 'ID_ADHERENT', 'AUTO_PARTICIPATION', 'CRENEAU', 'DATE_INSCRIPTION', 'MONTANT');
        }
        //SI il reste de la place dans la liste d'attente
        elseif(!($nombreinscription > ($effectifc->places*3) - $effectifca->inscrits)){
            $colonnes = array('ID_ACTIVITE', 'ID_ADHERENT', 'AUTO_PARTICIPATION', 'CRENEAU', 'DATE_INSCRIPTION', 'MONTANT', 'ATTENTE');
            $donnees['ATTENTE'] = 1;
            $d['info'] = "L'effectif de cette activité étant complet, vous avez été placé en liste d'attente";
        }
        //SI il n'y a pas de place pour ce créneau
        else{
            $d['info'] = "La liste d'attente est complète";
            $inscription=false;
        }
        if($inscription){
            $valid = true;
//            $donnees = array();
//            $donnees['ID_ACTIVITE'] = $id;
//            $donnees['ID_ADHERENT'] = $_SESSION['ID_ADHERENT'];
//            if ($_POST['AUTO_PARTICIPATION'] == 1) {
//                $adh = Session::get('ID_ADHERENT');
//
//            } else {
//                $adh = "non"; // l'adhérent ne participe pas
//            }
//            $donnees['AUTO_PARTICIPATION'] = $_POST['AUTO_PARTICIPATION'];
//            $donnees['CRENEAU'] = $_POST['CRENEAU'];
//            $donnees['DATE_INSCRIPTION'] = date('Y-m-d');
//            if(isset($_POST['famille'])) {
//                $donnees['MONTANT'] = $this->calculMontant($id, $adh, $_POST['famille']);
//            }
//            elseif (isset($_POST['ext'])){
//                $donnees['MONTANT'] = $this->calculMontant($id, $adh, $_POST['ext']);
//            }
//            else{
//                $donnees['MONTANT'] = $this->calculMontant($id, $adh, NULL);
//            }
            //$donnees['DATE_PAIEMENT'] = date_create('0000-00-00');
            //$donnees['DATE_DESINSCRIPTION'] = date_create('0000-00-00');

            $modInscription = $this->loadModel('Inscription');
            // Test si l'on est pas déjà inscrit !
            $projection['conditions'] = "ID_ACTIVITE =" . $id . " AND ID_ADHERENT = " . $_SESSION['ID_ADHERENT'];
            $inscrit = $modInscription->findfirst($projection);
            if (!empty($inscrit)) {
                $d['info'] = "Une erreur est survenue : vous vous êtes déjà inscrit à cette activité !";
            } elseif (isset($_POST['famille']) && $this->has_dupes($_POST['famille']) == true) {
                $d['info'] = "Une erreur est survenue : vous ne pouvez pas incrire la même personne plusieurs fois !";
            } elseif (isset($_POST['ext']) && $this->has_dupes($_POST['ext']) == true) {
                $d['info'] = "Une erreur est survenue : vous ne pouvez pas incrire la même personne plusieurs fois !";
            } else {

                $projection['conditions'] = "ID_ADHERENT = " . $_SESSION['ID_ADHERENT'];

                $IDInscription = $modInscription->insertAI($colonnes, $donnees);
                //// Liste des invités ////
                $modListeInvite = $this->loadModel('ListeInvite');
                $colonnes = array('ID_INSCRIPTION', 'ID_INVITE');
                $donneesInvite['ID_INSCRIPTION'] = $IDInscription;
                if (isset($_POST['famille'])) {
                    foreach ($_POST['famille'] as $key) {
                        if ($key == 'none') {
                            // ne rien faire
                        } else {
                            $donneesInvite['ID_INVITE'] = $key;
                            $modListeInvite->insert($colonnes, $donneesInvite);
                        }

                    }
                }
                if (isset($_POST['ext'])) {
                    foreach ($_POST['ext'] as $key) {
                        if ($key == 'none') {
                            // ne rien faire
                        } else {
                            $donneesInvite['ID_INVITE'] = $key;
                            $modListeInvite->insert($colonnes, $donneesInvite);
                        }
                    }
                }


//si le code id est numerique c'est ok
                if (is_numeric($IDInscription)) {
                    // On met le montant
                    $modListeInviteNom = $this->loadModel('ListeInviteNom');
                    $proj['projection'] = 'ID_INVITE, STATUT';
                    $proj['conditions'] = 'ID_INSCRIPTION = ' . $IDInscription;
                    $data['MONTANT'] = $this->calculMontant($id, $adh, $modListeInviteNom->find($proj));
                    $tab = array('conditions' => array('ID' => $IDInscription), 'donnees' => $data);
                    $modInscription->update($tab);
                    if(!isset($d['info'])){
                        $d['info'] = "L'inscription à l'activité a été effectuée";
                    }
                } else {
                    $d['info'] = "Problème pour s'inscrire à l'activité";
                }
//                echo "data";
//                var_dump($data);
//                echo "donnees";
//                var_dump($donnees);
//                echo "d";
//                var_dump($d);

                $this->set($d);
                $this->mesActivites($id);
                //$this->render('mesActivites');
            }
        }
    }


    function attente($idactivite){
        $modAttente = $this->loadModel('Attente');

    }


//    public function formulaireInscription($id) {
//        
//    }
//
//    public function inscriptionActivite($id) {
//        $ID_ACTIVITE = $id;
//        $ID_ADHERENT = $_SESSION['ID_ADHERENT'];
//        $DATE_INSCRIPTION = date("Y-m-d");
//        $CRENEAU = 0;<<<<
//        $DATE_PAIEMENT = date("Y-m-d");
//        $NB_ENFANTS = 0;
//        $NB_EXT = 0;
//        $MONTANT = 100;
//        $DATE_DESINSCRIPTION = date("Y-m-d");
//        $modInscription = $this->loadModel('Inscription');
//        $donnees = array($ID_ACTIVITE, $ID_ADHERENT, $DATE_INSCRIPTION, $CRENEAU, $DATE_PAIEMENT, $NB_ENFANTS, $NB_EXT, $MONTANT, $DATE_DESINSCRIPTION);
//        $colonne = array('ID_ACTIVITE', 'ID_ADHERENT', 'DATE_INSCRIPTION', 'CRENEAU', 'DATE_PAIEMENT', 'NB_ENFANTS', 'NB_EXT', 'MONTANT', 'DATE_DESINSCRIPTION');
//        $ID_ACIVITE = $modInscription->insertAI($colonne, $donnees);
//    }
//put your code here
//    function detail($id) {
//        $ID = $id;
//        $modInscription = $this->loadModel('INSCRIPTION');
//        $i['inscription'] = $modInscription->findFirst(array('conditions' => array('ID' => $ID)));
//        $this->set($i);
//    }
//
//    function liste($id) {
//        $ID = trim($id);
//
//        $this->modIncription = $this->loadModel('INSCRIPTION');
//        $i['inscription'] = $this->modInscription->findFirst(array(
//            'conditions' => array('id' => $ID)
//        ));
//        if (empty($i['inscription'])) {
//            $this->e404('Clé invalide');
//        }
//        $this->set($i);
//    }
//
//
//}
    public
    function listerActiviteInscrit()
    {
        $modActiviteInscrit = $this->loadModel('ActiviteInscriptionCreneau'); //instancier le modele
        $projection['projection'] = "ACTIVITE.ID_ACTIVITE,ACTIVITE.NOM,DETAIL,VILLE,INDICATION_PARTICIPANT, DATE_CRENEAU, HEURE_CRENEAU, MONTANT, ADHERENT.NOM as an, ADHERENT.PRENOM as ap";
        $projection['conditions'] = 'INSCRIPTION.ID_ADHERENT = ' . $_SESSION['ID_ADHERENT'];
        $d['inscription'] = $modActiviteInscrit->find($projection);
        //  $projection ['projection'] = "ACTIVITE.ID_ACTIVITE,NOM,DETAIL,VILLE,NB_ENFANTS,NB_EXT,INDICATION_PARTICIPANT,MONTANT";
        // $projection['conditions'] = 'ID_ADHERENT = '.$_SESSION['ID_ADHERENT'];
        //  $params = array('projection' => $projection, 'condition' => $condition);
        //  $d['activites'] = $modActiviteInscrit->find($params);
        $this->set($d);
    }

    function mesActivites($id)
    {
        $ID_ACTIVITE = $id;
        $modActiviteInscrit = $this->loadModel('ActiviteInscrit');
        //$projection ['projection']="activite.ID_ACTIVITE, activite.NOM, activite.DETAIL, activite.ADRESSE, activite.CP, activite.VILLE, activite.AGE_MINIMUM,,activite.DATE_PAIEMENT, activite.INDICATION_PARTICIPANT, activite.INFO_IMPORTANT_PARTICIPANT";
        $projection ['projection'] = "ACTIVITE.ID_ACTIVITE, ACTIVITE.ID_LEADER, ACTIVITE.NOM, ACTIVITE.DETAIL, ACTIVITE.ADRESSE, ACTIVITE.CP, ACTIVITE.VILLE, ACTIVITE.AGE_MINIMUM,ACTIVITE.PRIX_ADULTE,ACTIVITE.PRIX_ENFANT,ACTIVITE.PRIX_ADULTE_EXT,ACTIVITE.PRIX_ENFANT_EXT, ACTIVITE.INDICATION_PARTICIPANT, ACTIVITE.INFO_IMPORTANT_PARTICIPANT";
        $projection['conditions'] = "ACTIVITE.ID_ACTIVITE = " . $ID_ACTIVITE;
        $d['donnees'] = $modActiviteInscrit->findfirst($projection);

        // requete 2 pour récupérer le nom
        $modNomLeader = $this->loadModel('NomLeader');
        $projection ['projection'] = "ADHERENT.NOM as NOMLEADER, ADHERENT.PRENOM as PRENOMLEADER";
        $projection['conditions'] = "ID_ACTIVITE = " . $ID_ACTIVITE;
        // $d['nomleader'] = $modNomLeader->findfirst($projection);
        $d['leader'] = $modNomLeader->findfirst($projection);

        // requete 3 pour récupérer les info de l'inscription
        $modInscription = $this->loadModel('Inscription');
        $projectionI['conditions'] = "ID_ACTIVITE = {$ID_ACTIVITE} AND ID_ADHERENT = {$_SESSION['ID_ADHERENT']}";
//        var_dump($ID_ACTIVITE);
//        var_dump($_SESSION['ID_ADHERENT']);
        $d['inscription'] = $modInscription->findfirst($projectionI);
//        var_dump($d['inscription']);

        //requete 4 : on recupère la liste des invites
        $modListeInvite = $this->loadModel('ListeInviteNom');
        $projectionL['conditions'] = "ID_INSCRIPTION = {$d['inscription']->ID}";
        //$projectionL['conditions'] = "ID_INSCRIPTION = {$d['inscription']}";
        $d['invites'] = $modListeInvite->find($projectionL);
//        var_dump($d['invites']);
        $modCreneaudate = $this->loadModel('ListeCreneau');
        $projectionM['projection'] = "CRENEAU.DATE_PAIEMENT";
        $projectionM['conditions'] = "ID_ACTIVITE = {$ID_ACTIVITE} AND NUM_CRENEAU = {$d['inscription']->CRENEAU}";
        $d['creneau'] = $modCreneaudate->findfirst($projectionM);

        // Place liste d'attente:
        /*
        $d['position'] = $this->positionListeAttente($d['inscription']->ID);
*/
        $this->set($d);

        $this->render('mesActivites');


    }


}

?>

