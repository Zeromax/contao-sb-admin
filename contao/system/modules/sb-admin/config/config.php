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

if (TL_MODE == "BE")
{
	$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('SbTemplate', 'chooseTemplates');
}