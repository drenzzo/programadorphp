<?php
/**
* @version		1.0
* @template		JF Simone
* @author		JoomForest - https://www.joomforest.com
* @copyright	Copyright (C) 2011-2017 JoomForest.com, All rights reserved.
* @license		JoomForest.com Proprietary Use License - https://www.joomforest.com/licenses
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('jquery.framework');
JHtml::_('bootstrap.tooltip');



/*#######
#########
##  1  ##	[FIGUREOUT]
#########
#######*/
/** START ---------------------------------------------------------------------------------------------------------------------------------*/
	$jf_doc 			= JFactory::getDocument();
	$jf_base 			= JURI::base(true);
	$jf_assets_path 	= $jf_base.'/templates/jf_simone/jf/assets/';
	$jf_features_path 	= $jf_base.'/templates/jf_simone/jf/features/';
	// $jf_doc->addScriptDeclaration('alert("phoca loaded")');
/** END   ---------------------------------------------------------------------------------------------------------------------------------*/



/*#######
#########
##  2  ##	[BOOTSTRAP]
#########
#######*/
/** START ---------------------------------------------------------------------------------------------------------------------------------*/
	// remove joomla bootstrap
		unset($jf_doc->_scripts[JURI::root(true).'/media/jui/js/bootstrap.min.js']);
	// load phoca cart bootstrap
		$jf_doc->addScript($jf_base.'/media/com_phocacart/bootstrap/js/bootstrap.min.js');
		$jf_doc->addStyleSheet($jf_base.'/media/com_phocacart/bootstrap/css/bootstrap.min.css');
/** END   ---------------------------------------------------------------------------------------------------------------------------------*/



/*#######
#########
##  3  ##	[PHOCA CART]
#########
#######*/
/** START ---------------------------------------------------------------------------------------------------------------------------------*/
	$jf_doc->addStyleSheet($jf_features_path.'jf_phocacart/jf_phocacart.min.css');
	$jf_doc->addScript($jf_features_path.'jf_phocacart/jf_phocacart.min.js');
/** END   ---------------------------------------------------------------------------------------------------------------------------------*/



