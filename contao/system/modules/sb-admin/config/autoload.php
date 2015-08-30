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
