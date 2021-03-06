<?php
/**
 * Kunena Component
 *
 * @package         Kunena.Site
 * @subpackage      Controllers.Misc
 *
 * @copyright       Copyright (C) 2008 - 2022 Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * KunenaLayoutWidgetModule
 *
 * @since  K4.0
 */
class KunenaLayoutWidgetModule extends KunenaLayout
{
	/**
	 * @var null
	 * @since Kunena
	 */
	public $position = null;

	/**
	 * Renders module position.
	 *
	 * @return string
	 * @since Kunena
	 */
	public function renderPosition()
	{
		$document = Factory::getDocument();

		if ($this->position && $document->countModules($this->position))
		{
			$renderer = $document->loadRenderer('modules');
			$options  = array('style' => 'xhtml');

			return (string) $renderer->render($this->position, $options, null);
		}

		return '';
	}
}
