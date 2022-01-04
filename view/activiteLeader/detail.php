<form class="form-horizontal" method="post"
      action="<?= BASE_URL ?>/activiteLeader/<?= (isset($action) ? 'creer' : 'modifier') ?>/<?= (isset($activite->ID_ACTIVITE) ? $activite->ID_ACTIVITE : '') ?>">

    <fieldset>

        <!-- Form Name -->
        <legend>Activité</legend>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Leader de l'activité :</label>
            <div class="col-md-4">
                <input id="LEADER" name="LEADER" placeholder="Leader de l'activité" class="form-control input-md"
                       type="NOM_LEADER"
                       value="<?= (isset($leader->NOMLEADER) ? $leader->NOMLEADER : '') ?> <?= (isset($leader->PRENOMLEADER) ? $leader->PRENOMLEADER : '') ?>"
                       disabled>
            </div>
        </div>

        <hr>
        Détails de l'activité
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
                <textarea id="DETAIL" name="DETAIL" placeholder="Détail" class="form-control input-md"
                          type="text"><?= (isset($activite->DETAIL) ? $activite->DETAIL : '') ?></textarea>

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
                          class="form-control input-md"
                          type="text"><?= (isset($activite->INDICATION_PARTICIPANT) ? $activite->INDICATION_PARTICIPANT : '') ?></textarea>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Informations importantes aux participants :</label>
            <div class="col-md-4">
                <textarea id="INFO_IMPORTANT_PARTICIPANT" name="INFO_IMPORTANT_PARTICIPANT"
                          placeholder="INFO_IMPORTANT_PARTICIPANT" class="form-control input-md"
                          type="text"><?= (isset($activite->INFO_IMPORTANT_PARTICIPANT) ? $activite->INFO_IMPORTANT_PARTICIPANT : '') ?></textarea>
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Statut <span class="important">*</span> :</label>
            <div class="col-md-4">
                <select name="STATUT">
                    <option value="A"<?php if ($activite->STATUT == "A") {
            echo "selected";
        } ?>>1- En attente</option>
                    <option value="V"<?php if ($activite->STATUT == "V") {
            echo "selected";
        } ?>>2- Validé</option>
                    <option value="O"<?php if ($activite->STATUT == "O") {
            echo "selected";
        } ?>>3- Ouvert</option>
                    <option value="F"<?php if ($activite->STATUT == "F") {
            echo "selected";
        } ?>>4- Fermé</option>
                    <option value="T"<?php if ($activite->STATUT == "T") {
            echo "selected";
        } ?>>5- Terminé</option>
                </select>
            </div>
        </div> -->

        <hr>
        Le prestataire :

        <br>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Choix du prestataire :</label>
            <div class="col-md-4">
                <select name="ID_PRESTATAIRE">
                    <?php if (isset($prestataires)) {
                        foreach ($prestataires as $p): ?>
                            <option <?= $activite->ID_PRESTATAIRE == $p->ID ? 'selected' : '' ?> value=<?= $p->ID; ?>><?= $p->NOM ?></option>
                        <?php endforeach;
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Type Tarif <span class="important">*</span> :</label>
            <div class="col-md-4">
                <select name="TYPE_FORFAIT" id="TYPE_FORFAIT" required onchange="changeForfait()">
                    <option value='U'<?php if ($activite->FORFAIT == 'U') echo ' selected' ?>>Unitaire</option>
                    <option value='F'<?php if ($activite->FORFAIT == 'F') echo ' selected' ?>>Forfait</option>
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
                <input id="OUVERT_ENFANT_OUI" name="OUVERT_ENFANT" type="radio" value="1"
                    <?php if ($activite->AGE_MINIMUM < 18) echo 'checked'; ?>
                       onclick="ouvertEnfants();">
                <label for="OUVERT_ENFANT">Oui</label>

            </div>
            <div class="col-md-1">
                <input id="OUVERT_ENFANT_NON" name="OUVERT_ENFANT" type="radio"
                       value="0" <?php if ($activite->AGE_MINIMUM >= 18) echo 'checked'; ?> onclick="ouvertEnfants();">
                <label for="OUVERT_ENFANT">Non</label>
            </div>
        </div>

        <div style='display: <?php if ($activite->AGE_MINIMUM >= 18) echo 'none'; else echo 'block'; ?>'
             class="ENFANT_FORM">
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
            <label class="col-md-2 control-label" for="textinput">Ouvert aux personnes extérieur <span
                        class="important">*</span> :</label>
            <div class="col-md-4">
                <select name="OUVERT_EXT" id="OUVERT_EXT" value="0" onchange="ouvertExt();">
                    <option value="1"<?php if ($activite->OUVERT_EXT == '1') echo ' selected' ?>>Oui</option>
                    <option value="0"<?php if ($activite->OUVERT_EXT == '0') echo ' selected' ?>>Non</option>

                </select>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Valider les modifications</button>
            </div>
        </div>
    </fieldset>
</form>


<!-- Ancien form -->
