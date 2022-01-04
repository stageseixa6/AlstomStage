<?php


    class ListeInviteNom extends Model {
        //put your code here
        var $table = 'LISTE_INVITES INNER JOIN INVITE ON LISTE_INVITES.ID_INVITE = INVITE.ID_PERS_EXTERIEUR';
    }