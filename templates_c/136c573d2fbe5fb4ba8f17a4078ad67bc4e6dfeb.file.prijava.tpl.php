<?php /* Smarty version Smarty-3.1.18, created on 2016-01-19 11:07:16
         compiled from "predlosci\prijava.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28041569e0ad4cc54a0-68591108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '136c573d2fbe5fb4ba8f17a4078ad67bc4e6dfeb' => 
    array (
      0 => 'predlosci\\prijava.tpl',
      1 => 1423140257,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28041569e0ad4cc54a0-68591108',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'email' => 0,
    'lozinka' => 0,
    'salji' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_569e0ad4cf4236_46960824',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_569e0ad4cf4236_46960824')) {function content_569e0ad4cf4236_46960824($_smarty_tpl) {?><form action=vrijeme.php method="POST">
    <label for="kIme"><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
 </label><input type="text" name="kIme" /> <br />
    <label for="lozinka"><?php echo $_smarty_tpl->tpl_vars['lozinka']->value;?>
</label><input type="password" name="lozinka" /> <br />
  <input type="submit" value='<?php echo $_smarty_tpl->tpl_vars['salji']->value;?>
'>
</form>
<?php }} ?>
