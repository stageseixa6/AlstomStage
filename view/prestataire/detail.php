<!-- Form Name -->
<legend>Amicale des cadres ALSTOM</legend>
<?php // $title_for_layout = $tournoi->nomtournoi ?>
<form class="form-horizontal" method="post" action="<?=BASE_URL?>/prestataire/<?=(isset($action)?'creer':'modifier')?>/<?= (isset($prestataire->ID) ? $prestataire->ID : '') ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Modification du prestataire</legend>
        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Code prestataire :</label>  
            <div class="col-md-1">
                <input id="ID" name="ID"  disabled class="form-control input-md" type="text" value="<?= (isset($prestataire->ID) ? $prestataire->ID : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput"> Nom du prestataire <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="NOM" name="NOM" placeholder="NOM" class="form-control input-md" type="text" value="<?= (isset($prestataire->NOM) ? $prestataire->NOM : '') ?>">
            </div>
        </div>

         <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Adresse mail <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="MAIL" name="MAIL" placeholder="MAIL" class="form-control input-md" type="text" value="<?= (isset($prestataire->MAIL) ? $prestataire->MAIL : '') ?>">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Téléphone <span class="important">*</span> :</label> 
            <div class="col-md-4">
                <input id="TEL" name="TEL" placeholder="TEL " class="form-control input-md" type="text" value="<?= (isset($prestataire->TEL) ? ltrim($prestataire->TEL, ':') : '') ?>">
            </div>
        </div>
         <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Adresse <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="ADRESSE" name="ADRESSE" placeholder="ADRESSE" class="form-control input-md" type="text" value="<?= (isset($prestataire->ADRESSE) ? $prestataire->ADRESSE : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Code postal <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="CP" name="CP" placeholder="CP" class="form-control input-md" type="text" value="<?= (isset($prestataire->CP) ? $prestataire->CP : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Ville <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="VILLE" name="VILLE" placeholder="VILLE" class="form-control input-md" type="text" value="<?= (isset($prestataire->VILLE) ? $prestataire->VILLE : '') ?>">

            </div>
        </div>
        <!-- Button -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Modifier</button>
            </div>
        </div>
    </fieldset>
</form>
<div class="alert-info" name="info"><?= (isset($info) ? $info : '') ?></div>
