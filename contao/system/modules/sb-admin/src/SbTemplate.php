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
		if (TL_MODE != "BE")
		{
			return;
		}
		$theme = $GLOBALS['TL_CONFIG']['backendTheme'];

		$objUser = \BackendUser::getInstance();
		if ($objUser !== null && $objUser->backendTheme != "")
		{
			$theme = $GLOBALS['TL_CONFIG']['backendTheme'];
		}
		if ($theme == "sb-admin")
		{
			/**
			 * Register the templates
			 */
			\TemplateLoader::addFiles(array
			(
				'be_login' => 'system/modules/sb-admin/templates/backend',
				'be_main' => 'system/modules/sb-admin/templates/backend',
				'be_navigation' => 'system/modules/sb-admin/templates/backend',
				'be_picker' => 'system/modules/sb-admin/templates/backend',
				'be_welcome' => 'system/modules/sb-admin/templates/backend',
			));
		}
	}
}
