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

    /**
     * switch the back end templates and extend them
     *
     * @param \BackendTemplate $objTemplate
     */
    public function parseTemplate($objTemplate)
    {
        $strTemplate = $objTemplate->getName();

        if (\Backend::getTheme() != "sb-admin") {
            return;
        }
        switch ($strTemplate) {
            case "be_main":
                $this->parseMainTemplate($objTemplate);
                break;
            case "be_welcome":
                $this->parseWelcomeTemplate($objTemplate);
                break;
        }
    }

    /**
     * Choose the right template
     */
    public function chooseTemplates()
    {
        // do not choose backend templates in the frontend see #27
        if (TL_MODE == "FE") {
            return;
        }

        // check theme for back end user
        /** @var \BackendUser $objUser */
        $objUser = \Controller::importStatic('BackendUser');
        $loggedIn = $this->beUserLoggedIn($objUser);

        if ($loggedIn === false) {
            return;
        }

        $theme = $objUser->backendTheme;
        if (($loggedIn === false && \Config::get('backendTheme') != "sb-admin") || ($theme !== null && $theme != "sb-admin")) {
            return;
        }

        // modified templates
        $arrTemplate = array(
            'be_changelog',
            'be_chart_panel',
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
        foreach ($arrTemplate as $value) {
            \TemplateLoader::addFile($value, 'system/modules/sb-admin/templates/backend');
        }
    }

    /**
     * parse be_main template
     *
     * @param \BackendTemplate $objTemplate
     */
    protected function parseMainTemplate($objTemplate)
    {
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
        $objTemplate->main = str_replace(
            array("'height':161", "'height':132"),
            array("'height':274", "'height':228"),
            $objTemplate->main
        );
        $objTemplate->main = str_replace(
            "x:-211,y:-209",
            "x:-257,y:-261",
            $objTemplate->main
        );
        $arrHeadline = explode("»", $objTemplate->headline);
        $objTemplate->headline = array_pop($arrHeadline);
        if (count($arrHeadline) > 0) {
            $objTemplate->headlineTrail = implode(' <i class="fa fa-angle-right"></i> ', $arrHeadline) . ' <i class="fa fa-angle-right"></i> ';
        }
        $objTemplate->username = $GLOBALS['TL_LANG']['MSC']['user'];
        $objTemplate->noSystemMessage = $GLOBALS['TL_LANG']['MSC']['noSystemMessage'];
        $objTemplate->systemMessages = $this->getSystemMessages($objTemplate);
    }

    /**
     * generate the system message array
     *
     * @param $objTemplate
     *
     * @return array
     */
    protected function getSystemMessages($objTemplate)
    {
        $arrResult = array();
        $objTemplate->isAdmin;

        if ($objTemplate->isCoreOnlyMode) {
            $arrResult[] = array(
                'text' => $objTemplate->coreOnlyMode,
                'title' => $objTemplate->coreOnlyOff,
                'href' => $objTemplate->coreOnlyHref,
                'label' => 'Core only mode'
            );
        }

        if ($objTemplate->isMaintenanceMode) {
            $arrResult[] = array(
                'text' => $objTemplate->maintenanceMode,
                'title' => $objTemplate->maintenanceOff,
                'href' => $objTemplate->maintenanceHref,
                'label' => 'Wartungsmodus'
            );
        }

        if ($objTemplate->needsCacheBuild) {
            $arrResult[] = array(
                'text' => $objTemplate->buildCacheText,
                'title' => $objTemplate->buildCacheLink,
                'href' => $objTemplate->buildCacheHref,
                'label' => 'Build Cache'
            );
        }

        return $arrResult;
    }

    /**
     * parse be_welcome template
     *
     * @param \BackendTemplate $objTemplate
     */
    protected function parseWelcomeTemplate($objTemplate)
    {
        $objModule = new Module\LogChart();
        $objTemplate->chartLog = $objModule->generate();
    }

    /**
     * check if be user is logged in
     *
     * @param \BackendUser $objUser
     *
     * @return bool
     */
    public function beUserLoggedIn($objUser)
    {
        $objUser->strIp = \Environment::get('ip');
        $strCookie = 'BE_USER_AUTH';
        $objUser->strHash = \Input::cookie($strCookie);
        // Check the cookie hash
        if ($objUser->strHash != sha1(session_id() . (!\Config::get('disableIpCheck') ? $objUser->strIp : '') . $strCookie)) {
            return false;
        }

        $objSession = \Database::getInstance()->prepare("SELECT * FROM tl_session WHERE hash=? AND name=?")
            ->execute($objUser->strHash, $strCookie);

        // Try to find the session in the database
        if ($objSession->numRows < 1) {
            \Controller::log('Could not find the session record', __METHOD__, TL_ACCESS);

            return false;
        }

        $time = time();

        // Validate the session
        if ($objSession->sessionID != session_id() || (!\Config::get('disableIpCheck') && $objSession->ip != $objUser->strIp) || $objSession->hash != $objUser->strHash || ($objSession->tstamp + \Config::get('sessionTimeout')) < $time) {
            \Controller::log('Could not verify the session', __METHOD__, TL_ACCESS);

            return false;
        }

        $objUser->intId = $objSession->pid;

        // Load the user object
        if ($objUser->findBy('id', $objUser->intId) == false) {
            \Controller::log('Could not find the session user', __METHOD__, TL_ACCESS);

            return false;
        }

        return true;
    }
}
