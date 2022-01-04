<legend>Amical des cadres ALSTOM</legend>
<form class="form-horizontal">
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
                <?php /* if (!empty($position)) {
                    if ($position != 0) {?>
                        <tr class="important">
                            <td class="text-right"><strong>Votre place dans la file d'attente :</strong></td>
                            <td class="pl-3">n°<?= $position ?></td>
                        </tr>
                    <?php }
                } */ ?>
                <tr class="important">
                    <td class="text-right"><strong>Montant à régler :</strong></td>
                    <td class="pl-3"><?= (isset($inscription->MONTANT) ? $inscription->MONTANT : '') ?> €</td>
                </tr>
                <tr class="important">

                    <td class="text-right"><strong>Date limite de paiement :</strong></td>
                    <td class="pl-3">
                        <?= isset($creneau->DATE_PAIEMENT) ? date_format(date_create($creneau->DATE_PAIEMENT), 'd-m-Y') : '' ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Mon inscription :</strong></td>
                    <td class="pl-3">
                        <?php if ($inscription->AUTO_PARTICIPATION == 1) $participants[] = Session::get('NOM') . ' ' . Session::get('PRENOM');
                        $participants[]="";
                        foreach ($invites as $invite) : $participants[] = "{$invite->NOM} {$invite->PRENOM}"; endforeach;
                        echo implode(', ', $participants);
                        ?>
                    </td>
                </tr>


                <tr>
                    <td class="text-right"><strong>Payé le :</strong></td>
                    <td class="pl-3">

                        <?php
                        $datep = date_create($inscription->DATE_PAIEMENT);
                        ?>

                        <?php if ($inscription->PAYE == 1) {
                            echo 'Payé le ' . date_format($datep, 'd-m-Y');
                        } elseif ($inscription->PAYE == 0) {
                            echo "Vous n'avez pas encore payé";
                        } ?>
                    </td>
                </tr>


            </table>
            <table id="liste_tournoi" class="table table-bordered table-condensed table-striped">

    </fieldset>
</form>
