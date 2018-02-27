<?php
require 'vanjske_biblioteke/Smarty/libs/Smarty.class.php';
include ("baza.class.php");
include ("vanjske_biblioteke/sesija.class.php");

include 'dnevnik.php';
include 'virtualnoVrijeme.php';


session_start();

$vrijeme = new virtualnoVrijeme();
$dnevnik = new Dnevnik();


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

function vratiMail($korime)
{
    $baza = new Baza();
    $veza = $baza->spojiDB();
    $upit = $veza->prepare("SELECT korisnickoime, email FROM korisnik");
    $upit->execute();
    $upit->bind_result($bkorime, $bemail);
    while ($upit->fetch()) {
        if ($bkorime === $korime) {
            $baza->zatvoriDB();
            return $bemail;
        }
    }
    $baza->zatvoriDB();
    return false;
}

function saljiMail($subject, $tekst, $korisnik)
{
    if(!$subject)return;
    $mail_to = $korisnik;
    $mail_subject = $subject;
    $mail_body = $tekst;

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: WebDiP_2017@foi.hr' . "\r\n";
    if (!mail($mail_to, $mail_subject, $mail_body, $headers)) $povratneInformacije[] = array('greska maila' => true);
}

function dajTipKorisnika($korime){
    $baza = new Baza();
    $veza = $baza->spojiDB();
    $upit = $veza->prepare("SELECT tip_korisnik_tip_korisnik_id FROM korisnik where korisnickoime = ?");
    $upit->bind_param('s',$korime);
    $upit->execute();
    $upit->bind_result($btipkor);
    $upit->fetch();
    $baza->zatvoriDB();
    return $btipkor;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $povratneInformacije = array();
    $povratneInformacije['greske'] = array();
    if (!isset($_SESSION['unlogged']['pokusaj'])) {
        $_SESSION['unlogged']['pokusaj'] = 1;
        $_SESSION['unlogged']['korime'] = "";
    }

    if (postojanjeKorisnika($_POST['korime'], $povratneInformacije)) {
        if ($_SESSION['unlogged']['pokusaj'] > 2 && $_SESSION['unlogged']['korime'] === $_POST['korisnicko_ime']) {
            $baza = new Baza();
            $veza = $baza->spojiDB();
            $upit = $veza->prepare("UPDATE korisnik SET zakljucan = 1 WHERE korisnickoime =?");
            $upit->bind_param('s', $_POST['korisnicko_ime']);
            $upit->execute();
            $baza->zatvoriDB();
            $povratneInformacije['greske'][]= "racun zakljucan";
            echo json_encode($povratneInformacije);
            exit();
        }


        if (postojanjeLozinke($_POST['korime'], $_POST['lozinka'],$povratneInformacije) && $_SESSION['unlogged']['pokusaj'] <= 3) {
            $subject = "Aktivacijski";
            if ($_POST['jedankorak'] === "false") {
                if (($_POST['Aktivacijski']) === "") {
                    $aktivacijskiKod = sha1(uniqid(mt_rand() . microtime() . $_POST["korime"], true));
                    $aktivacijskiKod.='P';
                    $sadrzajporuke = "Vas aktivacijski kod je {$aktivacijskiKod} ";
                    saljiMail($subject, $aktivacijskiKod, vratiMail($_POST['korime']));
                    $baza = new Baza();
                    $con = $baza->spojiDB();
                    $stvoren = $vrijeme->Vrijeme();
                    $upit = $con->prepare("INSERT INTO aktivacijski_kod (tip_akt_kod, aktivacijski_kod, korime, virt_vrijeme) VALUES (?1,?,?,?)");
                    $upit->bind_param("sss", $aktivacijskiKod, $_POST['korime'], $stvoren);
                    $upit->execute();
                    if($upit->affected_rows>0){echo "2step";}
                    $baza->zatvoriDB();
                    exit();
                } else {
                    $provera = false;
                    $baza = new Baza();
                    $con = $baza->spojiDB();
                    $upit = "Select* from aktivacijski_kod";
                    $upit = $con->prepare("SELECT korime, aktivacijski_kod, virt_vrijeme FROM aktivacijski_kod WHERE tip_akt_kod = 1");
                    $upit->execute();
                    $upit->bind_result($korime1,$aktivacijski1,$logdate);

                    $tip = "";
                    while ($upit->fetch()) {
                        if ($korime1 === $_POST['korime'] && $aktivacijski1 === $_POST['Aktivacijski']) {
                            $provera = true;
                            $vrijemeregd =date_create_from_format('Y-m-d H:i:s',$logdate);
                            $trenutnovrijeme = date_create_from_format('Y-m-d H:i:s',$vrijeme->Vrijeme());
                            if(($vrijemeregd->add(new DateInterval("PT5M")))<$trenutnovrijeme){
                                $provera = false;
                                $povratneInformacije['greske'][]= "istekao login kod";
                            }
                        }
                    }
                    if ($provera) {
                        $upit = $con->prepare("UPDATE aktivacijski_kod SET iskoristen=1 WHERE tip_akt_kod = 1 and aktivacijski_kod = ?");
                        $upit->bind_param('s',$_POST['Aktivacijski']);
                        $upit->execute();

                        session_destroy();
                        $idsesije = getSessionID($_POST['korime']);
                        session_id($idsesije);
                        session_start();
                        $_SESSION['ulogiran'] = "true";
                        $_SESSION['korime'] = $_POST['korime'];
                        $_SESSION['id_sesije'] = $idsesije;
                        $_SESSION['tipkorisnika'] = getSessionKorIme($_POST['korime']);
                        $dnevnik->insertLog($_POST['korime'],"2","Uspjesna prijava korisnika {$_POST['korime']} - dva koraka");
                        $povratneInformacije['logindata'] = array('tipkorisnika' => $_SESSION['tipkorisnika'], 'ulogiran' => 'true', 'korime' => $_POST['korime'], 'id_sesije' => $idsesije);
                    };
                    $baza->zatvoriDB();
                }
            };
            if (($_POST['jedankorak'] === "true")) {

                $tip = dajTipKorisnika($_POST['korime']);
                session_destroy();
                $idsesije = getSessionID($_POST['korime']);
                session_id($idsesije);
                session_start();
                $_SESSION['ulogiran'] = "true";
                $_SESSION['korime'] = $_POST['korime'];
                $_SESSION['id_sesije'] = $idsesije;
                $_SESSION['tipkorisnika'] = $tip;

                $dnevnik->insertLog($_POST['korime'],"2","Uspjesna prijava korisnika {$_POST['korime']} - jedan korak");
                $povratneInformacije['logindata'] = array('tipkorisnika' => $tip, 'ulogiran' => 'true', 'korime' => $_POST['korime'], 'idsesije' => $idsesije);
            }
        } else {
            if (!isset($_SESSION['unlogged']['korime'])) {
                $_SESSION['unlogged']['korime'] = $_POST['korime'];
                $_SESSION['unlogged']['pokusaj'] = 1;
                echo json_encode($povratneInformacije);
                exit();
            }

            if ($_POST['korime'] !== $_SESSION['unlogged']['korime']) {
                $_SESSION['unlogged']['korime'] = $_POST['korime'];
                $_SESSION['unlogged']['pokusaj'] = 1;
                echo json_encode($povratneInformacije);
                exit();
            }
            if ($_POST['korime'] === $_SESSION['unlogged']['korime']) {
                $_SESSION['unlogged']['pokusaj']++;
                exit();
            }
        }
    }
}

$naslov = "Prijava";
$phpself = $_SERVER["PHP_SELF"];

$smarty = new Smarty();
    $smarty->assign('aktivnaSkripta', $_SERVER['PHP_SELF']);
    $smarty->assign('naslovStranice', $naslov);
    $smarty->assign('phpself', $phpself);
    
    $smarty->assign('korime', 'Korisničko ime: ');
    $smarty->assign('lozinka', 'Lozinka: ');
    $smarty->assign('zapamtime', 'Zapamti me?');
    $smarty->assign('da', 'DA');
    $smarty->assign('ne', 'NE');
    $smarty->assign('registracija', 'Registracija');
    
    $smarty->display('predlosci/_header.tpl');
    $smarty->display('predlosci/_prijava.tpl');
    $smarty->display('predlosci/_footer.tpl');

