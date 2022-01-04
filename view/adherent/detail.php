<!-- Form Name -->
<legend>Amicale des cadres ALSTOM</legend>
<?php // $title_for_layout = $tournoi->nomtournoi ?>
<form class="form-horizontal" method="post"
      action="<?= BASE_URL ?>/adherent/<?= (isset($action) ? 'creer' : 'modifier') ?>/<?= (isset($adherent->ID_ADHERENT) ? $adherent->ID_ADHERENT : '') ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Modification des comptes</legend>
        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Code adhérent :</label>
            <div class="col-md-1">
                <input id="ID_ADHERENT" name="ID_ADHERENT" disabled class="form-control input-md" type="text"
                       value="<?= (isset($adherent->ID_ADHERENT) ? $adherent->ID_ADHERENT : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Adresse Mail <span class="important">*</span>
                :</label>

            <div class="col-md-4">
                <input id="MAIL" name="MAIL" placeholder="MAIL" class="form-control input-md" type="text"
                       value="<?= (isset($adherent->MAIL) ? $adherent->MAIL : '') ?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Grade <span class="important">*</span> :</label>

            <div class="col-md-4">
                <select name="GRADE">
                    <option value="M" <?php if ($adherent->GRADE == "M") {
                        echo "selected";
                    } ?>>Adherent
                    </option>
                    <option value="L" <?php if ($adherent->GRADE == "L") {
                        echo "selected";
                    } ?>>Leader
                    </option>
                    <option value="A" <?php if ($adherent->GRADE == "A") {
                        echo "selected";
                    } ?>>Administrateur
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nom <span class="important">*</span> :</label>
            <div class="col-md-4">
                <input id="NOM" name="NOM" placeholder="Nom" class="form-control input-md" type="text"
                       value="<?= (isset($adherent->NOM) ? $adherent->NOM : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Prénom <span class="important">*</span> :</label>
            <div class="col-md-4">
                <input id="PRENOM" name="PRENOM" placeholder="PRENOM" class="form-control input-md" type="text"
                       value="<?= (isset($adherent->PRENOM) ? $adherent->PRENOM : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Genre <span class="important">*</span> :</label>
            <div class="col-md-4">
                <select name="GENRE">
                    <option value="H" <?php if ($adherent->GENRE == "H") {
                        echo "selected";
                    } ?>>Homme
                    </option>
                    <option value="F" <?php if ($adherent->GENRE == "F") {
                        echo "selected";
                    } ?>>Femme
                    </option>
                    <option value="A" <?php if ($adherent->GENRE == "A") {
                        echo "selected";
                    } ?>>Autre
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Matricule :</label>
            <div class="col-md-4">
                <input id="MATRICULE" name="MATRICULE" placeholder="MATRICULE" class="form-control input-md" type="text"
                       value="<?= (isset($adherent->MATRICULE) ? $adherent->MATRICULE : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Telephone :</label>
            <div class="col-md-4">
                <input id="TELEPHONE" name="TELEPHONE" placeholder="TELEPHONE" class="form-control input-md" type="text"
                       value="<?= (isset($adherent->TELEPHONE) ? ltrim($adherent->TELEPHONE, ':') : '') ?>">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Membre actif :</label>
            <div class="col-md-4">
                <input id="MEMBRE_ACTIF" name="MEMBRE_ACTIF" placeholder="MEMBRE_ACTIF" class="form-control input-md"
                       type="text" value="<?= (isset($adherent->MEMBRE_ACTIF) ? $adherent->MEMBRE_ACTIF : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Date adhésion :</label>
            <div class="col-md-4">
                <input id="DATE_ADHESION" name="DATE_ADHESION" placeholder="DATE_ADHESION" class="form-control input-md"
                       type="date" value="<?= (isset($adherent->DATE_ADHESION) ? $adherent->DATE_ADHESION : '') ?>">
            </div>
        </div>
        <!-- Button -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Modifier</button>
            </div>
        </div>
    </fieldset>
</form>

<form class="form-horizontal" method="post"
      action="<?= BASE_URL ?>/adherent/resetMdp/<?= isset($adherent->ID_ADHERENT) ? $adherent->ID_ADHERENT : '' ?>">
    <div class="col-md-4">
        <button id="singlebutton" name="singlebutton" class="btn btn-danger">Réinitialiser le mot de passe</button>
    </div>
    <label class="col-md-2 control-label" for="singlebutton">Action irréversible - nouveau mot de passe: achanger</label>
</form>
