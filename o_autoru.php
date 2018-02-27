<?php
require 'vanjske_biblioteke/Smarty/libs/Smarty.class.php';
include ("baza.class.php");
include ("vanjske_biblioteke/sesija.class.php");

$naslov = "O autoru";

$smarty = new Smarty;
    $smarty->assign('naslovStranice', $naslov);
    $smarty->assign('aktivnaSkripta', $_SERVER['PHP_SELF']);
    $smarty->display('predlosci/_header.tpl');
    $smarty->display('predlosci/_o_autoru.tpl');
    $smarty->display('predlosci/_footer.tpl');



      
       
