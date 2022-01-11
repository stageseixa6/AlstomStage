<section class="table-responsive">
    <div id="couleur">
        <div id="jaune"></div><p>En attente</p>
        <div id="bleu"></div><p>Validé</p>
        <div id="vert"></div><p>Ouvert</p>
        <div id="rouge"></div><p>Fermé</p>
        <div id="blanc"></div><p>Terminé</p>
        <div id="noir"></div><p>Annulé</p>
    </div>
    <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">
        <!-- entête tableau -->
        <tr>
            <td></td>
            <td>Nom</td>
            <td>Detail</td>
            <td>Ville</td>
            <td>Statut</td>
            <td>Créneaux</td>
        </tr>
        <!-- valeur tableau -->
        <?php foreach ($activite as $a): ?>
            <tr>
                <td> <a href="<?php echo BASE_URL . '/activiteLeader/detail/' . $a->ID_ACTIVITE ?>">Modifier</a> <br>
                    <a href="<?php echo BASE_URL . '/activiteLeader/inscrits/' . $a->ID_ACTIVITE ?>">Inscriptions</a><br>
                    <a href ="<?php echo BASE_URL . '/activiteLeader/inscrits/mail'?>">Envoyer mail</a>
                </td>
                <td><?= $a->NOM ?></td>
                <td><?= $a->DETAIL ?></td>

                <td><?= $a->VILLE ?></td>

                <td><?php
                    if ($a->STATUT == "A") {
                        echo 'En attente de validation';
                    } elseif ($a->STATUT == "V") {
                        ?> <a class="important" href="<?= BASE_URL . '/activiteLeader/ouvrir/' . $a->ID_ACTIVITE ?>">Ouvrir</td> <?php
                        // Si validée, on peut ouvrir
                    } elseif ($a->STATUT == "O") {

                        echo 'Ouverte';
                    } elseif ($a->STATUT == "F") {
                        echo 'Fermée';
                    } elseif ($a->STATUT == "T") {
                        echo 'Terminée';
                    } ?>
                </td>


                <td>
                    <?php
                    foreach ($creneau as $c) {
                        if ($a->ID_ACTIVITE == $c->ID_ACTIVITE) {
                            $date = date_create($c->DATE_CRENEAU);
                            echo '<button id="singlebutton" name="singlebutton" class="btn btn-' . (($c->STATUT) == 'A' ? 'warning' : ($c->STATUT == 'V' ? 'info' :($c->STATUT=='S'? 'noir': ($c->STATUT == 'O' ? 'success' : ($c->STATUT == 'F' ? 'danger' : ($c->STATUT == 'T' ? 'secondary' : 'secondary')))))) . '" onclick="window.location.href=\'' . '/activiteLeader/formulaireCreneau/' . $id['idActivite'] = $a->ID_ACTIVITE . $id['idCreneau'] = (isset($c->NUM_CRENEAU) ? '_' . $c->NUM_CRENEAU : '') . '\'">' . date_format($date, 'd-m-Y') . ' - ' . substr($c->HEURE_CRENEAU, 0, -3) . '</button>';
                        }
                    }
                    echo '<button id="singlebutton" name="singlebutton" class="btn btn-info" onclick="window.location.href=\'' . '/activiteLeader/formulaireCreneau/' . $a->ID_ACTIVITE . '\'">+</button>';
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </form>
</section>

