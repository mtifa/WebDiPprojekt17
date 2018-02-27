<?php /* Smarty version Smarty-3.1.18, created on 2017-06-20 11:01:57
         compiled from "predlosci/_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145698497591187bb8d3588-01485872%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4cae68bd330d676cf8d60c66177191a20373ba9a' => 
    array (
      0 => 'predlosci/_header.tpl',
      1 => 1497949312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145698497591187bb8d3588-01485872',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_591187bb916455_87923869',
  'variables' => 
  array (
    'naslovStranice' => 0,
    '_SESSION' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591187bb916455_87923869')) {function content_591187bb916455_87923869($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/webdip.barka.foi.hr/2016_projekti/WebDiP2016x070/vanjske_biblioteke/Smarty/libs/plugins/modifier.date_format.php';
?><!DOCTYPE html>
<html lang="hr">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
</title> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="autor" content="Mijo Lučić">
        <meta name="naslov" content="<?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
">
        <meta name="datum izrade" content="<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>
">
        <meta name="ključne riječi" content="FOI, WebDiP, webinar, projekt, HTML5, CSS3">
        <meta name="opis" content="<?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
">
        <link rel="stylesheet" type="text/css" href="/css/mijlucic.css">
        <link rel="icon" type="image/icon" href="/slike/favicon.ico">
        <!--ReCaptcha-->
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!--Datatables-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

        <script type="text/javascript" src="/js/mijlucic_jquery.js"></script>
    </head>
    
    <body>
        <header class="headerizgled">  
            <figure>
                <img id="logo" src="/slike/hr_logo.jpg" height="80">
                <figcaption id="logofig">Webinar</figcaption>
            </figure>
            <div class="headernaslov">
                <div class="h3naslov"><?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
</div>
                <div class="tipkorisnika">
                    <img id="ikonice" src="/slike/ikonice/userR.png" height="32">
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
                <li><a class="a" href="<?php if ((!isset($_smarty_tpl->tpl_vars['_SESSION']->value['korisnik']))) {?>odjava.php<?php } else { ?>prijava.php<?php }?>">
                        <?php if ((!isset($_smarty_tpl->tpl_vars['_SESSION']->value['korisnik']))) {?>Odjava<?php } else { ?>Prijava<?php }?></a></li>
                <li><a class="a" href="popis_korisnika.php">Popis korisnika</a></li>
                <li><a class="a" href="kupon.php">Kupon</a></li>
                <li><a class="a" href="novi_proizvod.php">Novi webinar</a></li>
                <li><a class="a" href="o_autoru.php">O autoru</a></li>
                <li><a class="a" href="dokumentacija.php">Dokumentacija</a></li>
            </ul>
            </nav>
        </aside> 
<?php }} ?>
