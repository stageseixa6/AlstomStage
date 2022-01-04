<?php

class DefaultController extends Controller{
    function index(){
    $url="Location: http://".SERVER.BASE_URL."/accueil/detail";
    header($url);
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

