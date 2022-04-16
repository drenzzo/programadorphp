<?php
/**
* @version		JF_KU_DTF_078
* @author		JoomForest http://www.joomforest.com
* @copyright	Copyright (C) 2011-2016 JoomForest.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');$version = new JVersion;$joomla = $version->getShortVersion();if(substr($joomla,0,3) > '2.5'){JHtml::_('jquery.framework');}jimport('joomla.environment.browser');$jf_doc=JFactory::getDocument();$jf_base=JURI::root();$jf_ku_tmpl_name='jf_business_ku_3';$jf_assets_path=$jf_base.'components/com_kunena/template/'.$jf_ku_tmpl_name.'/jf/jf_tmpl_assets/';if(KunenaFactory::getConfig()->lightbox==1){$jf_doc->addStyleSheet($jf_base.'components/com_kunena/template/blue_eagle/css/mediaboxAdv-min.css');$jf_doc->addScript($jf_base.'media/kunena/js/mediaboxAdv-min.js');}$jf_doc->addStyleSheet($jf_base.'components/com_kunena/template/blue_eagle/css/kunena.forum-min.css');$jf_doc->addStyleSheet($jf_base.'components/com_kunena/template/blue_eagle/css/kunena.responsive-min.css');$jf_doc->addStyleSheet($jf_base.'components/com_kunena/template/blue_eagle/css/kunena.default-min.css');$jf_doc->addScript($jf_base.'media/kunena/js/default-min.js');$jf_doc->addStyleSheet($jf_assets_path.'css-compiled/jf_template.min.css');$jf_doc->addStyleSheet($jf_assets_path.'css-compiled/jf_theme_resp.min.css');$jf_browser=JBrowser::getInstance();$jf_browserType=$jf_browser->getBrowser();$jf_browserVersion=$jf_browser->getMajor();if(($jf_browserType=='msie')&&($jf_browserVersion=8)){$jf_doc->addStyleSheet($jf_assets_path.'css-compiled/jf_theme_ie8.min.css');}if(($jf_browserType=='mozilla')){$jf_doc->addStyleSheet($jf_assets_path.'css-compiled/jf_theme_gecko.min.css');}if(($jf_browserType=='opera')){$jf_doc->addStyleSheet($jf_assets_path.'css-compiled/jf_theme_opera.min.css');}if($jf_doc->direction=='rtl'){$jf_doc->addStyleSheet($jf_assets_path.'css-compiled/jf_theme_rtl.min.css');$jf_doc->addScriptDeclaration('jQuery(document).ready(function($){$("#Kunena").addClass("jf_ku_rtl")});');}$jf_doc->addScript($jf_assets_path.'js/jf.min.js');if($this->params->get('jf_ku_jQuery')){$jf_doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');}if($this->params->get('jf_ku_jQuerynoConflict')){$jf_doc->addScriptDeclaration('jQuery.noConflict();');}if($this->params->get('jf_ku_GoogleWebFont')==1){$jf_ku_GoogleFontSheet=$this->params->get('jf_ku_GoogleFontSheet');$jf_ku_GoogleFontTags=$this->params->get('jf_ku_GoogleFontTags');$jf_ku_GoogleFontFace=$this->params->get('jf_ku_GoogleFontFace');if($this->params->get('jf_ku_GoogleFontSheet')){$jf_doc->addStyleSheet(''.$jf_ku_GoogleFontSheet.'');}$jf_doc->addStyleDeclaration(''.$jf_ku_GoogleFontTags.'{font-family:"'.$jf_ku_GoogleFontFace.'",arial,tahoma!important}');}if($this->params->get('jf_ku_UnlimColors')==1){$jf_ku_UC_MainActive=$this->params->get('jf_ku_UC_MainActive');$jf_ku_UC_MainInactive=$this->params->get('jf_ku_UC_MainInactive');$jf_ku_UC_Header=$this->params->get('jf_ku_UC_Header');$jf_ku_UC_MenuH=$this->params->get('jf_ku_UC_MenuH');$jf_doc->addStyleDeclaration('body #Kunena a:link,body #Kunena a:visited,body #Kunena a:active,body #Kunena a:focus,body #Kunena #kprofilebox .kbody .kprofileboxcnt .klink-block a:hover{color:'.$jf_ku_UC_MainActive.' !important}body #Kunena input.kbutton,body #Kunena button.kbutton,body #Kunena input.kbutton:hover,body #Kunena button.kbutton:hover,body #Kunena input.kbutton:focus,body #Kunena button.kbutton:focus,body #Kunena td.krowmoderation input.kbutton,body #Kunena #kprofilebox .kbody .kprofileboxcnt .input .kbutton,body #Kunena #kprofilebox .kbody ul.kprofilebox-welcome li input.kbutton{background-color:'.$jf_ku_UC_MainActive.'}body #Kunena #kprofilebox .kbody .kprofilebox-link li a,body #Kunena #kflattable ul.kpagination li a{background-color:'.$jf_ku_UC_MainActive.' !important}body #Kunena .kpagination span,body #Kunena dl.tabs dt.open{border-color:'.$jf_ku_UC_MainActive.';background-color:'.$jf_ku_UC_MainActive.'}body #Kunena dl.tabs dt:hover{border-color:'.$jf_ku_UC_MainActive.'}body #Kunena #kpost-buttons .kbutton[name="cancel"],body #Kunena #kpost-buttons .kbutton[name="cancel"]:hover,body #Kunena #kforumsearch input[type="reset"],body #Kunena #kforumsearch input[type="reset"]:hover,body #Kunena #kprofile #kaddban .kbutton{background-color:'.$jf_ku_UC_MainInactive.'}body #Kunena .kblock div.kheader{background-color:'.$jf_ku_UC_Header.' !important}body #Kunena #ktop ul.menu li a span{color:'.$jf_ku_UC_MenuH.'}body #Kunena #ktop ul.menu li:hover,body #Kunena #ktop ul.menu li.active{background-color:'.$jf_ku_UC_MenuH.'}@media(max-width:579px){body #Kunena #ktab ul.menu li a:hover,body #Kunena #ktab ul.menu li a:hover span{background-color:'.$jf_ku_UC_MenuH.' !important}}');}$jf_ku_CustomCSS=$this->params->get('jf_ku_CustomCSS');$jf_doc->addStyleDeclaration(''.$jf_ku_CustomCSS.'');