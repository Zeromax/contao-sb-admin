[![Latest Stable Version](https://poser.pugx.org/zeromax/contao-sb-admin/v/stable)](https://packagist.org/packages/zeromax/contao-sb-admin)
[![Total Downloads](https://poser.pugx.org/zeromax/contao-sb-admin/downloads)](https://packagist.org/packages/zeromax/contao-sb-admin)
[![Latest Unstable Version](https://poser.pugx.org/zeromax/contao-sb-admin/v/unstable)](https://packagist.org/packages/zeromax/contao-sb-admin)
[![License](https://poser.pugx.org/zeromax/contao-sb-admin/license)](https://packagist.org/packages/zeromax/contao-sb-admin)

# contao-sb-admin
This is a back end theme for the Open Source CMS Contao https://contao.org.

It is based on bootstrap and the theme from https://github.com/IronSummitMedia/startbootstrap-sb-admin-2

# License
contao-sb-admin is licensed under the terms of the GNU Lesser General Public License version 3.
https://github.com/Zeromax/contao-sb-admin/blob/master/LICENSE

# Requirements
* PHP >= 5.4.0
* Contao >= 3.2

# Installation
Installation via composer or Extension Repository from Contao

1. install the Extension
2. log in and choose the theme `sb-admin` in your user settings
3. if you add `$GLOBALS['TL_CONFIG']['backendTheme'] = 'sb-admin';` to your localconfig you will get the full support of the theme and you have to copy the following templates to your `template` Folder
    * be_forbidden.html5
    * be_no_active.html5
    * be_no_forward.html5
    * be_no_layout.html5
    * be_no_page.html5
    * be_no_root.html5
    * be_referer.html5
    * be_unavailable.html5
    * be_incomplete.html5
    * be_error.html5

# Used Plugins and Contents
* Background picture from @planepix (http://planepix.de)
* startbootstrap-sb-admin-2 Theme (https://github.com/IronSummitMedia/startbootstrap-sb-admin-2)
* bootstrap (http://getbootstrap.com/)
