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

namespace SbAdmin\Module;

/**
 * Class LogChart
 *
 * @package   Template
 * @author    Andreas Nölke
 * @copyright brothers-project 2015
 */
class LogChart extends \BackendModule
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_chart_panel';

    /**
     * action array
     * @var array
     */
    protected $arrAction = array('error' => 0, 'cron' => 0, 'forms' => 0, 'access' => 0, 'general' => 0, 'files' => 0);

    /**
     * generate the module
     *
     * @return string
     */
    public function generate()
    {
        if (!$this->hasAccess('log')) {
            return "";
        }
        $objResult = \Database::getInstance()->prepare("SELECT tstamp,source,action FROM tl_log WHERE FROM_UNIXTIME(tstamp) BETWEEN (CURDATE() - INTERVAL 30 DAY) AND SYSDATE() ORDER BY tstamp;")
            ->execute();
        if ($objResult->count() < 1) {
            return "";
        }
        \Config::set('addChart', true);
        $this->arrLog = $objResult->fetchAllAssoc();
        return parent::generate();
    }

    /**
     * Compile the current element
     */
    protected function compile()
    {
        $arrResult = array();
        foreach ($this->arrLog as $key => $data) {
            $tstamp = \Date::parse("Y-m-d", $data['tstamp']);
            if (!isset($arrResult[$tstamp])) {
                $arrResult[$tstamp] = $this->arrAction;
            }
            $arrResult[$tstamp]['date'] = $tstamp;
            $arrResult[$tstamp]['tstamp'] = $data['tstamp'];
            $arrResult[$tstamp][strtolower($data['action'])] += 1;
        }
        $arrData = array();
        foreach ($arrResult as $value) {
            $arrData[] = $value;
        }

        $arrAction = array_keys($this->arrAction);
        $arrColor = $this->getColorArray($arrAction);
        $arrLabels = $arrAction;
        $arrLabels = array_map("ucfirst", $arrLabels);

        $this->Template->data = json_encode($arrData);
        $this->Template->yKeys = "['" . implode("','", $arrAction) . "']";
        $this->Template->labels = "['" . implode("','", $arrLabels) . "']";
        $this->Template->lineColors = "['" . implode("','", $arrColor) . "']";
        $this->Template->xKey = "date";
        $this->Template->headline = $GLOBALS['TL_LANG']['MOD']['log'][0];
    }

    /**
     * check module access
     *
     * @param $module
     *
     * @return bool
     */
    protected function hasAccess($module)
    {
        $arrModule = array();

        foreach ($GLOBALS['BE_MOD'] as &$arrGroup) {
            if (isset($arrGroup[$module])) {
                $arrModule =& $arrGroup[$module];
                break;
            }
        }

        $arrInactiveModules = \ModuleLoader::getDisabled();

        // Check whether the module is active
        if (is_array($arrInactiveModules) && in_array($module, $arrInactiveModules)) {
            return false;
        }

        $this->import('BackendUser', 'User');

        // Check whether the current user has access to the current module
        if (!$this->User->hasAccess($module, 'modules')) {
            return false;
        }

        return true;
    }

    /**
     * get the color array
     *
     * @param $arrAction
     *
     * @return array
     */
    protected function getColorArray($arrAction)
    {
        $arrColor = array();
        foreach ($arrAction as $value) {
            switch ($value) {
                case 'error':
                    $arrColor[] = "#c33";
                    break;
                case 'cron':
                    $arrColor[] = "#77ac45";
                    break;
                case 'forms':
                    $arrColor[] = "#4b85ba";
                    break;
                case 'access':
                    $arrColor[] = "#999";
                    break;
                default:
                    $arrColor[] = "#000";
            }
        }
        return $arrColor;
    }
}