<?php
/*------------------------------------------------------------------------
 * Copyright (C) 2013 The SNS Theme. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: SNS Theme
 * Websites: http://www.snstheme.com
-------------------------------------------------------------------------*/
/*--- BEGIN: Theme param config ---*/
$params = new ThemeParameter();
$config = array(
	'showCpanel'				=>'1',
	'showTooltip'				=>'1',
	'fontSize'					=>'12px',
	'fontFamily'				=>'arial',
	'themeColor'				=>'black',
	'layoutType'				=>'1',
	'menuStyles'				=>'css',
	'resMenu'					=>'sidebar',
	'keepMenu'					=>'1',
	'bodyBgColor'				=>'#ffffff',
	'bodyBgImage'				=>'',
	'googleFont'				=>'',
	'googleFontTargets'			=>'',
	'googleFontWeight'			=>'300',
	'useTagNew'					=>'1',
	'useTagSale'				=>'1',
	'scrollToTop'				=>'',
	'displayAddtocart'			=>'1',
	'displayWishlist'			=>'1',
	'displayCompare'			=>'1',
	'usePromotionBar'			=>'',
	'blockForPR'				=>'',
	'useAddThis'				=>'1'
);
// Array param for cookie
$paramscookie =array(
					'fontSize',
					'keepMenu',
					'bodyBgColor',
					'bodyBgImage'
);
if(Mage::getConfig()->getNode('modules/Sns_Dmmk')){
	$config	=	Mage::helper('dmmk/data')->get(); //Zend_Debug::dump($config); die();
}
// enable Cpanel
$params->set('showCpanel',$config['showCpanel']);
// enable showTooltip
$params->set('showTooltip',$config['showTooltip']);
// Fontsize
$params->set('fontSize',$config['fontSize']);
// font family
$params->set('fontFamily',$config['fontFamily']);
// Body background-color
$params->set('bodyBgColor', $config['bodyBgColor']);
// bodyBgImage
$params->set('bodyBgImage', $config['bodyBgImage']);
//
$params->set('googleFont', $config['googleFont']);
//
$params->set('googleFontWeight',$config['googleFontWeight']);
// Theme color
$params->set('themeColor',$config['themeColor']);//'black','blue','brown','cyan';
//
$params->set('layoutType',$config['layoutType']);
// Menu styles
$params->set('menuStyles', $config['menuStyles']);
// Res menu
$params->set('resMenu', $config['resMenu']);
//
$params->set('keepMenu', $config['keepMenu']);
// Body text color
$params->set('googleFontTargets', $config['googleFontTargets']);
//
$params->set('useTagNew', $config['useTagNew']);
//
$params->set('useTagSale', $config['useTagSale']);
//
$params->set('scrollToTop', $config['scrollToTop']);
//
$params->set('displayAddtocart', $config['displayAddtocart']);
//
$params->set('displayWishlist', $config['displayWishlist']);
//
$params->set('displayCompare', $config['displayCompare']);
//
$params->set('usePromotionBar', $config['usePromotionBar']);
//
$params->set('blockForPR', $config['blockForPR']);
//
$params->set('useAddThis', $config['useAddThis']);
/*--- END: Theme param config ---*/
global $var_snstheme;
$var_snstheme = new SNSTheme('sns_dmmk', $params, $paramscookie);
?>


