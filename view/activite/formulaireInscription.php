<?php if (empty($inscription)) { ?>
    <form class="form-horizontal" method="post"
          action="<?= BASE_URL ?>/activite/inscriptionActivite/<?= $donnees->ID_ACTIVITE ?>">
        <fieldset>

            <!-- Form Name -->
            <legend>Formulaire d'Inscription à une Activité</legend>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Nom de l'activité</label>
                <div class="col-md-3">
                    <input id="NOM" name="NOM" placeholder="NOM" readonly="yes" class="form-control input-md"
                           type="text"
                           value="<?= (isset($donnees->NOM) ? $donnees->NOM : '') ?>">
                </div>
            </div>


            <br>
            Séléctionnez les participants
            <hr>

            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Participants : Adhérent</label>
                <div class="col-md-3">
                    <select onchange="calculMontantLive()" id="AUTO_PARTICIPATION" name="AUTO_PARTICIPATION" value="1">
                        <option value="1"><?= $_SESSION['NOM'] . ' ' . $_SESSION['PRENOM'] ?></option>
                        <option value="0">Je souhaite seulement inscrire des invités.</option>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Partitipants : Famille</label>
                <p>Pas encore d'invités ? <a href="<?= BASE_URL ?>/invite/creer">Créez en un ici.</a></p>
                <div class="col-md-3" id="invitesfamille">

                    <select name="famille[]" class="participantfamille" onchange="calculMontantLive()">
                        <option disabled selected value="none"> -- choisissez un invité --</option>
                        <?php if (isset($invitesfamille)) {
                            foreach ($invitesfamille as $invite) {

                                // Vérification Enfant
                                if (!(ActiviteController::getAge($invite->DATE_NAISSANCE) <= $donnees->AGE_MINIMUM)) {

                                    ?>
                                    <option id="<?= ActiviteController::getAge($invite->DATE_NAISSANCE) < 18 ? 'enfant' : 'adulte' ?>"  value=<?= $invite->ID_PERS_EXTERIEUR; ?>><?= $invite->NOM ?> <?= $invite->PRENOM ?></option>
                                <?php }
                            };
                        } ?>
                    </select>
                </div>
                <input type="button" value="+" onclick="addInscriptionInput('famille');">
                <input type="button" value="-" onclick="removeInscriptionInput('famille');">
            </div>

            <?php if ($donnees->OUVERT_EXT == 1) { ?>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="textinput">Partitipants : Externes</label>
                    <div class="col-md-3" id="invitesext">


                        <select name="ext[]" class="participantext" onchange="calculMontantLive()">

                            <option disabled selected value="none"> -- choisissez un invité --</option>
                            <?php if (isset($invitesext)) {

                                foreach ($invitesext as $invite) {
                                    if (!(ActiviteController::getAge($invite->DATE_NAISSANCE) <= $donnees->AGE_MINIMUM)) {

                                        ?>
                                        <option id="<?= ActiviteController::getAge($invite->DATE_NAISSANCE) < 18 ? 'enfant' : 'adulte' ?>"  value=<?= $invite->ID_PERS_EXTERIEUR; ?>><?= $invite->NOM ?> <?= $invite->PRENOM ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                    </div>
                    <input type="button" value="+" onclick="addInscriptionInput('ext');">
                    <input type="button" value="-" onclick="removeInscriptionInput('ext');">
                </div>
            <?php } ?>

            <div id="live_montant">Montant : <?= $donnees->PRIX_ADULTE ?> €</div>

            <br>
            Choix du créneau
            <hr>

            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Créneau :</label>
                <div class="col-md-3" id="creneau">

                    <select name="CRENEAU" id="creneau">
                        <?php if (!empty($creneaux)) {
                            foreach ($creneaux as $creneau):
                                $date = date_create($creneau->DATE_CRENEAU);
                                ?>

                                <option value="<?= $creneau->NUM_CRENEAU ?>"><?= 'Le ' . date_format($date, 'd-m-Y') . ' à ' . substr($creneau->HEURE_CRENEAU, 0, -3) ?></option>
                            <?php endforeach;
                        } else {
                            ?>
                            <option selected disabled value="">Il n'y a pas de créneau pour le moment.</option>
                            <?php
                        } ?>
                    </select>
                </div>

            </div>


            <td>
                <?php if (!empty($creneaux)) { ?>
                    <button id="singlebutton" name="singlebutton" class="btn btn-info">S'inscrire</button>
                <?php } else { ?>
                    <button disabled id="singlebutton" name="singlebutton" class="btn btn-info">S'inscrire</button>
                <?php } ?>
            </td>

        </fieldset>
    </form>

<?php } else { ?>

    <form class="form-horizontal" method="post"
          action="<?= BASE_URL ?>/activite/modificationActivite/<?= $inscription->ID ?>">
        <fieldset>

            <!-- Form Name -->
            <legend>Formulaire d'Inscription à une Activité</legend>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Nom de l'activité</label>
                <div class="col-md-3">
                    <input id="NOM" name="NOM" placeholder="NOM" readonly="yes" class="form-control input-md"
                           type="text"
                           value="<?= (isset($donnees->NOM) ? $donnees->NOM : '') ?>">
                </div>
            </div>


            <br>
            <h4>Vous êtes déjà inscrit. Vous pouvez tout de même choisir de participer à l'activité, ou ajouter des participants</h4>
            <hr>

            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Participants : Adhérent</label>
                <div class="col-md-3">
                    <select id="AUTO_PARTICIPATION" name="AUTO_PARTICIPATION" onchange="calculMontantLive()" >
                        <option value="1" id="<?= $inscription->AUTO_PARTICIPATION == 1 ? 'ap' : '' ?>" <?= $inscription->AUTO_PARTICIPATION == 1 ? 'selected' : '' ?>><?= $_SESSION['NOM'] . ' ' . $_SESSION['PRENOM'] ?></option>
                        <option value="0" <?= $inscription->AUTO_PARTICIPATION == 0 ? 'selected' : '' ?> <?= $inscription->AUTO_PARTICIPATION == 1 ? 'disabled' : '' ?>>Je souhaite seulement inscrire des invités.</option>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <p>Pas encore d'invités ? <a href="<?= BASE_URL ?>/invite/creer">Créez en un ici.</a></p>
                <label class="col-md-2 control-label" for="textinput">Partitipants : Famille</label>
                <div class="col-md-3" id="invitesfamille">

                    <select name="famille[]" class="participantfamille" onchange="calculMontantLive()">
                        <option disabled selected value="none"> -- choisissez un invité --</option>
                        <?php if (isset($invitesfamille)) {
                            foreach ($invitesfamille as $invite) {

                                // Vérification Enfant
                                if (!(ActiviteController::getAge($invite->DATE_NAISSANCE) < $donnees->AGE_MINIMUM)) {

                                    ?>
                                    <option id="<?= ActiviteController::getAge($invite->DATE_NAISSANCE) < 18 ? 'enfant' : 'adulte' ?>" value=<?= $invite->ID_PERS_EXTERIEUR; ?>><?= $invite->NOM ?> <?= $invite->PRENOM ?></option>
                                <?php }
                            };
                        } ?>
                    </select>
                </div>
                <input type="button" value="+" onclick="addInscriptionInput('famille');">
                <input type="button" value="-" onclick="removeInscriptionInput('famille');">
            </div>

            <?php if ($donnees->OUVERT_EXT == 1) { ?>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="textinput">Partitipants : Externes</label>
                    <div class="col-md-3" id="invitesext">

                        <select name="ext[]" class="participantext" onchange="calculMontantLive()">

                            <option disabled selected value="none"> -- choisissez un invité --</option>
                            <?php if (isset($invitesext)) {

                                foreach ($invitesext as $invite) {
                                    if (!(ActiviteController::getAge($invite->DATE_NAISSANCE) < $donnees->AGE_MINIMUM)) {

                                        ?>
                                        <option id="<?= ActiviteController::getAge($invite->DATE_NAISSANCE) < 18 ? 'enfant' : 'adulte' ?>" value=<?= $invite->ID_PERS_EXTERIEUR; ?>><?= $invite->NOM ?> <?= $invite->PRENOM ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                    </div>
                    <input type="button" value="+" onclick="addInscriptionInput('ext');">
                    <input type="button" value="-" onclick="removeInscriptionInput('ext');">
                </div>
                <div id="live_montant">Montant : <?= $inscription->MONTANT ?> €</div>
            <?php } ?>
                    <button id="singlebutton" name="singlebutton" class="btn btn-info">Valider les changements</button>

            </td>

        </fieldset>
    </form>

<?php } ?>
<td>
    <button id="singlebutton" name="singlebutton" class="btn btn-info"
            onclick="window.location.href = '../../activite/listerActivite'">Annuler
    </button>
</td>

<script>
    function addInscriptionInput(type) {
        // type sera égal à "famille" où à "ext"
        let formContainer = document.getElementById("invites" + type);
        let baseSelectInput = document.getElementsByClassName("participant" + type)
        let base = baseSelectInput[0];
        formContainer.insertAdjacentHTML('beforeend', base.outerHTML);

    }

    function removeInscriptionInput(type){
        // type sera égal à "famille" où à "ext"
        let baseSelectInput = document.getElementsByClassName("participant" + type)
        if(baseSelectInput.length < 2){
            baseSelectInput[0].value = 'none';
        }else{
            let latestInput = baseSelectInput[baseSelectInput.length - 1];
            latestInput.remove();
        }
        calculMontantLive();
    }
    <?php if(isset($donnees->PRIX_ADULTE)) ?>
    let prix_adulte = <?= $donnees->PRIX_ADULTE ?>;
    <?php if(isset($donnees->PRIX_ADULTE_EXT)) ?>
    let prix_adulte_ext = <?= $donnees->PRIX_ADULTE_EXT?>;
    <?php if(isset($donnees->PRIX_ENFANT)) ?>
    let prix_enfant = <?= $donnees->PRIX_ENFANT ?>;
    <?php if(isset($donnees->PRIX_ENFANT_EXT)) ?>
    let prix_enfant_ext = <?= $donnees->PRIX_ENFANT_EXT ?>;
    function calculMontantLive(){


        let auto_participation = document.getElementById('AUTO_PARTICIPATION');
        let extSelectInput = document.getElementsByClassName("participantext");
        let familleSelectInput = document.getElementsByClassName("participantfamille");

        let montant = 0;

        <?php if(isset($inscription->MONTANT)){?>
        montant = <?= $inscription->MONTANT ?>
       <?php }  ?>

        if(auto_participation.value == 1){
            if(auto_participation[auto_participation.selectedIndex].id == 'ap'){

            }else{
                montant += prix_adulte;
            }

        }
        for(var i = 0; i < extSelectInput.length; i++){
            if(extSelectInput[i].value == 'none'){

            }else{
                if(extSelectInput[i][extSelectInput[i].selectedIndex].id == 'enfant'){
                    montant += prix_enfant_ext;
                }else{
                    montant += prix_adulte_ext;
                }
            }

        }
        for(var i = 0; i < familleSelectInput.length; i++){
            if(familleSelectInput[i].value == 'none'){

            }else{
                if(familleSelectInput[i][familleSelectInput[i].selectedIndex].id == 'enfant'){
                    montant += prix_enfant;
                }else {
                    montant += prix_adulte;
                }
            }
        }

        let divAffichageMontant = document.getElementById('live_montant');
        divAffichageMontant.innerHTML = 'Montant : ' + montant + " €";

    }

</script>
