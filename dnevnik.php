<?php
Class Dnevnik{
    function insertLog($korisnik, $tipakcije, $pojedinosti){
        $vrieme= new virtualnoVrijeme();
        $unos = $vrieme->Vrijeme();

        $baza = new Baza();
        $veza = $baza->spojiDB();
        $upit = $veza->prepare("INSERT INTO dnevnik (iddnevnik, datumvrijeme, tekst, korisnik_korisnik_id, tip_akcijeidtip_akcije) VALUES (default, ?,?,?,?)");
        $upit->bind_param('ssss', $pojedinosti, $unos, $korisnik, $tipakcije);
        $upit->execute();

        $dohvati = 0;
        while ($upit->fetch()) {
            $dohvati++;
        }
    }
}