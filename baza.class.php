<?php

class Baza {
    const server = "";
    const korisnik = "";
    const lozinka = "";
    const baza = "";

    public $captchasitekey;
    public $captchasecretkey;

	private $veza = null;
	private $greska = '';


    function spojiDB() {
        $this->veza = new mysqli(self::server, self::korisnik, self::lozinka, self::baza);
        if ($this->veza->connect_errno) {
            echo "Neuspješno spajanje na bazu: " . $this->veza->connect_errno . ", " .
            $this->veza->connect_error;
            $this->greska = $this->veza->connect_error;
        }
        $this->veza->set_charset("utf8");
        if ($this->veza->connect_errno) {
            echo "Neuspješno postavljanje znakova za bazu: " . $this->veza->connect_errno . ", " .
            $this->veza->connect_error;
            $this->greska = $this->veza->connect_error;
        }
        return $this->veza;
    }

    function zatvoriDB() {
        $this->veza->close();
    }

    function selectDB($upit) {
        $rezultat = $this->veza->query($upit);
        if ($this->veza->connect_errno) {
            echo "Greška kod upita: {$upit} - " . $this->veza->connect_errno . ", " .
            $this->veza->connect_error;
            $this->greska = $this->veza->connect_error;
        }
        if (!$rezultat) {
            $rezultat = null;
        }
        return $rezultat;
    }

    function updateDB($upit, $skripta = '') {
        $rezultat = $this->veza->query($upit);
        if ($this->veza->connect_errno) {
            echo "Greška kod upita: {$upit} - " . $this->veza->connect_errno . ", " .
            $this->veza->connect_error;
            $this->greska = $this->veza->connect_error;
        } else {
            if ($skripta != '') {
                header("Location: $skripta");
            }
        }

        return $rezultat;
    }
    
    function pogreskaDB() {
        if ($this->greska != '') {
            return true;
        } else {
            return false;
        }
    }

    function __construct()
    {
        if ($_SERVER['HTTP_HOST'] === "barka.foi.hr") {
            $this->server = "localhost";
            $this->korisnik = "WebDiP2016x070";
            $this->lozinka = "admin_SqeQ";
            $this->baza = "WebDiP2016x070";

            $this->captchasitekey = "6LdsuyUUAAAAAHTEfA6n98al95ZkRL-VvXa2Zeod";
            $this->captchasecretkey = "6LdsuyUUAAAAAAAHvOyFOqMcvGijUCkbIkXgvK78";
        }
    }

}
/*
function captchacheck($secret, $secretresponse)
{
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $secretresponse);
    $responseData = json_decode($verifyResponse);
    if (!$responseData->success) {
        $greske['captcha'] = "Neuspjesna verifikacija!";
    }
}*/
