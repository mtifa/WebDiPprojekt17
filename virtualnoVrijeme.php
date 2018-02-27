<?php

class virtualnoVrijeme
{
    function postaviVrijeme()
    {
        $url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json";
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $pomak = $obj->WebDiP->vrijeme->pomak->brojSati;

        $baza = new Baza();
        $veza = $baza->spojiDB();
        $date = (new DateTime())->format('Y-m-d H:i:s');
        $virtualno = (new DateTime())->add(new DateInterval("PT{$pomak}H"))->format('Y-m-d H:i:s');
        $query = $veza->prepare("INSERT INTO virtualno_vrijeme (id,pomak, stvarno_vrijeme,virtualno,aktivno) VALUES (DEFAULT ,?,?,?,0)");
        $query->bind_param('sss', $pomak, $date, $virtualno);
        $query->execute();
        echo ($query->affected_rows > 0) ? "1" : "0";
    }

    function dohvatiVrijeme()
    {
        $baza = new Baza();
        $veza = $baza->spojiDB();
        $query = $veza->prepare("SELECT pomak,stvarno_vrijeme,virtualno FROM virtualno_vrijeme WHERE aktivno = 1 ORDER BY id DESC LIMIT 0,1 ");
        $query->execute();
        $query->bind_result($pomak, $stvarno_vrijeme, $virtualno);
        $povr = [];
        while ($query->fetch()) {
            $povr[] = ['pomak' => $pomak, 'stvarno_vrijeme' => $stvarno_vrijeme, 'virtualno' => $virtualno];
        }
        echo json_encode($povr);
    }

    function Vrijeme()
    {
        $baza = new Baza();
        $veza = $baza->spojiDB();
        $query = $veza->prepare("SELECT pomak,stvarno_vrijeme,virtualno FROM virtualno_vrijeme WHERE aktivno = 1 ORDER BY id DESC LIMIT 1");
        $query->execute();
        $query->bind_result($pomak, $stvarno_vrijeme, $virtualno);
        $dohv = 0;
        while ($query->fetch()) {
            $dohv++;
        };
        $query->store_result();
        if ($dohv == 1) return $virtualno;
        else return (new DateTime())->format('Y-m-d H:i:s');
    }

    function VrijemeFor()
    {
        return date_create_from_format('Y-m-d H:i:s', $this->Vrijeme());
    }

    function Stop()
    {
        $baza = new Baza();
        $veza = $baza->spojiDB();
        $query = $veza->prepare("UPDATE virtualno_vrijeme SET aktivno = 0 ");
        $query->execute();
        return ($query->affected_rows > 0) ? "1" : "0";
    }

    function Koristi()
    {
        $baza = new Baza();
        $veza = $baza->spojiDB();
        $query = $veza->prepare("UPDATE virtualno_vrijeme SET aktivno = 1 ORDER BY id DESC LIMIT 1 ");
        $query->execute();
        return ($query->affected_rows > 0) ? "1" : "0";
    }
}