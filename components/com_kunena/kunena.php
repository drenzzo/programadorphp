<?php
/**
 * Kunena Component
 *
 * @package        Kunena.Site
 *
 * @copyright      Copyright (C) 2008 - 2022 Kunena Team. All rights reserved.
 * @license        https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link           https://www.kunena.org
 **/
defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Plugin\PluginHelper;

// Display offline message if Kunena hasn't been fully installed.
if (!class_exists('KunenaForum') || !KunenaForum::isCompatible('4.0') || !KunenaForum::installed())
{
	$lang = Factory::getLanguage();
	$lang->load('com_kunena.install', JPATH_ADMINISTRATOR . '/components/com_kunena', 'en-GB');
	$lang->load('com_kunena.install', JPATH_ADMINISTRATOR . '/components/com_kunena');
	Factory::getApplication()->setHeader('Status', '503 Service Temporarily Unavailable', true);
	Factory::getApplication()->sendHeaders();
	?>
	<h2><?php echo Text::_('COM_KUNENA_INSTALL_OFFLINE_TOPIC') ?></h2>
	<div><?php echo Text::_('COM_KUNENA_INSTALL_OFFLINE_DESC') ?></div>
	<?php
	return;
}

// Display time it took to create the entire page in the footer.
$kunena_profiler = KunenaProfiler::instance('Kunena');
$kunena_profiler->start('Total Time');
KUNENA_PROFILER ? $kunena_profiler->mark('afterLoad') : null;

// Prevent direct access to the component if the option has been disabled.
if (!KunenaConfig::getInstance()->get('access_component', 1))
{
	$active = Factory::getApplication()->getMenu()->getActive();

	if (!$active)
	{
		// Prevent access without using a menu item.
		Log::add("Kunena: Direct access denied: " . Uri::getInstance()->toString(array('path', 'query')), Log::WARNING, 'kunena');
		throw new Exception(Text::_('JLIB_APPLICATION_ERROR_COMPONENT_NOT_FOUND'), 404);
	}
	elseif ($active->type != 'component' || $active->component != 'com_kunena')
	{
		// Prevent spoofed access by using random menu item.
		Log::add("Kunena: spoofed access denied: " . Uri::getInstance()->toString(array('path', 'query')), Log::WARNING, 'kunena');
		throw new Exception(Text::_('JLIB_APPLICATION_ERROR_COMPONENT_NOT_FOUND'), 404);
	}
}

// Load router
require_once KPATH_SITE . '/router.php';

// Initialize Kunena Framework.
KunenaForum::setup();

// Initialize custom error handlers.
KunenaError::initialize();

// Initialize session.
$ksession = KunenaFactory::getSession(true);

if ($ksession->userid > 0)
{
	// Create user if it does not exist
	$kuser = KunenaUserHelper::getMyself();

	if (!$kuser->exists())
	{
		$kuser->save();
	}

	// Save session
	if (!$ksession->save())
	{
		Factory::getApplication()->enqueueMessage(Text::_('COM_KUNENA_ERROR_SESSION_SAVE_FAILED'), 'error');
	}
}

// Support legacy urls (they need to be redirected).
$app   = Factory::getApplication();
$input = $app->input;
$input->set('limitstart', $input->getInt('limitstart', $input->getInt('start')));
$view    = $input->getWord('func', $input->getWord('view', 'home'));
$subview = $input->getWord('layout', 'default');
$task    = $input->getCmd('task', 'display');

// Import plugins and event listeners.
\Joomla\CMS\Plugin\PluginHelper::importPlugin('kunena');

// Get HMVC controller and if exists, execute it.
$controller = KunenaControllerApplication::getInstance($view, $subview, $task, $input, $app);

if ($controller)
{
	KunenaRoute::cacheLoad();
	$contents = $controller->execute();
	KunenaRoute::cacheStore();
}
elseif (is_file(KPATH_SITE . "/controllers/{$view}.php"))
{
	// Execute old MVC.
	// Legacy support: If the content layout doesn't exist on HMVC, load and execute the old controller.
	$controller = KunenaController::getInstance();
	KunenaRoute::cacheLoad();
	ob_start();
	$controller->execute($task);
	$contents = ob_get_clean();
	KunenaRoute::cacheStore();
	$controller->redirect();
}
else
{
	// Legacy URL support.
	$uri = KunenaRoute::current(true);

	if ($uri)
	{
		// FIXME: using wrong Itemid
		Factory::getApplication()->redirect(KunenaRoute::_($uri, false));
	}
	else
	{
		throw new Exception("Kunena view '{$view}' not found", 404);
	}
}

// Prepare and display the output.
$params       = new stdClass;
$params->text = '';
$topics       = new stdClass;
$topics->text = '';
PluginHelper::importPlugin('content');
Factory::getApplication()->triggerEvent('onContentPrepare', array("com_kunena.{$view}", &$topics, &$params, 0));
Factory::getApplication()->triggerEvent('onKunenaBeforeRender', array("com_kunena.{$view}", &$contents));
$contents = (string) $contents;
Factory::getApplication()->triggerEvent('onKunenaAfterRender', array("com_kunena.{$view}", &$contents));
echo $contents;

// Remove custom error handlers.
KunenaError::cleanup();

// kunena conflicts with jot_cache, due to huge object message in app-inputs.
//  this huje object causes crash. so, need to cleanup app-inputs before exit here.
$app->input->set('message', NULL);

// Display profiler information.
if (KUNENA_PROFILER)
{
	$kunena_profiler->stop('Total Time');

	echo '<div class="kprofiler">';
	echo "<h3>Kunena Profile Information</h3>";

	foreach ($kunena_profiler->getAll() as $item)
	{
		echo sprintf("Kunena %s: %0.3f / %0.3f seconds (%d calls)<br/>", $item->name, $item->getInternalTime(),
			$item->getTotalTime(), $item->calls
		);
	}

	echo '</div>';
}
