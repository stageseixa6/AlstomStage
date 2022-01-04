<div class="alert-info" name="info"><?= (isset($info) ? $info : '') ?></div> <br>
<section class="table_responsive">
    <h2>Les activités auxquelles vous êtes inscrits</h2>
    <table class="table table-bordered table-condensed table-striped">
        <tr>
        <td>Nom</td>   
        <td>Détail</td>
        <td>Ville</td>
        <td>Date du créneau</td>
        <td>information importante</td>
        <td>Montant</td>
        <td>Voir</td>
        <td>Se désinscrire</td>
        </tr>
        <?php foreach ($inscription as $ia):
            $date = date_create($ia->DATE_CRENEAU);
            ?>
            <tr>

                <td><?= $ia->NOM ?></td>
                <td><?= $ia->DETAIL ?></td>
                <td><?= $ia->VILLE ?></td>
                <td><?= 'Le '.date_format($date, 'd-m-Y').' à '.substr($ia->HEURE_CRENEAU, 0, -3) ?></td>
                <td><?= $ia->INDICATION_PARTICIPANT?></td>
                <td><?= $ia->MONTANT . " €"?></td>
                <td><button id="singlebutton" name="singlebutton" class="btn btn-info" onclick="window.location.href = '../activite/mesActivites/<?= $ia->ID_ACTIVITE?>'">Voir</button></td>
                <td><button class="btn btn-danger" onclick="alert(`Si vous souhaitez vous désinscrire de cette activité, veuillez contacter le leader de celle-ci : <?= $ia->an . ' ' . $ia->ap ?>`)">Se désinscrire</button></td>
            </tr>

        <?php endforeach; ?>
    </table>
</section>
