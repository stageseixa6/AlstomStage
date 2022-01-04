<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/invite/<?= $action ?><?php if($action == 'modifierInvite'){ echo '/' . $invite->ID_PERS_EXTERIEUR; }?>">
    <fieldset>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nom <span class="important">*</span> : </label>
            <div class="col-md-4">
                <input id="NOM" name="NOM" class="form-control input-md" type="text" value="<?= isset($invite->NOM) ? $invite->NOM : '' ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Prenom <span class="important">*</span> : </label>
            <div class="col-md-4">
                <input id="PRENOM" name="PRENOM" class="form-control input-md" type="text" value="<?= isset($invite->PRENOM) ? $invite->PRENOM : '' ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Statut <span class="important">*</span> :</label>
            <div class="col-md-2">
                <input id="FAMILLE" name="STATUT" type="radio" value="FAMILLE" required <?= $invite->STATUT == 'FAMILLE' ? 'checked' : '' ?>>
                <label for="FAMILLE">Famille</label>
            </div>
            <div class="col-md-2">
                <input id="EXTERNE" name="STATUT" type="radio" value="EXTERNE" <?= $invite->STATUT == 'EXTERNE' ? 'checked' : '' ?>>
                <label for="EXTERNE">Externe</label>
            </div>


        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Date de naissance : <span class="important">*</span> </label>
            <div class="col-md-4">
                <input id="DATE_NAISSANCE" required name="DATE_NAISSANCE" placeholder="Date de naissance"
                       class="form-control input-md" type="date" value="<?= isset($invite->DATE_NAISSANCE) ? $invite->DATE_NAISSANCE : '' ?>">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Telephone : </label>
            <div class="col-md-4">
                <input id="TELEPHONE" name="TELEPHONE" class="form-control input-md" type="text" value="<?= isset($invite->TELEPHONE) ? ltrim($invite->TELEPHONE, ':') : ''?>">
            </div>
        </div>



        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info"><?= $action == 'nouveauInvite' ? 'Créer' : 'Valider les modificiations' ?></button>
            </div>
        </div>
    </fieldset>
</form>
