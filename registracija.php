<?php
require 'vanjske_biblioteke/Smarty/libs/Smarty.class.php';
include("baza.class.php");
include("vanjske_biblioteke/sesija.class.php");
require 'vanjske_biblioteke/recaptchalib.php';

include 'dnevnik.php';
include 'virtualnoVrijeme.php';

$greske = [];


function provjeraEmail($email) {
    $regexEmail = "(^\w{2,}@(\w{2,}\.){1,2}\w{2,}$)";
    if(preg_match($regexEmail, $email))
        return true;
    else return false;
}

function provjeraZnLoz ($znloz) {
    $regexZnLoz = '(^(?=(?:.*[A-Z]){2,})(?=(?:.*[a-z]){2,})(?=(?:.*[0-9]){1,})\S{5,15}$)';
    if(preg_match($regexZnLoz, $znloz))
        return true;
    else return false;
}

function provjeraPonLoz ($ponloz) {
    $regexPonLoz = '(^(?=(?:.*[A-Z]){2,})(?=(?:.*[a-z]){2,})(?=(?:.*[0-9]){1,})\S{5,15}$)';
    if(preg_match($regexPonLoz, $ponloz))
        return true;
    else return false;
}

function kripLozinka ($lozinka){
    return sha1("314882{$lozinka}371115");
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

function captchacheck($secret, $secretresponse)
{
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $secretresponse);
    $responseData = json_decode($verifyResponse);
    if (!$responseData->success) {
        $greske['captcha'] = "Neuspjesna verifikacija!";
    }
}

$greske['Ime']=[];
$greske['Prezime']=[];
$greske['Korime']=[];
$greske['Email']=[];
$greske['Lozinka']=[];
$greske['Potvrdalozinke']=[];


if (isset($_POST["submit"])) {


    foreach ($_POST as $key => $value) {
        $greske[$key] = [];

        if (empty($_POST[$key])) {
            $greske[$key][] = $key . " je prazan! "."<br>";
        }

        $nevalja ='(){}!#/\\';

        if (strpbrk($value,$nevalja)) {
            $greske[$key][] = "U " . $key . "  ste unijeli nedopuštene znakove!";
        }
    }

    if(!provjeraEmail($_POST["Email"])){
        if(!isset($greske["Email"])) {
            $greske["Email"] = [];
        }
        $greske["Email"][]="Pogrešno ste unijeli EMAIL!";
    }

    if(!provjeraZnLoz($_POST["Lozinka"])) {
        if(!isset($greske["Lozinka"])) {
            $greske["Lozinka"] = [];
        }
        $greske["Lozinka"][]="Koristite nedozvoljene znakove u lozinci!";
    }

    if(!provjeraPonLoz($_POST["Potvrdalozinke"])) {
        if(!isset($greske["Potvrdalozinke"])) {
            $greske["Potvrdalozinke"] = [];
        }
        $greske["Potvrdalozinke"][]="Pogrešno ste unijeli ponovljenu lozinku! Pokušajte ponovo!";
    }

    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $baza = new Baza();
        $secret = $baza->captchasecretkey;
        captchacheck($secret,$_POST['g-recaptcha-response']);
    }

    //var_dump($greske);

    if(isset($greske)) {
        $mysqli = new Baza();
        $mysqli->spojiDB();

        $ime = $_POST["Ime"];
        $prezime = $_POST["Prezime"];
        $email = $_POST["Email"];
        $korIme = $_POST["Korime"];
        $lozinka = $_POST["Lozinka"];
        $ponLozinka = $_POST["Potvrdalozinke"];

        $upitInsert = "INSERT INTO korisnik (korisnik_id, ime, prezime, korisnickoime, email, lozinka, tip_korisnik_tip_korisnik_id) VALUES (default, '$ime', '$prezime', '$korIme', '$email', '$lozinka', '1')";
        $upDb = $mysqli->updateDB($upitInsert);

        if (!$upDb) {
            echo "Podaci nisu uspješno ažurirani na bazi podataka!";
        }

        $mysqli->zatvoriDB();
    }

    if(empty($greske)) {
        $konekcija = $baza->spojiDB();

        $imes = $_POST['Ime'];
        $prezimes = $_POST['Prezime'];
        $emails = $_POST['Email'];
        $korimes = $_POST['Korime'];
        $lozinkas = $_POST['Lozinka'];
        $korLozinka = kripLozinka($lozinkas);

        $upits = $konekcija->prepare("INSERT INTO korisnik (ime, prezime, korisnickoime, email, lozinka, kript_lozinka, aktiviran, zakljucan) VALUES (?,?,?,?,?,?,3,0,0)");
        $upits->bind_param('ssssss', $imes, $prezimes, $korimes, $emails, $lozinkas, $korLozinka);
        $upits->execute();

        if ($upits->affected_rows > 0) {
            $dnevnik->insertLog($korimes, "3", "Uspješna registracija korisnika: {$korimes}");
            $poruka = 'Registracija uspješna!';
            $aktivacijskiKod = sha1(uniqid(mt_rand() . microtime() . $korimes, true));
            $aktivacijskiKod .= 'R';
            $stvoren = $vrijeme->Vrijeme();
            echo "Stvoren aktivacijski kod" . $stvoren;
            $upit1 = $konekcija->prepare("INSERT INTO aktivacijski_kod (idaktivacijski_kod, tip_akt_kod, iskoristen, aktivacijski_kod, korime, virt_vrijeme) VALUES (default, 2,?,?,?,?)");
            $upit1->bind_param("sss", $aktivacijskiKod, $korimes, $stvoren);
            $upit1->execute();

            $link = "http://barka.foi.hr/WebDiP/2016_projekti/WebDiP2016x070/aktivacija.php?aktivacijskiKod={$aktivacijskiKod}";
            $sadrzaj = '<html><body><p>'.'Poštovani korisniče ' . $imes . ' ' . $prezimes . ',<br> kako bi aktivirali Vaš račun molimo Vas da kliknete na link!<br> <a href="' . $link . '"> LINK </a></p></body></html>';

            saljiMail("Aktivacijski kod", $sadrzaj, $emails);

        } else {
            $poruka = 'Registracija nije uspjesna! Pokušajte ponovo!';
        }
        //echo json_encode($greske);
    }

}


$naslov = "Registracija";
$phpself = $_SERVER["PHP_SELF"];

$smarty = new Smarty();
$smarty->assign('phpself', $phpself);
$smarty->assign('naslovStranice', $naslov);

$smarty->assign('greskaIme', implode($greske["Ime"]));
$smarty->assign('greskaPre', implode($greske['Prezime']));
$smarty->assign('greskaKorIme', implode($greske['Korime']));
$smarty->assign('greskaEmail', implode($greske['Email']));
$smarty->assign('greskaLoz', implode($greske['Lozinka']));
$smarty->assign('greskaPonLoz', implode($greske['Potvrdalozinke']));

$smarty->display('predlosci/_header.tpl');
$smarty->display('predlosci/_registracija.tpl');
$smarty->display('predlosci/_footer.tpl');

?>