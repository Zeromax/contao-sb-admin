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

    public function parseTemplate($objTemplate)
    {
        if ($objTemplate->getName() != "be_main" || \Backend::getTheme() != "sb-admin") {
            return;
        }
        $objTemplate->main = str_replace(
            array(
                '<table class="tl_listing',
                '<table class="tl_show'),
            '<table class="table table-hover no-footer',
            $objTemplate->main
        );
        $objTemplate->main = str_replace(
            '<table class="tl_optionwizard',
            '<table class="tl_optionwizard table',
            $objTemplate->main
        );
        $objTemplate->main = str_replace(
            'class="tl_chmod',
            'class="tl_chmod table table-striped table-hover',
            $objTemplate->main
        );
        $arrHeadline = explode("»", $objTemplate->headline);
        $objTemplate->headline = array_pop($arrHeadline);
        if (count($arrHeadline) > 0) {
            $objTemplate->headlineTrail = implode(' <i class="fa fa-angle-right"></i> ', $arrHeadline) . ' <i class="fa fa-angle-right"></i> ';
        }
        $objTemplate->username = $GLOBALS['TL_LANG']['MSC']['user'];
    }

    /**
     * Choose the right template
     *
     * @param \BackendTemplate $objTemplate
     */
    public function chooseTemplates($objTemplate)
    {
        // check them for back end user
        $objUser = \BackendUser::getInstance();
        if (\Config::get('backendTheme') != "sb-admin" && ($objUser !== null && $objUser->backendTheme != "sb-admin")) {
            return;
        }

        // modified templates
        $arrTemplate = array(
            'be_changelog',
            'be_confirm',
            'be_diff',
            'be_error',
            'be_forbidden',
            'be_help',
            'be_incomplete',
            'be_install',
            'be_login',
            'be_main',
            'be_navigation',
            'be_no_active',
            'be_no_forward',
            'be_no_layout',
            'be_no_page',
            'be_no_root',
            'be_pagination',
            'be_password',
            'be_picker',
            'be_popup',
            'be_purge_data',
            'be_referer',
            'be_switch',
            'be_unavailable',
            'be_welcome'
        );

        // Register the template
        if (in_array($objTemplate->getName(), $arrTemplate)) {
            \TemplateLoader::addFile($objTemplate->getName(), 'system/modules/sb-admin/templates/backend');
        }
    }
}
