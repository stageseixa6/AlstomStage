<?php

class PrestataireController extends Controller {

    public function creer() {
        $modPrestataire = $this->loadModel('Prestataire');
        $d['prestataire'] = $modPrestataire->find(array('conditions' => 1));
        $this->set($d);
        $this->render('creer');
    }

    public function nouveau() {
        $modPrestataire = $this->loadModel('Prestataire');
        $donnees = array();
        $donnees["NOM"] = $_POST["NOM"];
        $donnees["MAIL"] = $_POST["MAIL"];
        $donnees["TEL"] = ':' . $_POST["TEL"];
        $donnees["ADRESSE"] = $_POST["ADRESSE"];
        $donnees["CP"] = $_POST["CP"];
        $donnees["VILLE"] = $_POST["VILLE"];
        $colonne = array('NOM', 'MAIL', 'TEL', 'ADRESSE', 'CP', 'VILLE');
        $ID = $modPrestataire->insertAI($colonne, $donnees);
        if (is_numeric($ID)) {
            $d['info'] = "Prestataire créer";
            $d['prestataire'] = $modPrestataire->findFirst(array('conditions' => array('ID' => $ID)));
            $modPrestataire = $this->loadModel('Prestataire');
            $d['prestataire'] = $modPrestataire->find(array('conditions' => 1));
        } else {
            $d['info'] = "Erreur de traitement";
        }
        $this->set($d);
        $this->render('liste');
    }

    public function liste() {
        $modPrestataire = $this->loadModel('Prestataire'); //instancier le modele 
        $d['prestataire'] = $modPrestataire->find(array('conditions' => 1));
//fait un select * from tournois et met les donnés sous forme de tableau d'objet dans $d['tournois']
        //passer les informations à la vue qui s'appellera liste.php
        $this->set($d);
        $this->render('liste');
    }

    function detail($id) {
        $ID = $id;
        $modPrestataire = $this->loadModel('Prestataire');
        $d['prestataire'] = $modPrestataire->findFirst(array('conditions' => array('ID' => $ID)));
        $this->set($d);
    }

    function modifier($id) {
        $ID = $id;
        $modPrestataire = $this->loadModel('Prestataire');
        //recup les données du form
        $donnees = array();
       $donnees["NOM"] = $_POST["NOM"];
        $donnees["MAIL"] = $_POST["MAIL"];
        $donnees["TEL"] = ':' . $_POST["TEL"];
        $donnees["ADRESSE"] = $_POST["ADRESSE"];
        $donnees["CP"] = $_POST["CP"];
        $donnees["VILLE"] = $_POST["VILLE"];
       // $colonne = array('NOM', 'MAIL', 'TEL', 'ADRESSE', 'CP', 'VILLE');
        $tab = array('conditions' => array('ID' => $ID), 'donnees' => $donnees);
        //appeler la methode update
        $modPrestataire->update($tab);
        $d['info'] = "Prestataire modifié";
        //charger le tableau 
        $d['prestataire'] = $modPrestataire->findFirst(array('conditions' => array('ID' => $ID)));
        $modPrestataire = $this->loadModel('Prestataire');
        $d['prestataire'] = $modPrestataire->find(array('conditions' => 1));
        $this->set($d);
        $this->liste();
    }
    function supprimer() {
        $modPrestataire = $this->loadModel('Prestataire');
        if (isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $where = '';
            foreach ($ids as $id) {
                $tab = array('conditions' => "ID = " . $id);
                try {
                    $modPrestataire->delete($tab);
                } catch (Exception $ex) {
                    $e->getCode() == 42000;
                }
            }
        }
        $this->liste();


        /*function archiver() {
            $modPrestataire = $this->loadModel('Prestataire');
            if (isset($_POST['ids'])) {
                $ids = $_POST['ids'];
                $donnees = array();
                $donnees["DATE_DEPART"] = date("Y-m-d");
                $donnees["MEMBRE_ACTIF"] = 0;
                foreach ($ids as $id) {
                    $tab = array('conditions' => "ID_ADHERENT = " . $id,'donnees' => $donnees);
                    try {
                        $modAdherent->update($tab);
                    } catch (Exception $ex) {
                        $e->getCode() == 42000;
                    }
                }
                $this->liste();
                $this->render('liste');
            }
        }


        }*/

}
}
