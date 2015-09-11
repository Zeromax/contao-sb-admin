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
 * Class Image
 *
 * @package   sb-admin
 * @author    Andreas Nölke
 * @copyright brothers-project 2015
 */
class Image extends \Contao\Image
{

    /**
     * return a icon tag instead of an Image
     *
     * @param string $src
     * @param string $alt
     * @param string $attributes
     *
     * @return string
     */
    public static function getHtml($src, $alt = '', $attributes = '')
    {
        // Only do this in the Backend
        if (TL_MODE == "FE" || \Backend::getTheme() != "sb-admin") {
            return parent::getHtml($src, $alt, $attributes);
        }

        $arrImage = array(
            'article.gif' => 'share',
            'article_.gif' => 'share icon-disabled',
            'copychilds.gif' => 'files-o',
            'copychilds_.gif' => 'files-o icon-disabled',
            'apply.gif' => 'check-circle',
            'copy.gif' => 'plus',
            'cut.gif' => 'sort',
            'delete.gif' => 'trash-o',
            'edit.gif' => 'pencil',
            'editor.gif' => 'file-code-o',
            'editor_.gif' => 'file-code-o icon-disabled',
            'featured_.gif' => 'star-o',
            'featured.gif' => 'star',
            'header.gif' => 'cogs',
            'invisible.gif' => 'eye-slash',
            'new.gif' => 'plus-circle',
            'pasteafter.gif' => 'caret-down',
            'pasteafter_.gif' => 'caret-down icon-disabled',
            'pasteinto.gif' => 'caret-right',
            'pasteinto_.gif' => 'caret-right icon-disabled',
            'protect.gif' => 'unlock',
            'protect_.gif' => 'lock',
            'show.gif' => 'info',
            'undo.gif' => 'undo',
            'visible.gif' => 'eye',
            'modules.gif' => 'cogs',
            'pagemounts.gif' => 'globe',
            'root.gif' => 'globe',
            'root_1.gif' => 'globe icon-disabled',
            'diff.gif' => 'tasks',
            'diffTemplate.gif' => 'tasks',
            'diff_.gif' => 'tasks icon-disabled',
            'diffTemplate_.gif' => 'tasks icon-disabled',
            'drag.gif' => 'sort',
            'up.gif' => 'arrow-up',
            'down.gif' => 'arrow-down',
            'folMinus.gif' => 'minus-square-o',
            'folPlus.gif' => 'plus-square-o',
            'mgroup.gif' => 'users',
            'member.gif' => 'user',
            'member_.gif' => 'user icon-disabled',
            'su.gif' => 'qq',
        );

        if (array_key_exists($src, $arrImage)) {
            preg_match('/class=\"([^\"]*)\"/', $attributes, $matches);
            $cssClass = isset($matches[1]) ? " " . $matches[1] : "";

            return sprintf('<i class="fa fa-%s%s action-icon"></i>', $arrImage[$src], $cssClass);
        }

        return parent::getHtml($src, $alt, $attributes);
    }
}