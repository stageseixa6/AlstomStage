<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/adherent/archiver">

    <section class="table-responsive">

        <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">
            <! -- entête tableau -->
            <tr>
                <td>ID Adherent</td>
                <td>Mail</td>
                <td>Grade</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Genre</td>
                <td>Matricule</td>
                <td>Telephone</td>
                <td>Membre actif</td>
                <td>Date adhésion</td>
                <td>Date départ</td>
                <td>Archiver</td>
            </tr>
            <! -- valeur tableau -->
            <?php foreach ($adherent as $a): ?>

                <tr>
                    <td><a href="<?php echo BASE_URL . '/adherent/detail/' . $a->ID_ADHERENT ?>"><?= $a->ID_ADHERENT ?>
                    </td>
                    <td><?= $a->MAIL ?></td>
                    <td><?php
                        if ($a->GRADE == "M") {
                            echo 'Membre';
                        } elseif ($a->GRADE == "L") {
                            echo 'Leader';
                        } elseif ($a->GRADE == "A") {
                            echo 'Administrateur';
                        } ?>
                    </td>
                    <td><?= $a->NOM ?></td>
                    <td><?= $a->PRENOM ?></td>
                    <td><?php
                        if ($a->GENRE == "H") {
                            echo 'Homme';
                        } elseif ($a->GENRE == "F") {
                            echo 'Femme';
                        } elseif ($a->GENRE == "A") {
                            echo 'Autre';
                        } ?>
                    </td>
                    <td><?= $a->MATRICULE ?></td>
                    <td><?= ltrim($a->TELEPHONE, ':') ?></td>
                    <td><?php if ($a->MEMBRE_ACTIF == 1) {
                            echo "oui";
                        } elseif ($a->MEMBRE_ACTIF == 0) {
                            echo "non";
                        } ?></td>
                    <td><?= $a->DATE_ADHESION ?></td>
                    <td><?= $a->DATE_DEPART ?></td>
                    <td><input type="checkbox" name="ids[]" value="<?= $a->ID_ADHERENT ?>"></td>


                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <div class="form-group">
        <label class="col-md-2 control-label" for="singlebutton"></label>
        <div class="col-md-4">
            <button id="singlebutton" name="singlebutton" class="btn btn-info">Archiver</button>
        </div>
    </div>
</form>
<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/adherent/importer">
    <div class="form-group" style="visibility: hidden"> <!-- Permet de faire l'import en masse -->
        <label class="col-md-2 control-label" for="singlebutton"></label>
        <div class="col-md-4">
            <button id="singlebutton" name="singlebutton" class="btn btn-info">Valider l'importation des nouveaux adhérents</button>
        </div>
    </div>
</form>
