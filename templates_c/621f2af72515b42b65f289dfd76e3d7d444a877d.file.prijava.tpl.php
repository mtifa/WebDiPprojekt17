<?php /* Smarty version Smarty-3.1.18, created on 2017-05-09 17:44:09
         compiled from "predlosci/prijava.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12913458975911cff38ca5c9-72847204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '621f2af72515b42b65f289dfd76e3d7d444a877d' => 
    array (
      0 => 'predlosci/prijava.tpl',
      1 => 1494344615,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12913458975911cff38ca5c9-72847204',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5911cff38deb15_34423154',
  'variables' => 
  array (
    'naslov2' => 0,
    'email' => 0,
    'lozinka' => 0,
    'salji' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5911cff38deb15_34423154')) {function content_5911cff38deb15_34423154($_smarty_tpl) {?><div class="bd">
        <aside>
            <nav>
            <ul class="ulizgled">
                <li><a class="a" href="index.html">Početna stranica</a></li>
                <li><a class="a" href="registracija.html">Registracija</a></li>
                <li><a class="a" href="prijava.html">Prijava</a></li>
                <li><a class="a" href="odjava.php" >Odjava</a></li>
                <li><a class="a" href="proizvod.html">Proizvod</a></li>
                <li><a class="a" href="popis_proizvoda.html">Popis proizvoda</a></li>
                <li><a class="a" href="novi_proizvod.html">Novi proizvod</a></li>
                <li><a class="a" href="era.html">ERA</a></li>
                <li><a class="a" href="navigacijski.html">Navigacijski dijagram</a></li>
            </ul>
            </nav>
        </aside>   
    <section class="section_glavni">
        <form action=vrijeme.php method="POST">
            <h1><?php echo $_smarty_tpl->tpl_vars['naslov2']->value;?>
</h1>
            <label for="kIme"><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
 </label><input type="text" name="kIme" /> <br />
            <label for="lozinka"><?php echo $_smarty_tpl->tpl_vars['lozinka']->value;?>
</label><input type="password" name="lozinka" /> <br />
          <input type="submit" value='<?php echo $_smarty_tpl->tpl_vars['salji']->value;?>
'>
        </form>
    </section>
</div>
<?php }} ?>
