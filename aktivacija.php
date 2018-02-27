<?php
include ("baza.class.php");
include ("vanjske_biblioteke/sesija.class.php");
include 'Sesija.php';
include 'dnevnik.php';
include 'virtualnoVrijeme.php';

$baza = new Baza();
$veza = $baza->spojiDB();
$vrijeme = new virtualnoVrijeme();

$aktivacijskikod = $_GET['aktivacijskiKod'];
$upitAkt = $veza->prepare("SELECT korime, virt_vrijeme FROM aktivacijski_kod WHERE aktivacijski_kod = ? AND iskoristen=0 AND tip_akt_kod=0");
$upitAkt->bind_param('s', $aktivacijskikod);
$upitAkt->execute();
$upitAkt->bind_result($korime, $vrijemereg);

$brredaka = 0;
while($upitAkt->fetch()) {
    $brredaka++;
}
if($brredaka==0) {
    echo 'Aktivacijski kod je već iskorišten ili ne postoji!';
    exit();
}
echo $brredaka;

if ($brredaka>0) {
    $korIme = $korime;
    $vrijemeregd =date_create_from_format('Y-m-d H:i:s',$vrijemereg);
    $trenutnovrijeme = date_create_from_format('Y-m-d H:i:s',$vrijeme->Vrijeme());
    if(($vrijemeregd->add(new DateInterval("PT5H"))) < $trenutnovrijeme){
        echo 'Aktivacijski link je istekao!';
        exit();
    }
    echo $korIme;

    $upit1 = $veza->prepare("UPDATE korisnik SET aktiviran=1 WHERE korisnickoime=? AND aktiviran=0");
    $upit1->bind_param('s',$korIme);
    $upit1->execute();
    $brred=0;

    if ($upitAkt->affected_rows==-1) {
        $upit2 = $veza->prepare("UPDATE aktivacijski_kod SET iskoristen=1 WHERE aktivacijski_kod=? and tip = 0");
        $upit2->bind_param('s',$aktivacijskiKod);
        $upit2->execute();
        if ($upitAkt->affected_rows==-1) {
            header('Location: http://barka.foi.hr/WebDiP/2016_projekti/WebDiP2016x070');
        }
    } else {
        echo 'Korisnik nije aktiviran!';
        exit();
    }
}
echo 'Pogreska na serveru';




