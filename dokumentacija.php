<?php
require 'vanjske_biblioteke/Smarty/libs/Smarty.class.php';
include ("baza.class.php");
include ("vanjske_biblioteke/sesija.class.php");
include 'dnevnik.php';
include 'virtualnoVrijeme.php';

if (isset($_SERVER['HTTPS'])) {
    if ($_SERVER['HTTPS'] == "ON") {
        $secure_connection = true;
    }
}

$use_sts = true;

if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} elseif ($use_sts) {
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    die();
}

$naslov = "Dokumentacija";

$smarty = new Smarty;
    $smarty->assign('naslovStranice', $naslov);
    $smarty->assign('aktivnaSkripta', $_SERVER['PHP_SELF']);
    $smarty->display('predlosci/_header.tpl');
    $smarty->display('predlosci/_dokumentacija.tpl');
    $smarty->display('predlosci/_footer.tpl');
    
?>


      
       
