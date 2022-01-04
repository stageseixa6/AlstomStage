
<?php if (isset($creneauP)){ ?>
    <legend>Modifier le créneau</legend>
<?php } else {?>
    <legend>Ajout d'un créneau</legend>
<?php } ?>

<form class='form-horizontal' method="post"
      action="<?= BASE_URL ?>/activiteLeader/<?= (isset($creneauP[0]->ID_ACTIVITE) ? 'modifierCreneau/' : 'creerCreneau/') . $activite->ID_ACTIVITE . (isset($creneauP[0]->ID_ACTIVITE) ? '_' . $creneauP[0]->NUM_CRENEAU : '') ?>">
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Nom activité :</label>
        <div class="col-md-4">
            <input id="NOM_LEADER" name="NOM_LEADER" placeholder="Nom du Leader" class="form-control input-md"
                   type="text" value="<?= (isset($activite->NOM) ? $activite->NOM : 'ERREUR') ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Détail :</label>
        <div class="col-md-4">
            <textarea id="PRENOM_LEADER" name="PRENOM_LEADER" placeholder="Détail de l'activité"
                      class="form-control input-md" type="text"
                      readonly><?= (isset($activite->DETAIL) ? $activite->DETAIL : 'ERREUR') ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Créneaux déjà existants :</label>
        <ul class="col-md-4">
            <?php
            if(!empty($creneauG)){
                foreach ($creneauG as $c) {
                    if ($activite->ID_ACTIVITE == $c->ID_ACTIVITE) {
                        $date = date_create($c->DATE_CRENEAU);
                        echo '<li>' . date_format($date, 'd-m-Y') . ' - ' . substr($c->HEURE_CRENEAU, 0, -3) . '</li>';
                    }
                }
            }else{
                ?>Il n'existe pas de créneau pour cette activité.<?php
            }

            ?>
        </ul>
    </div>
    <hr>

    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Date créneau : <span class="important">*</span> </label>
        <div class="col-md-4">
            <input required id="DATE_CRENEAU" name="DATE_CRENEAU" placeholder="N° activité" class="form-control input-md"
                   type="date" value="<?= (isset($creneauP[0]->DATE_CRENEAU) ? $creneauP[0]->DATE_CRENEAU : '') ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Heure créneau : <span class="important">*</span> </label>
        <div class="col-md-4">
            <input required id="HEURE_CRENEAU" name="HEURE_CRENEAU" placeholder="N° activité" class="form-control input-md"
                   type="time" value="<?= (isset($creneauP[0]->HEURE_CRENEAU) ? $creneauP[0]->HEURE_CRENEAU : '') ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Date limite de paiement : <span class="important">*</span> </label>
        <div class="col-md-4">
            <input required id="DATE_PAIEMENT" name="DATE_PAIEMENT" placeholder="N° activité" class="form-control input-md"
                   type="date" value="<?= (isset($creneauP[0]->DATE_PAIEMENT) ? $creneauP[0]->DATE_PAIEMENT : '') ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Nombre de personnes pour le créneau :</label>
        <div class="col-md-4">
            <input id="EFFECTIF_CRENEAU" name="EFFECTIF_CRENEAU" placeholder="Nombre de participants"
                   class="form-control input-md"
                   value="<?= (isset($creneauP[0]->EFFECTIF_CRENEAU) ? ($creneauP[0]->EFFECTIF_CRENEAU) : '') ?>">
        </div>
    </div>
    <?php if(isset($creneauP[0]->STATUT)){

    ?>
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Statut :</label>
        <div class="col-md-4">
            <?php if ($creneauP[0]->STATUT == "A") { ?>
                Créneau en attente de validation par l'administrateur.
            <?php } else { ?>
                <select id="statut_annule"  name="STATUT" onchange="annuleCreneau();>
                    <option value="V" <?= (isset($creneauP[0]->STATUT) ? ($creneauP[0]->STATUT == "V" ? "selected" : '') : '') ?> >
                        Validé
                    </option>
                    <option value="O" <?= (isset($creneauP[0]->STATUT) ? ($creneauP[0]->STATUT == "O" ? "selected" : '') : '') ?> >
                        Ouvert
                    </option>
                    <option value="F" <?= (isset($creneauP[0]->STATUT) ? ($creneauP[0]->STATUT == "F" ? "selected" : '') : '') ?> >
                        Fermé
                    </option>
                    <option value="T" <?= (isset($creneauP[0]->STATUT) ? ($creneauP[0]->STATUT == "T" ? "selected" : '') : '') ?> >
                        Terminé
                    </option>
                    <option value="S" <?= (isset($creneauP[0]->STATUT)? ($creneauP[0]->STATUT== "S" ? "selected" : ''): '')?> >Annulé</option>
                </select>
        </div>
    </div>
    <div class="form-group" id="statut_annule_commentaire" style="display: <?php if($creneauP[0]->STATUT == "S") echo 'block'; else echo 'none'; ?>;">
        <label class="col-md-2 control-label" for="textinput">Annulation : Commentaire</label>
        <div class="col-md-4">
            <textarea id="COMMENTAIRE" name="COMMENTAIRE" placeholder="Commentaire" class="form-control input-md" type="text"><?= (isset($creneauP[0]->COMMENTAIRE) ? $creneauP[0]->COMMENTAIRE : '') ?></textarea>
        </div>
    </div>
    </div>
    <?php }} ?>
    <div class="form-group">
        <label class="col-md-2 control-label" for="singlebutton"></label>
        <div class="col-md-4">
            <button id="singlebutton" name="singlebutton" class="btn btn-info">Valider</button>
            <input type="button" id="singlebutton" name="singlebutton" class="btn btn-danger"
                   <?= !(isset($creneauP[0]->NUM_CRENEAU)) ? 'disabled' : '' ?>
                   onclick="window.location.href = '../supprimerCreneau/<?= (isset($creneauP[0]->ID_ACTIVITE) ? $creneauP[0]->ID_ACTIVITE . '_' . $creneauP[0]->NUM_CRENEAU : '') ?>'"
                   value="Supprimer">

        </div>
    </div>
</form>