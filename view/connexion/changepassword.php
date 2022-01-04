<h2>Changement de mot de passe :</h2>
<form style="display: block;" class="form-horizontal" method="post"
      action="<?= BASE_URL ?>/connexion/changepwd">

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nouveau mot de passe</label>
            <div class="col-md-4">
                <input type="password" id="NEWPWD" name="NEWPWD"
                       placeholder="Veuillez saisir un nouveau mot de passe"
                       class="form-control input-md" type="text" required>
                <span toggle="#NEWPWD" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Confirmation du nouveau mot de passe :</label>
        <div class="col-md-4">
            <input type="password" id="CONFIRMPWD" name="CONFIRMPWD"
                   placeholder="Veuillez confirmer votre nouveau mot de passe"
                   class="form-control input-md" type="text" required>
            <span toggle="#CONFIRMPWD" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
    </div>
        <button id="singlebutton" name="singlebutton" class="btn btn-info">Confirmer</button>

</form>