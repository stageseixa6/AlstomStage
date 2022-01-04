<div class="alert-info" name="info"><?= (isset($info) ? $info : '') ?></div> <br>
<section class="table-responsive">
    <div id="couleur">
        <div id="jaune"></div><p>En attente</p>
        <div id="bleu"></div><p>Validé</p>
        <div id="vert"></div><p>Ouvert</p>
        <div id="rouge"></div><p>Fermé</p>
        <div id="blanc"></div><p>Terminé</p>
        <div id="noir"></div><p>Annulé</p>
    </div>
    <form  class="form-horizontal" method="POST" action="<?= BASE_URL ?>/activiteAdmin/archivage">
  
    <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">
        <!-- entête tableau -->
        <tr>
            <td></td>
            <td>Nom</td>
            <td>Detail</td>
            <td>Ville</td>
            <td>Statut</td>
            <td>Liste créneaux</td>
            <td>Archiver</td>
        </tr>

        <!-- valeur tableau -->           
        <?php foreach ($activite as $a): ?>
            <tr>
                <td> <a href="<?php echo BASE_URL . '/activiteAdmin/detail/' . $a->ID_ACTIVITE ?>">Modifier</td>
                <td><?= $a->NOM ?></td>
                <td><?= $a->DETAIL ?></td>
                <td><?= $a->VILLE ?></td>
                <td><?php
                            if ($a->STATUT == "A"){
                                echo 'En Attente';
                            }
                            elseif ($a->STATUT == "V"){
                                echo 'Validée';
                            }
                            elseif ($a->STATUT == "O"){
                                echo 'Ouvert';
                            }
                            elseif ($a->STATUT == "F"){
                                echo 'Fermée';
                            }
                            elseif ($a->STATUT == "T"){
                                echo 'Terminée';
                            } ?>
                </td>
                <td>
                    <?php
                    foreach ($creneau as $c) {
                        if ($a->ID_ACTIVITE == $c->ID_ACTIVITE) {
                            $date = date_create($c->DATE_CRENEAU);
                            echo '<input type="button" id="singlebutton" name="singlebutton" class="btn btn-'. (($c->STATUT)=='A'? 'warning' : ($c->STATUT=='V'? 'info':($c->STATUT=='S'? 'noir':($c->STATUT=='O'?'success':($c->STATUT=='F'?'danger':($c->STATUT=='T'?'secondary':'secondary'))))) ) .'" onclick="window.location.href=\'' . BASE_URL . '/activiteAdmin/formulaireCreneau/' . $id['idActivite']=$a->ID_ACTIVITE .  $id['idCreneau']=(isset($c->NUM_CRENEAU) ? '_'.$c->NUM_CRENEAU : ''). '\'" value="' . date_format($date, 'd-m-Y') . ' - ' . substr($c->HEURE_CRENEAU, 0, -3) . '">';
                        }
                    }
                    echo '<input type="button" id="singlebutton" name="singlebutton" class="btn btn-info" onclick=window.location.href=\'' . BASE_URL . '/activiteAdmin/formulaireCreneau/' . $a->ID_ACTIVITE . '\' value="+">';
                    ?>
                </td>                
                <td><input type="checkbox" name="ids[]" value="<?= $a->ID_ACTIVITE ?>"></td>
            </tr>
        <?php endforeach; ?>                
    </table>
    <input type="submit" name="archiver" value="Archiver">
    </form>
</section>

