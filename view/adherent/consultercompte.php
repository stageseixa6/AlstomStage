<legend>Amicale des cadres ALSTOM</legend>

<legend>Mon compte</legend>


<!-- Modification du mdp -->
<form style="display: block;" class="form-horizontal" method="post"
      action="<?= BASE_URL ?>/adherent/modifiermdp">
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Mot de passe :</label>
        <div class="col-md-4">
            <input type="button" id="changepassword" value="Modifier"
                   style="display: inline" onclick="changePassword();">
        </div>
    </div>
    <div id="modifmdp" style="display: none">
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Mot de passe actuel :</label>
            <div class="col-md-4">
                <input type="password" id="CURRENTPWD" name="CURRENTPWD"
                       placeholder="Veuillez saisir votre mot de passe actuel"
                       class="form-control input-md" type="text" required>
                <span toggle="#CURRENTPWD" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nouveau mot de passe :</label>
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
    </div>
</form>

<form class="form-horizontal" method="post"
      action="<?= BASE_URL ?>/adherent/modifiertel">
    <fieldset>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Adresse mél :</label>
            <div class="col-md-4">
                <input id="MAIL" name="MAIL" placeholder="MAIL" disabled
                       class="form-control input-md" type="text"
                       value="<?= $_SESSION['MAIL'] ?>">
            </div>
        </div>




        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nom :</label>
            <div class="col-md-4">
                <input id="NOM" name="NOM" placeholder="NOM" disabled
                       class="form-control input-md" type="text"
                       value="<?= $_SESSION['NOM'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Prénom :</label>
            <div class="col-md-4">
                <input id="PRENOM" name="PRENOM" placeholder="PRENOM" disabled
                       class="form-control input-md" type="text"
                       value="<?= $_SESSION['PRENOM'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Genre :</label>
            <div class="col-md-4">
                <input id="GENRE" name="GENRE" placeholder="GENRE" disabled
                       class="form-control input-md" type="text"
                       value="<?php if ($_SESSION['GENRE'] == 'F') {
                           echo 'Femme';
                       } elseif ($_SESSION['GENRE'] == 'H') {
                           echo 'Homme';
                       } else {
                           echo 'Autre';
                       } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Matricule :</label>
            <div class="col-md-4">
                <input id="MATRICULE" name="MATRICULE" placeholder="Non renseigné." disabled
                       class="form-control input-md" type="text"
                       value="<?= $_SESSION['MATRICULE'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Téléphone :</label>
            <div class="col-md-4">
                <input id="TELEPHONE" name="TELEPHONE" placeholder="Non renseigné."
                       class="form-control input-md" type="text"
                       value="<?= ltrim($_SESSION['TELEPHONE'], ':') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Date Adhésion :</label>
            <div class="col-md-4">
                <input id="DATE_ADHESION" name="DATE_ADHESION" placeholder="Non renseigné." disabled
                       class="form-control input-md" type="text"
                       value="<?= $_SESSION['DATE_ADHESION'] ?>">
            </div>
        </div>

        <button id="singlebutton" name="singlebutton" class="btn btn-info">Modifier</button>
</form>


