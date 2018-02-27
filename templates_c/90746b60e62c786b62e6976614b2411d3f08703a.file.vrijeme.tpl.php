<?php /* Smarty version Smarty-3.1.18, created on 2016-01-19 11:07:10
         compiled from "predlosci\vrijeme.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8336569e0ace2bf782-76991858%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90746b60e62c786b62e6976614b2411d3f08703a' => 
    array (
      0 => 'predlosci\\vrijeme.tpl',
      1 => 1422990441,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8336569e0ace2bf782-76991858',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'vrijeme' => 0,
    'salji' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_569e0ace311124_13438043',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_569e0ace311124_13438043')) {function content_569e0ace311124_13438043($_smarty_tpl) {?><?php if (isset($_POST['salji'])) {?>
    Pomak vremena: <?php echo $_smarty_tpl->tpl_vars['vrijeme']->value;?>

<?php } else { ?>
    <form action=vrijeme.php method="POST">
      <input type="submit" name='salji' value='<?php echo $_smarty_tpl->tpl_vars['salji']->value;?>
'>
    </form>
<?php }?>
<?php }} ?>
