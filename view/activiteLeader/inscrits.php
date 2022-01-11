<section class="table-responsive">
    <table class="table table-bordered table-condensed table-striped">
        <!-- entête tableau -->
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
        if($i->ATTENTE == 1) {
            $redirect=BASE_URL . '/activiteLeader/gererAttente/' . $i->ID;
        }
        else{
            $redirect=BASE_URL . '/activiteLeader/gerer/' . $i->ID;
        }

                ?>

            <tr>
                <td>
                    <?= date_format($date, 'd-m-Y').' - '.substr($i->HEURE_CRENEAU, 0, -3) ?>
                </td>
                <td>
                    <?= "{$i->ADN} {$i->ADP}" ?>
                </td>
                <td>
                    <?= $i->AUTO_PARTICIPATION == 1 ? 'Oui' : 'Non' ;
                    if($i->ATTENTE == 1) echo(" (en liste d'attente)") ;?>
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