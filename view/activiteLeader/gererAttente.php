<legend>Déplacer vers un autre créneau</legend>
<form class="form-horizontal" method="post"
      action="<?= BASE_URL ?>/activiteLeader/deplacerCreneau/<?= $donnees->ID ?>">
    <div class="form-group">
        <label class="col-md-2 control-label" for="textinput">Créneau :</label>
        <div class="col-md-3" id="creneau">

            <select name="CRENEAU" id="creneau">
                <?php if (!empty($creneaux)) {
                    foreach ($creneaux as $creneau):
                        $date = date_create($creneau->DATE_CRENEAU);
                        ?>

                        <option <?= $donnees->CRENEAU == $creneau->NUM_CRENEAU ? ' selected ' : '' ?> value="<?= $creneau->NUM_CRENEAU ?>"><?= 'Le ' . date_format($date, 'd-m-Y') . ' à ' . substr($creneau->HEURE_CRENEAU, 0, -3) ?></option>
                    <?php endforeach;
                } else {
                    ?>
                    <option selected disabled value="">Il n'y a pas de créneau pour le moment.</option>
                    <?php
                } ?>
            </select>
        </div>

    </div>
    <div class="form-group">
        <div class="col-md-3" id="creneau">
            <button id="singlebutton" name="singlebutton" class="btn btn-info">Valider les changements</button>

        </div>

    </div>
</form>

<br>

<legend>Passer en liste principale</legend>
<form method="POST" action="<?= BASE_URL . '/activiteLeader/passagePrincipale/' . $donnees->ID_ACTIVITE ?>">
    <input id="creneau" name="creneau" type="hidden" value="<?= $donnees->CRENEAU ?>">
    <input id="id" name="id" type="hidden" value="<?= $donnees->ID ?>">
    <input id="idadh" name="idadh" type="hidden" value="<?= $donnees->ID_ADHERENT ?>">
    <button class="btn btn-success">Valider le passage en liste principale</button>

</form>

<br>
<legend>Désinscrire l'adhérent</legend>
<form method="POST" action="<?= BASE_URL . '/activiteLeader/desinscrire/' . $donnees->ID ?>">

    <label for="desinscrire">Cette action est irreversible</label>
    <button id="desinscrire" class="btn btn-danger">Désinscrire</button>

</form>
