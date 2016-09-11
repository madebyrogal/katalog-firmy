<?php
/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

// no direct file access
! defined( 'ABSPATH' ) AND exit;

VP_Security::instance()->whitelist_function('vp_font_preview');
function vp_font_preview($face, $style, $weight, $size, $line_height)
{
	$gwf   = new VP_Site_GoogleWebFont();
	$gwf->add($face, $style, $weight);
	$links = $gwf->get_font_links();
	$link  = reset($links);
	$dom   = <<<EOD
<link href='$link' rel='stylesheet' type='text/css'>
<p style="padding: 0 10px 0 10px; font-family: $face; font-style: $style; font-weight: $weight; font-size: {$size}px; line-height: {$line_height}em;">
	Grumpy wizards make toxic brew for the evil Queen and Jack
</p>
EOD;
	return $dom;
}


VP_Security::instance()->whitelist_function('vp_dep_boolean_not');
function vp_dep_boolean_not($value)
{
	$args   = func_get_args();
	$result = true;
	foreach ($args as $val)
	{
		$result = ($result and !empty($val));
	}
	return !$result;
}


VP_Security::instance()->whitelist_function('vp_dep_boolean_invert');
function vp_dep_boolean_invert($value)
{
	return !$value;
}