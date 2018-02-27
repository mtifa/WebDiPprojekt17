<?php
require 'vanjske_biblioteke/Smarty/libs/Smarty.class.php';
include ("baza.class.php");
include ("vanjske_biblioteke/sesija.class.php");
include 'dnevnik.php';
include 'virtualnoVrijeme.php';


$dnevnik = new Dnevnik();

if($_SERVER["REQUEST_METHOD"]=="POST") {
    Sesija::obrisiSesiju();

    if(isset($_GET["odjava"])) {
        echo "Sesija ne postoji";
        echo "Preusmjeravam na prijava.php!";
        header("Location:index.php");
        exit;
    }

    if(isset($_POST['id_sesije'])) {
        session_id($_POST['id_sesije']);

        session_start();
        session_destroy();

        $dnevnik->insertLog($_POST['zahtjevsalje'],"3","Sesija korisnika {$_POST['zahtjevsalje']} izbrisana!");
        echo "Sesija prekinuta";
    }
    else {
        echo "Error!";
    }
}
else {
    echo "Error!";
}



$naslov = "Odjava";

$smarty = new Smarty();
    $smarty->assign('naslovStranice', $naslov);
    $smarty->display('predlosci/_header.tpl');
    $smarty->display('predlosci/_odjava.tpl');
    $smarty->display('predlosci/_footer.tpl');
?>
