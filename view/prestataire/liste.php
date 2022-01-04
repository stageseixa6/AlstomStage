<form class="form-horizontal" method="post" action="<?=BASE_URL?>/prestataire/supprimer">

<section class="table-responsive">
<table id="liste_tournoi" class="table table-bordered table-condensed table-striped">
    <! -- entête tableau -->
     <tr>
                    <td>ID Prestataire</td>
                    <td>Nom</td>
                    <td>Mail</td>
                    <td>Telephone</td>
                    <td>Adresse </td>
                    <td>Code postal</td>
                    <td>Ville</td>
                </tr>
     <! -- valeur tableau -->
<?php foreach ($prestataire as $p): ?>
                <tr>
                    <td> <a href="<?php echo BASE_URL . '/prestataire/detail/' . $p->ID ?>"><?= $p->ID ?></td>
                    <td><?= $p->NOM ?></td>
                    <td><?= $p->MAIL ?></td>
                    <td><?= ltrim($p->TEL, ':') ?></td>
                    <td><?= $p->ADRESSE ?></td>
                    <td><?= $p->CP ?></td>
                    <td><?= $p->VILLE ?></td>
                    <td><input type="checkbox" name="ids[]" value="<?= $p->ID ?>"></td>            
                   


                </tr>
            <?php endforeach; ?>
</table>
</section>
  
<div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Supprimer</button>
            </div>
        </div>
