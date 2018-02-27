<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>{$naslovStranice}</title> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="autor" content="Mijo Lučić">
        <meta name="naslov" content="{$naslovStranice}">
        <meta name="datum izrade" content="{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}">
        <meta name="ključne riječi" content="FOI, WebDiP, webinar, projekt, HTML5, CSS3">
        <meta name="opis" content="{$naslovStranice}">
        <link rel="stylesheet" type="text/css" href="css/mijlucic.css">
        <link rel="icon" type="image/icon" href="slike/favicon.ico">
        <!--ReCaptcha-->
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!--Datatables-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

        <script type="text/javascript" src="js/mijlucic_jquery.js"></script>
        <script type="text/javascript" src="js/prijava.js"></script>
    </head>
    
    <body>
        <header class="headerizgled">  
            <figure>
                <img id="logo" src="slike/hr_logo.jpg" height="80">
                <figcaption id="logofig">Webinar</figcaption>
            </figure>
            <div class="headernaslov">
                <div class="h3naslov">{$naslovStranice}</div>
                <div class="tipkorisnika">

                    <img id="ikonice" src="slike/ikonice/userR.png" height="32">
                    <p>Tip korisnika: </p>
                    <a class="a" href="{if (not isset($_SESSION['korisnik']))}odjava.php{else}prijava.php{/if}">
                        {if (not isset($_SESSION['korisnik']))}Odjava{else}Prijava{/if}</a>
                </div>
            </div>
        </header>
        <div style="clear:both"></div>
        <div class="bd">
        <aside>
            <nav>

            <ul class="ulizgled">
                <li><a class="a" href="index.php">Početna stranica</a></li>
                <li><a class="a" href="registracija.php">Registracija</a></li>
                <li><a class="a" href="prijava.php">Prijava</a></li>
                <!--
                <li><a class="a" href="{if (not isset($_SESSION['korisnik']))}odjava.php{else}prijava.php{/if}">
                        {if (not isset($_SESSION['korisnik']))}Odjava{else}Prijava{/if}</a></li>-->
                <li><a class="a" href="popis_korisnika.php">Popis korisnika</a></li>
                <li><a class="a" href="o_autoru.php">O autoru</a></li>
                <li><a class="a" href="dokumentacija.php">Dokumentacija</a></li>
            </ul>
            </nav>
        </aside> 
