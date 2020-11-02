<?php

    /**
     * Plugin Name: Theme Helpers
     * Description: Common helpers for themes
     * Plugin URI:  https://github.com/nox-it/wp-nox-theme-helpers
     * Author:      NOX IT
     * Author URI:  https://github.com/nox-it
     * License:     GNU General Public License v2 or later
     * License URI: http://www.gnu.org/licenses/gpl-2.0.html
     * Version:     1.0.0
     */

    defined('ABSPATH') or die();

    defined('ENV_IS_DEVELOPMENT')                      or define('ENV_IS_DEVELOPMENT',                      false);
    defined('ENV_IS_STAGING')                          or define('ENV_IS_STAGING',                          false);
    defined('ENV_IS_PRODUCTION')                       or define('ENV_IS_PRODUCTION',                       false);
    defined('NOX_DISABLE_THEME_HELPERS')               or define('NOX_DISABLE_THEME_HELPERS',               false);
    defined('NOX_DISABLE_THEME_HELPERS_GMAPS')         or define('NOX_DISABLE_THEME_HELPERS_GMAPS',         false);
    defined('NOX_DISABLE_THEME_HELPERS_ACF')           or define('NOX_DISABLE_THEME_HELPERS_ACF',           false);
    defined('NOX_DISABLE_THEME_HELPERS_ADMIN')         or define('NOX_DISABLE_THEME_HELPERS_ADMIN',         false);
    defined('NOX_DISABLE_THEME_HELPERS_AT_A_GLANCE')   or define('NOX_DISABLE_THEME_HELPERS_AT_A_GLANCE',   false);
    defined('NOX_DISABLE_THEME_HELPERS_CACHE')         or define('NOX_DISABLE_THEME_HELPERS_CACHE',         false);
    defined('NOX_DISABLE_THEME_HELPERS_CRON')          or define('NOX_DISABLE_THEME_HELPERS_CRON',          false);
    defined('NOX_DISABLE_THEME_HELPERS_GENERIC')       or define('NOX_DISABLE_THEME_HELPERS_GENERIC',       false);
    defined('NOX_DISABLE_THEME_HELPERS_HEAD_OPTIONS')  or define('NOX_DISABLE_THEME_HELPERS_HEAD_OPTIONS',  false);
    defined('NOX_DISABLE_THEME_HELPERS_MAIL')          or define('NOX_DISABLE_THEME_HELPERS_MAIL',          false);
    defined('NOX_DISABLE_THEME_HELPERS_REWRITE')       or define('NOX_DISABLE_THEME_HELPERS_REWRITE',       false);
    defined('NOX_DISABLE_THEME_HELPERS_UPLOADS')       or define('NOX_DISABLE_THEME_HELPERS_UPLOADS',       false);
    defined('NOX_DISABLE_THEME_HELPERS_FUNCTIONS')     or define('NOX_DISABLE_THEME_HELPERS_FUNCTIONS',     []);
    defined('NOX_DISABLE_THEME_HELPERS_POST_TYPES')    or define('NOX_DISABLE_THEME_HELPERS_POST_TYPES',    []);
    defined('NOX_DISABLE_THEME_HELPERS_LOGIN_PAGES')   or define('NOX_DISABLE_THEME_HELPERS_LOGIN_PAGES',   []);

    if (!NOX_DISABLE_THEME_HELPERS) {
        require_once(__DIR__.'/helpers.php');

        if (!NOX_DISABLE_THEME_HELPERS_GMAPS) {
            require_once(__DIR__.'/wp.acf.gmaps.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_ACF) {
            require_once(__DIR__.'/wp.acf.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_ADMIN) {
            require_once(__DIR__.'/wp.admin.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_AT_A_GLANCE) {
            require_once(__DIR__.'/wp.at-a-glance.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_CACHE) {
            require_once(__DIR__.'/wp.cache.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_CRON) {
            require_once(__DIR__.'/wp.cron.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_GENERIC) {
            require_once(__DIR__.'/wp.generic.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_HEAD_OPTIONS) {
            require_once(__DIR__.'/wp.head.options.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_MAIL) {
            require_once(__DIR__.'/wp.mail.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_REWRITE) {
            require_once(__DIR__.'/wp.rewrite.php');
        }

        if (!NOX_DISABLE_THEME_HELPERS_UPLOADS) {
            require_once(__DIR__.'/wp.uploads.php');
        }
    }
