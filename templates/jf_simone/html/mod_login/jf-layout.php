<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>
<div class="jf_ku_login_modal">
	<div class="jf_ku_login_modal_inner">
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="" class="">
	<?php if ($params->get('pretext')) : ?>
		<div class="pretext">
			<?php echo $params->get('pretext'); ?>
		</div>
	<?php endif; ?>
	
		<div id="form-login-username" class="jf_waves_dark_20">
			<input id="modlgn-username" type="text" name="username" class="" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
		</div>
		<div id="form-login-password" class="jf_waves_dark_20">
			<input id="modlgn-passwd" type="password" name="password" class="" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
		</div>
				
		<?php if (count($twofactormethods) > 1): ?>
		<div id="form-login-secretkey" class="jf_waves_dark_20">
			<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
		</div>
		<?php endif; ?>
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div id="form-login-remember" class="control-group center">
			<div class="controls">
				<div class="input-prepend input-append">
					<input id="login-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
					<label for="login-remember" class="control-label">
						<?php echo JText::_('MOD_LOGIN_REMEMBER_ME'); ?>
					</label>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div id="form-login-submit">
			<p>
				<button type="submit" tabindex="3" name="submit" class="jf_ku_login_submit" data-tilt="10">
					<span class="jf_ku_login_btn_text"><?php echo JText::_('JF_LOGIN_SIGN_IN'); ?></span>
					<span class="jf_ku_login_spinner"><svg viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/></svg></span>
				</button>
			</p>
		</div>
		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
		<div class="jf_ku_footer_links_wrap">
			<div class="jf_ku_footer_links">
				<p>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid=' . UsersHelperRoute::getResetRoute()); ?>" rel="nofollow"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD') ?></a>
					<br />
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind&Itemid=' . UsersHelperRoute::getRemindRoute()); ?>" rel="nofollow"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME') ?></a>
				</p>
			</div>
			<?php if ($usersConfig->get('allowUserRegistration')) : ?>
			<div class="jf_ku_footer_links">
				<p>
					<a class="jf_ku_login_register" data-tilt="10" href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=' . UsersHelperRoute::getRegistrationRoute()); ?>" rel="nofollow">
						<span class="jf_ku_login_btn_text"><?php echo JText::_('MOD_LOGIN_REGISTER') ?></span>
						<span class="jf_ku_login_spinner"><svg viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/></svg></span>
					</a>
				</p>
			</div>
			<?php endif; ?>
		</div>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	
	<?php if ($params->get('posttext')) : ?>
		<div class="posttext">
			<?php echo $params->get('posttext'); ?>
		</div>
	<?php endif; ?>
</form>
		<button class="jf_ku_login_close"><svg viewBox="0 0 10.2 10.2"><path d="M5.8,5.1l4.4,4.4l-0.7,0.7L5.1,5.8l-4.4,4.4L0,9.5l4.4-4.4L0,0.7L0.7,0l4.4,4.4L9.5,0l0.7,0.7L5.8,5.1z"></path></svg></button>
	</div>
</div>