<?php /* Smarty version Smarty-3.1.18, created on 2017-06-20 05:05:30
         compiled from "predlosci/_registracija.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100529786359467dd299c315-30976127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf5d2f53ef474ec08ef433fbef5847c7c076717d' => 
    array (
      0 => 'predlosci/_registracija.tpl',
      1 => 1497927924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100529786359467dd299c315-30976127',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_59467dd2a0ea08_34159490',
  'variables' => 
  array (
    'phpself' => 0,
    'naslovStranice' => 0,
    'greskaIme' => 0,
    'greskaPre' => 0,
    'greskaKorIme' => 0,
    'greskaEmail' => 0,
    'greskaLoz' => 0,
    'greskaPonLoz' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59467dd2a0ea08_34159490')) {function content_59467dd2a0ea08_34159490($_smarty_tpl) {?>
        <section class="section_glavni">
            <form id="forma2" method="post" name="forma2" accept-charset="utf-8" action="<?php echo $_smarty_tpl->tpl_vars['phpself']->value;?>
" novalidate>
                  <h3><?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
</h3>

                   <div>
                    <label for="ime1">Ime</label>
                    
                    <input type="text" id="ime1" name="Ime" maxlength="15" placeholder="Ime">
                    <br>
                    <div><?php echo $_smarty_tpl->tpl_vars['greskaIme']->value;?>
</div>
                   </div><br>
                   <div>
                    <label for="prezime1">Prezime</label>
                        
                    <input type="text" id="prezime1" name="Prezime" placeholder="Prezime">
                    <br>
                    <div><?php echo $_smarty_tpl->tpl_vars['greskaPre']->value;?>
</div>
                   </div><br>
                   <div>
                    <label for="korime1">Korisničko ime</label>
                        
                    <input type="text" id="korime1" name="Korime" placeholder="korisnicko_ime" required="required">
                    <br>
                    <div><?php echo $_smarty_tpl->tpl_vars['greskaKorIme']->value;?>
</div>
                   </div><br>
                   <div>
                    <label for="email1">Email adresa</label>
                        
                    <input type="email" id="email1" name="Email" placeholder="korime@foi.hr" required="required">
                    </div>
                   <br>
                   <div><?php echo $_smarty_tpl->tpl_vars['greskaEmail']->value;?>
</div>
                   <br>
                   <div>
                    <label for="lozinka1">Lozinka</label>
                    
                    <input type="password" id="lozinka1" name="Lozinka" placeholder="Lozinka" required="required">
                   </div>
                   <br>
                       <div><?php echo $_smarty_tpl->tpl_vars['greskaLoz']->value;?>
</div>
                   <br>
                   <div>
                    <label for="lozinka2">Potvrda lozinke</label>
                    <input type="password" id="lozinka2" name="Potvrdalozinke" placeholder="Lozinka" required="required">
                   </div>
                   <br>
                       <div><?php echo $_smarty_tpl->tpl_vars['greskaPonLoz']->value;?>
</div>
                       <br>



                    <input type="submit" name="submit" value="Registracija">
                <a href="prijava.php">Prijava</a>
            </form>
            <!--ReCaptha-->
            <div class="g-recaptcha" data-sitekey="6LdsuyUUAAAAAHTEfA6n98al95ZkRL-VvXa2Zeod"></div>
        </section>
</div>
        
<?php }} ?>
