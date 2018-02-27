<?php
require 'vanjske_biblioteke/Smarty/libs/Smarty.class.php';
include ("baza.class.php");
include ("vanjske_biblioteke/sesija.class.php");

include 'dnevnik.php';
include 'virtualnoVrijeme.php';

$naslov = "Popis korisnika";
$phpself = $_SERVER["PHP_SELF"];

$smarty = new Smarty;
    $smarty->assign('naslovStranice', $naslov);
    $smarty->assign('phpself', $phpself);
    $smarty->display('predlosci/_header.tpl');
    $smarty->display('predlosci/_popis_korisnika.tpl');
    $smarty->display('predlosci/_footer.tpl');
?>

