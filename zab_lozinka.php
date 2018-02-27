<?php
require 'baza.class.php';


include 'dnevnik.php';
include 'virtualnoVrijeme.php';

$dnevnik = new Dnevnik();



function getPass() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function saljiMail($subject, $sadrzaj, $to)
{
    $mail_to = "$to";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: WebDiP_2017@foi.hr' . "\r\n";
    $mail_subject = "$subject";
    $mail_body = "$sadrzaj";

    if (mail($mail_to, $mail_subject, $mail_body)) {
        echo("Poslana poruka za: '$mail_to'");
    } else {
        echo("Problem kod slanja poruke za: '$mail_to'");
    }
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $korime='';
    $email='';

    if(isset($_POST['korime']))
        $korime = $_POST['korime'];
    else{
        echo '0';
        exit();
    }

    $dnevnik->insertLog($korime,"8","Korisnik {$korime} je zaboravio svoju lozinku!");

    $baza = new Baza();
    $baza->spojiDB();
    $rezultat = $baza->selectDB("SELECT * FROM korisnik");

    $data = array();
    $i=0;
    while ($row=mysqli_fetch_assoc($rezultat)) {
        if ($row['korime'] === $korime) {
            $email = $row['email'];
        }
    }

    if($email !== ""){
        $loz=getPass();
        $kriptpass = kripLozinka($loz);

        $veza = $baza->spojiDB();
        $upit = $veza->prepare("UPDATE korisnik SET lozinka = ?, kript_lozinka = ? WHERE korisnickoime = ?");
        $upit->bind_param('sss', $loz, $kriptpass, $korime);
        $upit->execute();

        saljiMail("Slanje zaboravljena lozinke", $loz, $email);

        $dnevnik->insertLog($_POST['korime'],"5","Zaboravljena lozinka poslana korisniku na njegov email!");
        echo "Uspješno!";

        $baza->zatvoriDB();
    }
}