<?php
/**
 * Kunena Login Module
 *
 * @package       Kunena.mod_kunenalogin
 *
 * @copyright (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license       http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link          http://www.kunena.org
 **/
defined('_JEXEC') or die();
?>
<?php if ($this->type == 'logout') : ?>
	<div class="jf_ku_login_modal jf_logged">
		<div class="jf_ku_login_modal_inner">
			<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" name="login">
				<input type="hidden" name="option" value="com_kunena" />
				<input type="hidden" name="view" value="user" />
				<input type="hidden" name="task" value="logout" />
				<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
				<?php echo JHTML::_('form.token'); ?>

				<?php if ($this->params->get('greeting'))
				:
		?>
					<div class="klogin-hiname">
						<?php echo JText::sprintf('MOD_KUNENALOGIN_HINAME', '<strong>' . $this->me->getLink($this->me->getName()) . '</strong>', $this->me->getName()); ?>
					</div>
				<?php endif; ?>
				<div class="img-rounded">
					<?php if ($this->params->get('showav'))
					{
						echo $this->kunenaAvatar($this->me->userid);
		} ?>
				</div>
				<div>
					<?php if ($this->params->get('lastlog'))
					:
		?>
						<div class="klogin-lastvisit">
							<ul>
								<li class="kms">
									<span class="klogin-lasttext"><?php echo JText::_('MOD_KUNENALOGIN_LASTVISIT'); ?></span>
									<?php echo $this->lastvisitDate->toSpan('date_today', 'ago', false, 'klogin-lastdate') ?>
								</li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				<div>
					<ul class="klogin-loginlink">
						<?php if ($this->privateMessages)
						:
		?>
							<li class="klogin-mypm"><?php echo $this->privateMessages; ?></li>
						<?php endif; ?>
						<?php
						if ($this->params->get('showprofile'))
						:
		?>
							<li class="klogin-myprofile"><?php echo $this->me->getLink(JText::_('MOD_KUNENALOGIN_MYPROFILE')); ?></li>
						<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                         endif; ?>
						<?php
						if ($this->params->get('showmyposts'))
						:
		?>
							<li class="klogin-mypost"><?php echo $this->myPosts ?></li>
						<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                         endif; ?>
						<?php
						if ($this->params->get('showrecent'))
						:
		?>
							<li class="klogin-recent"><?php echo $this->recentPosts ?></li>
						<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                         endif; ?>
					</ul>
				</div>
				<div class="klogin-links">
					<button type="submit" name="Submit" class="jf_ku_login_submit" data-tilt="10">
						<span class="jf_ku_login_btn_text"><?php echo JText::_('MOD_KUNENALOGIN_BUTTON_LOGOUT'); ?></span>
						<span class="jf_ku_login_spinner"><svg viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/></svg></span>
					</button>
				</div>
			</form>
			<button class="jf_ku_login_close"><svg viewBox="0 0 10.2 10.2"><path d="M5.8,5.1l4.4,4.4l-0.7,0.7L5.1,5.8l-4.4,4.4L0,9.5l4.4-4.4L0,0.7L0.7,0l4.4,4.4L9.5,0l0.7,0.7L5.8,5.1z"></path></svg></button>
		</div>
	</div>
<?php else: ?>
	<div class="jf_ku_login_modal">
		<div class="jf_ku_login_modal_inner">
			<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" name="login" class="">
				<input type="hidden" name="option" value="com_kunena" />
				<input type="hidden" name="view" value="user" />
				<input type="hidden" name="task" value="login" />
				<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
				<?php echo JHTML::_('form.token'); ?>

				<?php echo $this->params->get('pretext'); ?>
				<div id="form-login-username" class="jf_waves_dark_20">
					<input id="modlgn-username" type="text" name="username" class="" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_KUNENALOGIN_USERNAME') ?>" />
				</div>
				<div id="form-login-password" class="jf_waves_dark_20">
					<input id="modlgn-passwd" type="password" name="password" class="" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_KUNENALOGIN_PASSWORD') ?>" />
				</div>
				
				<?php $login = KunenaLogin::getInstance(); ?>
				<?php
				if ($login->getTwoFactorMethods() > 1)
				:
	?>
					<div id="form-login-secretkey" class="jf_waves_dark_20">
						<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
					</div>
				<?php endif; ?>
				<?php
					if (JPluginHelper::isEnabled('system', 'remember'))
					:
				?>
					<div id="form-login-remember" class="control-group center">
						<div class="controls">
							<div class="input-prepend input-append">
								<input id="login-remember" type="checkbox" name="remember" class="inputbox" value="yes" />
								<label for="login-remember" class="control-label">
									<?php echo JText::_('MOD_KUNENALOGIN_REMEMBER_ME'); ?>
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
				<div class="jf_ku_footer_links_wrap">
					<div class="jf_ku_footer_links">
						<p>
							<a href="<?php echo $this->lostPasswordUrl ?>" rel="nofollow"><?php echo JText::_('COM_KUNENA_PROFILEBOX_FORGOT_PASSWORD') ?></a>
							<br />
							<a href="<?php echo $this->lostUsernameUrl ?>" rel="nofollow"><?php echo JText::_('COM_KUNENA_PROFILEBOX_FORGOT_USERNAME') ?></a>
						</p>
					</div>
					<?php if ($this->registerUrl) : ?>
					<div class="jf_ku_footer_links">
						<p>
							<a class="jf_ku_login_register" data-tilt="10" href="<?php echo $this->registerUrl ?>" rel="nofollow">
								<span class="jf_ku_login_btn_text"><?php echo JText::_('COM_KUNENA_PROFILEBOX_CREATE_ACCOUNT') ?></span>
								<span class="jf_ku_login_spinner"><svg viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/></svg></span>
							</a>
						</p>
					</div>
					<?php endif; ?>
				</div>

				<?php echo $this->params->get('posttext'); ?>
			</form>
			<button class="jf_ku_login_close"><svg viewBox="0 0 10.2 10.2"><path d="M5.8,5.1l4.4,4.4l-0.7,0.7L5.1,5.8l-4.4,4.4L0,9.5l4.4-4.4L0,0.7L0.7,0l4.4,4.4L9.5,0l0.7,0.7L5.8,5.1z"></path></svg></button>
		</div>
	</div>
<?php endif; ?>