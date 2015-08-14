<?php

/**
 * contao-sb-admin
 *
 * Copyright (C) 2015 Andreas Nölke
 *
 * @package   autoload
 * @author    Andreas Nölke
 * @license   LGPL 3.0
 * @copyright brothers-project 2015
 */
/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'SbAdmin',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'SbAdmin\SbTemplate' => 'system/modules/sb-admin/src/SbTemplate.php'
));

/**
 * Register Templates
 */
if ($GLOBALS['TL_CONFIG']['backendTheme'] == "sb-admin")
{
	/**
	 * Register the templates
	 */
	TemplateLoader::addFiles(array
	(
		'be_forbidden' => 'system/modules/sb-admin/templates/backend',
		'be_login' => 'system/modules/sb-admin/templates/backend',
		'be_main' => 'system/modules/sb-admin/templates/backend',
		'be_navigation' => 'system/modules/sb-admin/templates/backend',
		'be_no_active' => 'system/modules/sb-admin/templates/backend',
		'be_no_layout' => 'system/modules/sb-admin/templates/backend',
		'be_no_page' => 'system/modules/sb-admin/templates/backend',
		'be_no_root' => 'system/modules/sb-admin/templates/backend',
		'be_pagination' => 'system/modules/sb-admin/templates/backend',
		'be_password' => 'system/modules/sb-admin/templates/backend',
		'be_picker' => 'system/modules/sb-admin/templates/backend',
		'be_switch' => 'system/modules/sb-admin/templates/backend',
		'be_unavailable' => 'system/modules/sb-admin/templates/backend',
		'be_welcome' => 'system/modules/sb-admin/templates/backend',
	));
}
