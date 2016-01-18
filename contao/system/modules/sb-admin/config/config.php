<?php

/**
 * contao-sb-admin
 *
 * Copyright (C) 2015 Andreas Nölke
 *
 * @package   config
 * @author    Andreas Nölke
 * @license   LGPL 3.0
 * @copyright brothers-project 2015
 */

$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('SbTemplate', 'parseTemplate');
$GLOBALS['TL_HOOKS']['initializeSystem'][] = array('SbTemplate', 'chooseTemplates');

if (version_compare(VERSION, '3.2', '<='))
{
	/** Backwards compatibility for old contao */
	$GLOBALS['TL_ASSETS'] = array
	(
		'ACE'          => ACE,
		'CSS3PIE'      => CSS3PIE,
		'DROPZONE'     => DROPZONE,
		'HIGHLIGHTER'  => HIGHLIGHTER,
		'HTML5SHIV'    => HTML5SHIV,
		'RESPIMAGE'    => RESPIMAGE,
		'SWIPE'        => SWIPE,
		'JQUERY'       => JQUERY,
		'JQUERY_UI'    => JQUERY_UI,
		'COLORBOX'     => COLORBOX,
		'MEDIAELEMENT' => MEDIAELEMENT,
		'TABLESORTER'  => TABLESORTER,
		'MOOTOOLS'     => MOOTOOLS,
		'COLORPICKER'  => COLORPICKER,
		'DATEPICKER'   => DATEPICKER,
		'MEDIABOX'     => MEDIABOX,
		'SIMPLEMODAL'  => SIMPLEMODAL,
		'SLIMBOX'      => SLIMBOX
	);
}