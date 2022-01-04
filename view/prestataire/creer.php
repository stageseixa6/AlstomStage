<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/prestataire/nouveau">

    <fieldset>

        <!-- Form Name -->
        <legend>Prestataire</legend>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nom du prestataire <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="NOM" name="NOM" placeholder="Nom" class="form-control input-md" type="text" value="<?= (isset($prestataire->NOM) ? $prestataire->NOM : '') ?>">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Mail <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="MAIL" name="MAIL" placeholder="MAIL" class="form-control input-md" type="text" value="<?= (isset($prestataire->MAIL) ? $prestataire->MAIL : '') ?>">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Téléphone <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="TEL" name="TEL" placeholder="TEL" class="form-control input-md" type="text" value="<?= (isset($prestataire->TEL) ? $prestataire->TEL : '') ?>">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Adresse <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="ADRESSE" name="ADRESSE" placeholder="Adresse" class="form-control input-md" type="text" value="<?= (isset($prestataire->ADRESSE) ? $prestataire->ADRESSE: '') ?>">

            </div>
        </div>
      
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Code Postal <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="CP" name="CP" placeholder="CP" class="form-control input-md" type="text" value="<?= (isset($prestataire->CP) ? $prestataire->CP : '') ?>">

            </div>
        </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Ville <span class="important">*</span> :</label>  
            <div class="col-md-4">
                <input id="VILLE" name="VILLE" placeholder="VILLE" class="form-control input-md" type="text" value="<?= (isset($prestataire->VILLE) ? $prestataire->VILLE : '') ?>">

            </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Créer</button>
            </div>
        </div>
    </fieldset>
</form>
