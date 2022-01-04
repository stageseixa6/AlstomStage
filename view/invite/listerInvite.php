<section class="table-responsive">
    <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">
        <!-- entête tableau -->
        <tr>
            <td></td>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Statut</td>
            <td>Date de naissance</td>
            <td>Numéro de téléphone</td>
            <td>Supprimer l'invité</td>
        </tr>
        <!-- valeur tableau -->
        <?php if (isset($invites)){
        foreach ($invites as $invite):
        $date = date_create($invite->DATE_NAISSANCE);?>
        <tr>
            <td> <a href="<?php echo BASE_URL . '/invite/modifier/' . $invite->ID_PERS_EXTERIEUR ?>"><button class="btn btn-primary">Modifier</button></a></td>
            <td><?= $invite->NOM ?></td>
            <td><?= $invite->PRENOM ?></td>
            <td><?= ucfirst(strtolower($invite->STATUT)) ?></td>
            <td><?= date_format($date, 'd-m-Y') ?></td>
            <td><?= ltrim($invite->TELEPHONE, ':') ?>

            </td>
            <td><a href="<?php echo BASE_URL . '/invite/supprimer/' . $invite->ID_PERS_EXTERIEUR ?>"><button class="btn btn-danger">Supprimer</button></a> </td>
            <?php endforeach; } ?>
        </tr>
    </table>
    <a href="<?= BASE_URL ?>/invite/creer">
        <button class="btn button btn-info">Créer un nouvel invité</button>
    </a>
</section>
