<section class="table_responsive">
    <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">
        <td>Nom activité</td>
        <td>Détail</td>
        <td>Ville</td>
        <!--<td>Date de l'activité</td>-->
        <?php foreach ($activites as $a): ?>   
            <tr>

                <td><?= $a->NOM ?></td>
                <td><?= $a->DETAIL ?></td>
                <td><?= $a->VILLE ?></td>
                <!-- <td><?= $a->DATE_ACTIVITE ?></td> -->
                <td><button id="singlebutton" name="singlebutton" class="btn btn-info" onclick="window.location.href = '/activite/consulter/<?= $a->ID_ACTIVITE ?>'">Voir</button></td>
                <td><button id="singlebutton" name="singlebutton" class="btn btn-info" onclick="window.location.href = '/activite/formulaireInscription/<?= $a->ID_ACTIVITE ?>'">S'inscrire</button></td>
            </tr>

        <?php endforeach; ?>
    </table>
</section>
