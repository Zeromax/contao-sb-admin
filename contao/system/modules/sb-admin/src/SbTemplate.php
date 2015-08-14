<?php

/**
 * contao-sb-admin
 *
 * Copyright (C) 2015 Andreas Nölke
 *
 * @package   contao-sb-admin
 * @author    Andreas Nölke
 * @license   LGPL 3.0
 * @copyright brothers-project 2015
 */
/**
 * Run in a custom namespace, so the class can be replaced
 */

namespace SbAdmin;

/**
 * Class SbTemplate
 *
 * @package   Template
 * @author    Andreas Nölke
 * @copyright brothers-project 2015
 */
class SbTemplate
{
	public function chooseTemplates()
	{
		$theme = $GLOBALS['TL_CONFIG']['backendTheme'];

		// already set in autoload
		if ($theme == "sb-admin")
		{
			return;
		}

		// check them for back end user
		$objUser = \BackendUser::getInstance();
		if ($objUser === null || ($objUser !== null && $objUser->backendTheme != "sb-admin"))
		{
			return;
		}

		/**
		 * Register the templates
		 */
		\TemplateLoader::addFiles(array
		(
			'be_forbidden' => 'system/modules/sb-admin/templates/backend',
			'be_install' => 'system/modules/sb-admin/templates/backend',
			'be_login' => 'system/modules/sb-admin/templates/backend',
			'be_main' => 'system/modules/sb-admin/templates/backend',
			'be_navigation' => 'system/modules/sb-admin/templates/backend',
			'be_no_active' => 'system/modules/sb-admin/templates/backend',
			'be_no_forward' => 'system/modules/sb-admin/templates/backend',
			'be_no_layout' => 'system/modules/sb-admin/templates/backend',
			'be_no_page' => 'system/modules/sb-admin/templates/backend',
			'be_no_root' => 'system/modules/sb-admin/templates/backend',
			'be_pagination' => 'system/modules/sb-admin/templates/backend',
			'be_password' => 'system/modules/sb-admin/templates/backend',
			'be_picker' => 'system/modules/sb-admin/templates/backend',
			'be_popup' => 'system/modules/sb-admin/templates/backend',
			'be_referer' => 'system/modules/sb-admin/templates/backend',
			'be_switch' => 'system/modules/sb-admin/templates/backend',
			'be_unavailable' => 'system/modules/sb-admin/templates/backend',
			'be_welcome' => 'system/modules/sb-admin/templates/backend',
		));
	}
}
