<?php
require 'baza.class.php';
require 'zab_lozinka.php';

include 'dnevnik.php';
include 'virtualnoVrijeme.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $vrijeme = new virtualnoVrijeme();
    $dnevnik=new Dnevnik();


    if(isset($_POST['dohvatitip'])){
        $baza = new Baza();
        $veza = $baza->spojiDB();
        $upit = $veza->prepare("SELECT tip_korisnik_id, naziv FROM tip_korisnik");
        $upit->execute();
        $upit->bind_result($id,$naziv);
        $data = array();
        while($upit->fetch()){
            $data[]=array("id"=>$id,"naziv"=>$naziv);
        }
        echo json_encode($data);
        $dnevnik->insertLog($_POST['zahtjevsalje'],"5","Zahtjev za tipom korisnika");
        $baza->zatvoriDB();
    }

    if(isset($_POST['promjenitip'])){
        $baza = new Baza();
        $veza = $baza->spojiDB();
        $upit = $veza->prepare("UPDATE korisnik SET tip_korisnika_tip_korisnik_id = ? WHERE korisničkoime = ?");
        $upit->bind_param('ss',$_POST['tip'],$_POST['korime']);
        $upit->execute();
        echo($upit->affected_rows>0)?"true":"false";
        $dnevnik->insertLog($_POST['zahtjevsalje'],"5","Zahtjev za promjenu tip korisnika");
        $baza->zatvoriDB();
        exit();
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $baza = new Baza();
    $veza = $baza->spojiDB();
    $upit = $veza->prepare("SELECT korisnickoime, email, tip_korisnika_tip_korisnik_id FROM korisnik");
    $upit->execute();
    $upit->bind_result($korime, $email, $tipkorisnika);

    $data = array();
    while($upit->fetch()){
        $data[]=array("korime"=>$korime,"email"=>$email,"tip_korisnika_id"=>$tipkorisnika);
    }
    echo json_encode($data);

    $baza->zatvoriDB();
}

function postojanjeLozinke ($korime, $lozinka, $povratneInformacije)
{
    $kriptloz = kripLozinka($lozinka);
    $baza = new Baza();
    $veza = $baza->spojiDB();
    $upit = $veza->prepare("SELECT korisnickoime, kriptirana_lozinka FROM korisnik");
    $upit->execute();
    $upit->bind_result($bkorime, $bklozinka);
    while ($upit->fetch()) {
        if ($bkorime === $korime && $bklozinka === $kriptloz) {
            $baza->zatvoriDB();
            return true;
        }
    }
    $baza->zatvoriDB();
    $povratneInformacije['greske'][]= "lozinka ne odgovara";
    return false;
}

function postojanjeKorisnika ($korime, &$povratneInformacije)
{
    $baza = new Baza();
    $veza = $baza->spojiDB();
    $upit = $veza->prepare("SELECT korisnickoime, zakljucan, aktiviran FROM korisnik");
    $upit->execute();
    $upit->bind_result($bkorime, $bzakljucan, $baktiviran);
    while ($upit->fetch()) {
        if ($bkorime === $korime) {
            if ($bzakljucan == 1){
                $povratneInformacije['greske'][]= "zakljucan";
                return false;
            }
            if ($baktiviran == 0) {
                $povratneInformacije['greske'][]= "nijeaktiviran";
                return false;
            }
            if ($bzakljucan == 0 and $baktiviran === 1) {
                $baza->zatvoriDB();
                return true;
            }
        }
    }

    $baza->zatvoriDB();
    $povratneInformacije['greske'][]= "Korisnik ne postoji!";
    return false;
}