

<!-- Form Name -->
<legend>Amicale des cadres ALSTOM</legend>
<!-- Text input-->
Page d'accueil <br>
Blog présentant les activités : <a href="http://amicadreslrh.blogspot.com/">http://amicadreslrh.blogspot.com/</a><br>

<?php
if (null !== Session::get('STATUT_TMP')){
    echo 'Vous êtes connecté en tant que ' . Session::get('STATUT_TMP');
}

?>

