<?php
if (null !== Session::get('STATUT_TMP')) {
    echo "Selectionner l'interface que vous souhaitez utiliser<br><br>";
} else {
    echo '<legend>Vous êtes connecté, bienvenue ' . Session::get('PRENOM') . '</legend>';
}
?>
Choisissez votre menu : <br><br>
<?php
$grade = Session::get('GRADE');

if (($grade == 'M') OR ( $grade == 'L') OR ( $grade == 'A')) {
    echo '<td><button id="singlebutton" name="singlebutton" class="btn btn-info" onclick="window.location.href=\'../menuAdherent/accueil\'">Adhérent</button></td>';
}
if (($grade == 'L') OR ( $grade == 'A')) {
    echo '<td><button id="singlebutton" name="singlebutton" class="btn btn-info" onclick="window.location.href=\'../menuLeader/accueil\'">Leader</button></td>';
}
if (($grade == 'A')) {
    echo '<td><button id="singlebutton" name="singlebutton" class="btn btn-info" onclick="window.location.href=\'../menuAdministrateur/accueil\'">Administrateur</button></td>';
}
?>
