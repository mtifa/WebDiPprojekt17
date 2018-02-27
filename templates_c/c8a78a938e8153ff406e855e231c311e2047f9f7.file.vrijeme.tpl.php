<?php /* Smarty version Smarty-3.1.18, created on 2017-05-09 11:11:23
         compiled from "predlosci/vrijeme.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1083218655591187bb91d0d3-49743160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8a78a938e8153ff406e855e231c311e2047f9f7' => 
    array (
      0 => 'predlosci/vrijeme.tpl',
      1 => 1494320961,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1083218655591187bb91d0d3-49743160',
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
  'unifunc' => 'content_591187bb941898_26763037',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591187bb941898_26763037')) {function content_591187bb941898_26763037($_smarty_tpl) {?><?php if (isset($_POST['salji'])) {?>
    Pomak vremena: <?php echo $_smarty_tpl->tpl_vars['vrijeme']->value;?>

<?php } else { ?>
    <form action=vrijeme.php method="POST">
      <input type="submit" name='salji' value='<?php echo $_smarty_tpl->tpl_vars['salji']->value;?>
'>
    </form>
<?php }?>
<?php }} ?>
