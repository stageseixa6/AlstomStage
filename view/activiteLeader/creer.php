<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/activiteLeader/nouveau">

    <fieldset>

        <!-- Form Name -->
        <legend>Activité</legend>
        <!-- Text input-->
        Leader en charge de l'activité :
        <br>
        <br>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nom :</label>
            <div class="col-md-4">
                <input id="NOM_LEADER" name="NOM_LEADER" placeholder="Nom du Leader" class="form-control input-md"
                       type="NOM_LEADER" value="<?= (isset($_SESSION['NOM']) ? $_SESSION['NOM'] : 'ERREUR') ?>"
                       readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Prénom :</label>
            <div class="col-md-4">
                <input id="PRENOM_LEADER" name="PRENOM_LEADER" placeholder="Prénom du leader"
                       class="form-control input-md" type="PRENOM_LEADER"
                       value="<?= (isset($_SESSION['PRENOM']) ? $_SESSION['PRENOM'] : 'ERREUR') ?>" readonly>
            </div>
        </div>
        <hr>
        Détail de l'activité
        <br>
        <br>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nom de l'activité <span class="important">*</span>
                :</label>
            <div class="col-md-4">
                <input id="NOM" name="NOM" placeholder="Nom de l'activité" class="form-control input-md" type="text"
                       value="<?= (isset($activite->NOM) ? $activite->NOM : '') ?>" required>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Détail :</label>
            <div class="col-md-4">
                <textarea id="DETAIL" name="DETAIL" placeholder="Détail" class="form-control input-md" type="text"
                          value="<?= (isset($activite->DETAIL) ? $activite->DETAIL : '') ?>"></textarea>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Adresse <span class="important">*</span> :</label>
            <div class="col-md-4">
                <input id="ADRESSE" name="ADRESSE" placeholder="ADRESSE" class="form-control input-md" type="text"
                       value="<?= (isset($activite->ADRESSE) ? $activite->ADRESSE : '') ?>" required>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Code Postal <span class="important">*</span> :</label>
            <div class="col-md-4">
                <input id="CP" name="CP" placeholder="CP" class="form-control input-md" type="text"
                       value="<?= (isset($activite->CP) ? $activite->CP : '') ?>" required>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Ville <span class="important">*</span> :</label>
            <div class="col-md-4">
                <input id="VILLE" name="VILLE" placeholder="VILLE" class="form-control input-md" type="text"
                       value="<?= (isset($activite->VILLE) ? $activite->VILLE : '') ?>" required>

            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Indications aux participants :</label>
            <div class="col-md-4">
                <textarea id="INDICATION_PARTICIPANT" name="INDICATION_PARTICIPANT" placeholder="INDICATION_PARTICIPANT"
                          class="form-control input-md" type="text"
                          value="<?= (isset($activite->INDICATION_PARTICIPANT) ? $activite->INDICATION_PARTICIPANT : '') ?>"></textarea>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Informations importantes aux participants :</label>
            <div class="col-md-4">
                <textarea id="INFO_IMPORTANT_PARTICIPANT" name="INFO_IMPORTANT_PARTICIPANT"
                          placeholder="INFO_IMPORTANT_PARTICIPANT" class="form-control input-md" type="text"
                          value="<?= (isset($activite->INFO_IMPORTANT_PARTICIPANT) ? $activite->INFO_IMPORTANT_PARTICIPANT : '') ?>"></textarea>
            </div>
        </div>


        <hr>
        Le prestataire :

        <br>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Choix du prestataire :</label>
            <div class="col-md-4">
                <select name="ID_PRESTATAIRE">
                    <?php if (isset($prestataires)) {
                        foreach ($prestataires as $p): ?>
                            <option value=<?= $p->ID; ?>><?= $p->NOM ?></option>
                        <?php endforeach;
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Type Tarif <span class="important">*</span> :</label>
            <div class="col-md-4">
                <select name="TYPE_FORFAIT" id="TYPE_FORFAIT" value="0" required onchange="changeForfait()">
                    <option value='U'>Unitaire</option>
                    <option value='F'>Forfait</option>
                </select>
            </div>
        </div>


        <!-- Si l'on séléctionne le mode Unitaire (par défaut) : -->
        <div class="form-group" id="COUT_ADULTE_SELECT">
            <label class="col-md-2 control-label" for="textinput">Coût Adulte <span class="important">*</span> :</label>
            <div class="col-md-4">
                <input id="COUT_ADULTE" name="COUT_ADULTE" placeholder="Coût par adulte" class="form-control input-md"
                       type="number" value="<?= (isset($activite->COUT_ADULTE) ? $activite->COUT_ADULTE : '') ?>">
            </div>
        </div>
        <!-- ************************************** -->


        <!-- Si l'on séléctionne le mode Forfait : -->

        <div style="display: none" class="form-group" id="TARIF_FORFAIT_SELECT">
            <label class="col-md-2 control-label" for="textinput">Coût Forfaitaire <span class="important">*</span>
                :</label>
            <div class="col-md-4">
                <input id="TARIF_FORFAIT" name="TARIF_FORFAIT" placeholder="Coût du forfait"
                       class="form-control input-md"
                       type="number" value="<?= (isset($activite->TARIF_FORFAIT) ? $activite->TARIF_FORFAIT : '') ?>">
            </div>
        </div>

        <!-- ************************************** -->


        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Ouvert enfants <span class="important">*</span>
                :</label>
            <div class="col-md-1">
                <input id="OUVERT_ENFANT_OUI" name="OUVERT_ENFANT" type="radio" value="1" checked onclick="ouvertEnfants();">
                <label for="OUVERT_ENFANT">Oui</label>

            </div>
            <div class="col-md-1">
                <input id="OUVERT_ENFANT_NON" name="OUVERT_ENFANT" type="radio" value="0" onclick="ouvertEnfants();">
                <label for="OUVERT_ENFANT">Non</label>
            </div>
        </div>

        <div class="ENFANT_FORM">
            <div class="form-group" id="COUT_ENFANT_SELECT">

                <label class="col-md-2 control-label" for="textinput">Coût Enfant <span class="important">*</span>
                    :</label>
                <div class="col-md-4">
                    <input id="COUT_ENFANT" name="COUT_ENFANT" placeholder="COUT_ENFANT"
                           class="form-control input-md" type="number"
                           value="<?= (isset($activite->COUT_ENFANT) ? $activite->COUT_ENFANT : '') ?>">
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Age minimium <span class="important">*</span>
                    :</label>
                <div class="col-md-4">
                    <input id="AGE_MINIMUM" name="AGE_MINIMUM" placeholder="AGE_MINIMUM"
                           class="form-control input-md" type="number"
                           value="<?= (isset($activite->AGE_MINIMUM) ? $activite->AGE_MINIMUM : '') ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Ouvert aux personnes extérieures <span
                        class="important">*</span> :</label>
            <div class="col-md-4">
                <select name="OUVERT_EXT" value="0">
                    <option value="1">Oui</option>
                    <option value="0">Non</option>

                </select>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Créer</button>
            </div>
        </div>
    </fieldset>
</form>
