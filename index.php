<?php
require 'vanjske_biblioteke/Smarty/libs/Smarty.class.php';
include ("baza.class.php");
include ("vanjske_biblioteke/sesija.class.php");

Sesija::kreirajSesiju();

//session_start();

if(isset($_SESSION["korisnik"])) {
    echo "Sesija već postoji";
}
else {
    error_reporting(E_ERROR);
    echo "Preusmjeravam na prijava.php!";
    header("Location:prijava.php");
    exit;
}

$naslov = "Početna stranica";

$smarty = new Smarty;
    $smarty->assign('naslovStranice', $naslov);
    $smarty->assign('aktivnaSkripta', $_SERVER['PHP_SELF']);
    $smarty->display('predlosci/_header.tpl');
    $smarty->display('predlosci/_index.tpl');
    $smarty->display('predlosci/_footer.tpl');
    
?>


      
       
