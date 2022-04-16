<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<div class="jf_ku_login_modal jf_logged">
	<div class="jf_ku_login_modal_inner">
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
	<?php if ($params->get('name') == 0) : ?>
		<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name'), ENT_COMPAT, 'UTF-8')); ?>
	<?php else : ?>
		<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username'), ENT_COMPAT, 'UTF-8')); ?>
	<?php endif; ?>
	</div>
	<div class="img-rounded"><svg height="32" width="32" version="1.1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><g><g><circle cx="32" cy="32" fill="#ff4081" r="32"></circle></g><g><g><path d="M43.905,45.543c-3.821-1.66-5.217-4.242-5.643-6.469c2.752-2.215,4.943-5.756,6.148-9.573 c1.239-1.579,1.96-3.226,1.96-4.62c0-0.955-0.347-1.646-0.955-2.158C45.213,14.618,39.474,8.11,32.378,8.01 C32.322,8.009,32.268,8,32.213,8c-0.022,0-0.043,0.004-0.065,0.004c-7.052,0.039-12.783,6.41-13.125,14.409 c-0.884,0.528-1.394,1.305-1.394,2.469c0,1.641,0.992,3.63,2.663,5.448c1.187,3.327,3.118,6.38,5.5,8.438 c-0.354,2.292-1.699,5.039-5.697,6.776c-2.159,0.938-6.105,1.781-7.808,2.649c4.362,4.769,12.624,7.769,19.589,7.805l0.099,0.003 C31.983,55.999,31.992,56,32,56c7.014,0,15.325-3.01,19.713-7.808C50.01,47.324,46.063,46.481,43.905,45.543z" fill="#FFFFFF"></path></g></g></g></svg></div>
<?php endif; ?>
	<div class="logout-button">
		<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
		<button class="jf_ku_login_close"><svg viewBox="0 0 10.2 10.2"><path d="M5.8,5.1l4.4,4.4l-0.7,0.7L5.1,5.8l-4.4,4.4L0,9.5l4.4-4.4L0,0.7L0.7,0l4.4,4.4L9.5,0l0.7,0.7L5.8,5.1z"></path></svg></button>
	</div>
</div>