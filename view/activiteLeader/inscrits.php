<section class="table-responsive">
    <table class="table table-bordered table-condensed table-striped">
        <!-- entête tableau -->
        <th>Liste des inscrits</th>
        <tr>
            <td>Créneau</td>
            <td>Adhérent lié</td>
            <td>Participe-t-il ?</td>
            <td>Invités</td>
            <td>Montant</td>
            <td>Gérer</td>
        </tr>

        <?php if (!empty($inscrits)) {
            foreach ($inscrits as $i){
                $date = date_create($i->DATE_CRENEAU);
            $redirect=BASE_URL . '/activiteLeader/gerer/' . $i->ID;



                ?>

            <tr>
                <td>
                    <?= date_format($date, 'd-m-Y').' - '.substr($i->HEURE_CRENEAU, 0, -3) ?>
                </td>
                <td>
                    <?= "{$i->ADN} {$i->ADP}" ?>
                </td>
                <td>
                    <?= $i->AUTO_PARTICIPATION == 1 ? 'Oui' : 'Non' ;?>
                </td>
                <td>
                    <?= $i->INN ?>
                </td>
                <td>
                    <?= "{$i->MONTANT}€"?>
                    </td>

                <td><a href="<?=
                    $redirect;
                    ?>"><button class="btn btn-primary">Gérer</button></a></td>

            </tr>
        <?php }} ?>
    </table>
<?php if (!empty($inscritsA)) { ?>
    <table class="table table-bordered table-condensed table-striped">
        <!-- entête tableau -->
        <th>Liste d'attente</th>
        <tr>
            <td>Créneau</td>
            <td>Adhérent lié</td>
            <td>Participe-t-il ?</td>
            <td>Invités</td>
            <td>Montant</td>
            <td>Gérer</td>
        </tr>


            <?php foreach ($inscritsA as $i){
                $date = date_create($i->DATE_CRENEAU);
                $redirect=BASE_URL . '/activiteLeader/gererAttente/' . $i->ID;
            ?>

            <tr>
                <td>
                    <?= date_format($date, 'd-m-Y').' - '.substr($i->HEURE_CRENEAU, 0, -3) ?>
                </td>
                <td>
                    <?= "{$i->ADN} {$i->ADP}" ?>
                </td>
                <td>
                    <?= $i->AUTO_PARTICIPATION == 1 ? 'Oui' : 'Non' ;?>
                </td>
                <td>
                    <?= $i->INN ?>
                </td>
                <td>
                    <?= "{$i->MONTANT}€"?>
                </td>

                <td><a href="<?=
                    $redirect;
                    ?>"><button class="btn btn-primary">Gérer</button></a></td>

            </tr>


    <?php }
echo "</table>";
} ?>

