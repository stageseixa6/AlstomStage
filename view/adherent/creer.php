<form class="form-horizontal" method="post" action="<?=BASE_URL?>/adherent/nouveauAdherent">
    <fieldset>
        <legend>Créer un adherent</legend>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Adresse Mail <span class="important">*</span> : </label>  
            <div class="col-md-4">
                <input id="MAIL" name="MAIL" class="form-control input-md" type="text" value="" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nom <span class="important">*</span> : </label>  
            <div class="col-md-4">
                <input id="NOM" name="NOM" class="form-control input-md" type="text" value="" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Prenom <span class="important">*</span> : </label>  
            <div class="col-md-4">
                <input id="PRENOM" name="PRENOM" class="form-control input-md" type="text" value="" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Grade <span class="important">*</span> : </label>  
            <div class="col-md-4">
                <select name="GRADE">
                    <option value="M">Adherent</option>
                    <option value="L">Leader</option>
                    <option value="A">Administrateur</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Genre <span class="important">*</span> : </label>  
            <div class="col-md-4">
                <select name="GENRE">
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                    <option value="A">Autre</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Matricule : </label>  
            <div class="col-md-4">
                <input id="MATRICULE" name="MATRICULE" class="form-control input-md" type="text" value="" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Telephone : </label>  
            <div class="col-md-4">
                <input id="TELEPHONE" name="TELEPHONE" class="form-control input-md" type="text" value="" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Créer</button>
            </div>
        </div>
    </fieldset>
</form>
