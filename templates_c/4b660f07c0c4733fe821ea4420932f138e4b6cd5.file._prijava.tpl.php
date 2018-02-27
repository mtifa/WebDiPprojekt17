<?php /* Smarty version Smarty-3.1.18, created on 2017-06-20 11:06:14
         compiled from "predlosci/_prijava.tpl" */ ?>
<?php /*%%SmartyHeaderCode:99994364259467d64dc5c85-79094711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b660f07c0c4733fe821ea4420932f138e4b6cd5' => 
    array (
      0 => 'predlosci/_prijava.tpl',
      1 => 1497949166,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99994364259467d64dc5c85-79094711',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_59467d64e40641_24421215',
  'variables' => 
  array (
    'phpself' => 0,
    'naslovStranice' => 0,
    'korime' => 0,
    'lozinka' => 0,
    'zapamtime' => 0,
    'da' => 0,
    'ne' => 0,
    'posalji' => 0,
    'registracija' => 0,
    '_SESSION' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59467d64e40641_24421215')) {function content_59467d64e40641_24421215($_smarty_tpl) {?>  
    <section class="section_glavni" style="height: 400px">
        <form id="forma3" method="post" name="forma" accept-charset="utf-8" novalidate action="<?php echo $_smarty_tpl->tpl_vars['phpself']->value;?>
">
                   <h3><?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
</h3>

                    <div>
                        <label id="labimp1" for="korime"><?php echo $_smarty_tpl->tpl_vars['korime']->value;?>
</label>
                        <input type="text" id="korime" name="korIme" placeholder="korisnicko_ime">
                    </div><br>
                    <div>
                        <label id="labimp2"  for="lozinka"><?php echo $_smarty_tpl->tpl_vars['lozinka']->value;?>
</label>
                        <input type="password" id="lozinka" name="lozinka" placeholder="lozinka" required="required">
                    </div><br>
                    <div>
                        <label id="labimp3"  for="zapamtime"><?php echo $_smarty_tpl->tpl_vars['zapamtime']->value;?>
</label><br>
                        <input type="radio" id="zapamtime" name="zapamtime" value="DA"> <?php echo $_smarty_tpl->tpl_vars['da']->value;?>

                        <input type="radio"  id="zapamtime" name="zapamtime" value="NE"> <?php echo $_smarty_tpl->tpl_vars['ne']->value;?>

                    </div><br>
                        <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['posalji']->value;?>
"><br><br>
                        <a href="registracija.php"><?php echo $_smarty_tpl->tpl_vars['registracija']->value;?>
</a>
                        <a href="zab_lozinka.php">Zaboravljena lozinka?</a>
                    <?php if ((isset($_smarty_tpl->tpl_vars['_SESSION']->value['korisnik']))) {?><button id="odjavi_se">Odjava</button>
                    <?php }?>

                    <input type="button" value="Dva koraka">
                    <input type="button" value="Jedan korak">
                </form>
            
            <div>
                <?php if (((isset($_smarty_tpl->tpl_vars['_SESSION']->value['korisnik'])))) {?>
                    <p>Vaše </p><?php echo $_smarty_tpl->tpl_vars['korime']->value;?>
<br>
                    <?php echo $_smarty_tpl->tpl_vars['lozinka']->value;?>
<br>
                <?php }?>
            </div>
    </div>   
    </section>
<?php }} ?>
