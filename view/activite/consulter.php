<legend>Amicale des cadres ALSTOM</legend>

<fieldset>
    <section class="table_responsive">
        <table class="mx-auto" style="border-spacing : 20px;border-collapse : separate;">

            <legend>Consulter une activité</legend>


            <!-- Leader de l'activité -->
            <tr class="">
                <td class="text-right "><strong>Leader de l'activité :</strong></td>
                <td disabled
                    class="pl-3">  <?= (isset($leader->NOMLEADER) ? $leader->NOMLEADER : '') ?> <?= (isset($leader->PRENOMLEADER) ? $leader->PRENOMLEADER : '') ?></td>
            </tr>
            <!-- Nom de l'activité -->
            <tr>
                <td class="text-right"><strong>Nom de l'activité :</strong></td>
                <td class="pl-3"><?= (isset($donnees->NOM) ? $donnees->NOM : '') ?></td>
            </tr>
            <!-- Detail de l'activité -->
            <tr>
                <td class="text-right"><strong>Detail de l'activité :</strong></td>
                <td class="pl-3"><?= (isset($donnees->DETAIL) ? $donnees->DETAIL : '') ?></td>
            </tr>
            <!-- Adresse de l'activité -->
            <tr>
                <td class="text-right"><strong>Adresse :</strong></td>
                <td class="pl-3"><?= (isset($donnees->ADRESSE) ? $donnees->ADRESSE : '') ?></td>
            </tr>
            <!-- Code postale -->
            <tr>
                <td class="text-right"><strong>Code Postale :</strong></td>
                <td class="pl-3"><?= (isset($donnees->CP) ? $donnees->CP : '') ?></td>
            </tr>
            <!--  Ville de l'activité -->
            <tr>
                <td class="text-right"><strong>Ville :</strong></td>
                <td class="pl-3"><?= (isset($donnees->VILLE) ? $donnees->VILLE : '') ?></td>
            </tr>
            <!-- Age Minimum -->
            <tr>
                <td class="text-right"><strong>Age Minimum :</strong></td>
                <td class="pl-3"><?= (isset($donnees->AGE_MINIMUM) ? $donnees->AGE_MINIMUM . " ans" : '') ?></td>
            </tr>
            <!-- Indications aux participants -->
            <tr>
                <td class="text-right"><strong>Indications aux participants :</strong></td>
                <td class="pl-3"><?= (isset($donnees->INDICATION_PARTICIPANT) ? $donnees->INDICATION_PARTICIPANT : '') ?></td>
            </tr>
            <!-- Info Importante aux participants -->
            <tr>
                <td class="text-right"><strong>Informations Importantes aux Participants :</strong></td>
                <td class="pl-3"><?= (isset($donnees->INFO_IMPORTANT_PARTICIPANT) ? $donnees->INFO_IMPORTANT_PARTICIPANT : '') ?></td>
            </tr>


        </table>
        <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">

            <div class="form-group">
                <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">
                    <td>Prix Adulte</td>
                    <td>Prix Enfant</td>
                    <td>Prix Adulte Extérieur</td>
                    <td>Prix Enfant Extérieur</td>
                    <tr>
                        <td><?= $donnees->PRIX_ADULTE . "  €" ?></td>
                        <td><?= $donnees->AGE_MINIMUM < 18 ? $donnees->PRIX_ENFANT . "  €"  : 'Activité non ouverte aux enfants'?></td>
                        <td><?= $donnees->OUVERT_EXT == 1 ? $donnees->PRIX_ADULTE_EXT . "  €" : 'Activité non ouverte aux externes'?></td>
                        <td><?= $donnees->AGE_MINIMUM < 18 && $donnees->OUVERT_EXT == 1 ? $donnees->PRIX_ENFANT_EXT . "  €"  : 'Activité non ouverte aux enfants externes'?></td>
                    </tr>
                </table>
            </div>

            <br>
            Liste des Créneaux
            <hr>
            <div class="form-group">
                <table class="table table-bordered table-condensed table-striped">
                    <td>Date</td>
                    <td>Heure</td>
                    <td>Participants</td>
                    <td>Effectif</td>
                    <?php if (isset($inscrits)) {
                        foreach ($inscrits as $c) :
                            $date = date_create($c->DATE_CRENEAU);
                            ?>
                            <tr>
                                <td><?= date_format($date, 'd-m-Y') ?></td>
                                <td><?= substr($c->HEURE_CRENEAU, 0, -3) ?></td>
                                <td>

                                    <?php
                                    var_dump($c->adh);
                                    var_dump($c->listeinv);

                                    if (!empty($c->adh)) {
                                        if (!empty($c->listeinv)) {
                                            echo $c->listeinv . '<br>';
                                        }
                                        echo $c->adh;
                                    } else {
                                        echo $c->listeinv;
                                    }


                                    ?>
                                </td>
                                <td><?= "{$c->effectif}/{$c->EFFECTIF_CRENEAU}" ?></td>
                            </tr>
                        <?php endforeach;
                    } ?>

                </table>
            </div>
</fieldset>

<div>
    <button id="singlebutton" name="singlebutton" class="btn btn-info"
            onclick="window.location.href = '../../activite/formulaireInscription/<?= $donnees->ID_ACTIVITE ?>'">
        S'inscrire
    </button>
</div>
<div class="alert-info" name="info"><?= (isset($info) ? $info : '') ?></div>