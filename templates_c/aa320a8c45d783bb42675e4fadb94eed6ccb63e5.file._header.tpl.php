<?php /* Smarty version Smarty-3.1.18, created on 2017-06-18 15:23:35
         compiled from "predlosci\_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12115569e0ace255db6-66793544%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa320a8c45d783bb42675e4fadb94eed6ccb63e5' => 
    array (
      0 => 'predlosci\\_header.tpl',
      1 => 1497739719,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12115569e0ace255db6-66793544',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_569e0ace27e0d0_70965014',
  'variables' => 
  array (
    'naslovStranice' => 0,
    '_SESSION' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_569e0ace27e0d0_70965014')) {function content_569e0ace27e0d0_70965014($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\projekt\\vanjske_biblioteke\\Smarty\\libs\\plugins\\modifier.date_format.php';
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
        <link rel="stylesheet" type="text/css" href="css/mijlucic.css">
        <link rel="icon" type="image/icon" href="slike/favicon.ico">

        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    
    <body>
        <header class="headerizgled">  
            <figure>
                <img id="logo" src="slike/hr_logo.jpg" height="40">
                <figcaption id="logofig">Webinar</figcaption>
            </figure>
            <div class="headernaslov">
                <div class="h3naslov"><?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
</div>
                <div class="tipkorisnika">Neregistrirani korisnik</div>
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
