<?php

// Vérification connexion :
if(!isset($_SESSION['ID_ADHERENT'])){
    //header('Location: ' . BASE_URL . '/connexion/connexion');
    $current_page = explode("/", $_SERVER['REQUEST_URI']);
    if (!($current_page[1] == 'connexion' && $current_page[2] == 'connexion')){
        header('Location: ' . BASE_URL . '/connexion/connexion');
    }
}else{
    // Si il faut changer le mot de passe :
    if (password_verify('achanger', Session::get('PASSWORD'))){
        $current_page = explode("/", $_SERVER['REQUEST_URI']);
        if (!($current_page[1] == 'connexion' && $current_page[2] == 'changepassword')){
            header('Location: ' . BASE_URL . '/connexion/changepassword');
        }
    }
}


?>

<!DOCTYPE html>

<!--test sur les téléphones portables -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?php echo isset($title_for_layout) ? $title_for_layout : 'Amicale des cadres ALSTOM'; ?></title>
    <link href='<?php echo BASE_SITE . DS . '/css/bootstrap/css/bootstrap.css' ?>' rel="stylesheet">
    <link href='<?php echo BASE_SITE . DS . '/css/style.css' ?>' rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /* Style pour l'exemple*/

    </style>
</head>
<body class="container">


<header>
    <div class="row hidden-xs" id="header_img"></div>
    <h1 class="row"> Amicale des cadres ALSTOM </h1>
</header>

<ul class="nav navbar-nav">
    <li class="active"><a href="<?= BASE_URL ?>/accueil/detail"> Accueil </a></li>
    <?php
    if (null !== Session::get('STATUT_TMP')) {
        // En tant qu'Adhérent
        if (Session::get('STATUT_TMP') == 'Adherent') {
            echo '<li><a href="' . BASE_URL . '/activite/listerActivite"> Activités à venir </a> </li>';
            echo '<li><a href="' . BASE_URL . '/activite/listerActiviteInscrit"> Mes activités </a> </li>';
            echo '<li><a href="' . BASE_URL . '/adherent/consultercompte"> Mon compte </a> </li>';
            echo '<li><a href="' . BASE_URL . '/invite/listerInvite"> Gestion des invités </a> </li>';


        } // En tant que Leader
        elseif (Session::get('STATUT_TMP') == 'Leader' && (Session::get('GRADE') == 'L' || Session::get('GRADE') == 'A')) {
            echo '<li><a class="dropdown-item d-sm-block d-md-none" href="' . BASE_URL . '/activiteLeader/creer">Créer activité</a></br>'
                . '<li><a class="dropdown-item d-sm-block d-md-none" href="' . BASE_URL . '/activiteLeader/liste">Mes activités créées</a></br>';


            // En tant qu'Administrateur
        } elseif (Session::get('STATUT_TMP') == 'Administrateur') {
            echo '<li><a class="dropdown-item" href="' . BASE_URL . '/activiteAdmin/liste">Afficher les activités</a></li>'
                . '<li><a class="dropdown-item d-sm-block d-md-none" href="' . BASE_URL . '/adherent/liste">Lister adherent</a></br>'
                . '<li><a class="dropdown-item d-sm-block d-md-none" href="' . BASE_URL . '/adherent/creer">Créer adherent</a></br>'
                . '<li><a class="dropdown-item d-sm-block d-md-none" href="' . BASE_URL . '/prestataire/creer">Créer prestataire</a></br>'
                . '<li><a class="dropdown-item d-sm-block d-md-none" href="' . BASE_URL . '/prestataire/liste">Liste des prestataires</a></br>';
        }
    }
    ?>

    <!--  <li ><a href="<?= BASE_URL ?>/contact"> Contact</a> </li> -->
    <?php
    if (null !== Session::get('ID_ADHERENT')) {
        if (null !== Session::get('STATUT_TMP')) {
            echo '<li><td><button id = "singlebutton" name = "singlebutton" class = "btn btn-info" onclick="window.location.href=\'' . '/connexion/accueil\'">' . Session::get('STATUT_TMP') . '</button></td></il>';
        }
        echo '<li ><a href="' . '/connexion/deconnexion" class="pull-righ"> Déconnexion </a> </li>';
    } else {
        echo '<li ><a href="' . '/connexion/connexion"> Connexion </a> </li>';
    }
    ?>

</ul>
<br>
</div>

<section class="col-lg-10">
    <div class="alert-info" name="info"><?= (isset($info) ? $info : '') ?></div>
    <br>
    <?= $content_for_layout ?>
</section>
</div>

<script src='<?php echo BASE_SITE . '/js/jquery.js' ?>'></script>
<script src='<?php echo BASE_SITE . '/js/script.js' ?>'></script>
<script src='<?php echo BASE_SITE . '/js/jquery.dataTables.min.js' ?>'></script>
<script src='<?php echo BASE_SITE . '/css/bootstrap/js/bootstrap.min.js' ?>'></script>
<script src='<?php echo BASE_SITE . '/css/bootstrap/js/dataTables.bootstrap.min.js' ?>'></script>
<script type="text/javascript">
    $(function () {
        $('#liste_espece').dataTable();
    });
</script>

</body>
</html>
