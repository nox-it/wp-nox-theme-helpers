<?php

    /**
     * Plugin Name: Theme Helpers
     * Description: Common helpers for themes
     * Plugin URI:  https://github.com/nyx-it/wp-nyx-theme-helpers
     * Author:      NYX IT
     * Author URI:  https://github.com/nyx-it
     * License:     GNU General Public License v2 or later
     * License URI: http://www.gnu.org/licenses/gpl-2.0.html
     * Version:     1.0.2
     */

    defined('ABSPATH') or die();

    defined('ENV_IS_DEVELOPMENT')                      or define('ENV_IS_DEVELOPMENT',                      false);
    defined('ENV_IS_STAGING')                          or define('ENV_IS_STAGING',                          false);
    defined('ENV_IS_PRODUCTION')                       or define('ENV_IS_PRODUCTION',                       false);
    defined('NYX_DISABLE_THEME_HELPERS')               or define('NYX_DISABLE_THEME_HELPERS',               false);
    defined('NYX_DISABLE_THEME_HELPERS_GMAPS')         or define('NYX_DISABLE_THEME_HELPERS_GMAPS',         false);
    defined('NYX_DISABLE_THEME_HELPERS_ACF')           or define('NYX_DISABLE_THEME_HELPERS_ACF',           false);
    defined('NYX_DISABLE_THEME_HELPERS_ADMIN')         or define('NYX_DISABLE_THEME_HELPERS_ADMIN',         false);
    defined('NYX_DISABLE_THEME_HELPERS_AT_A_GLANCE')   or define('NYX_DISABLE_THEME_HELPERS_AT_A_GLANCE',   false);
    defined('NYX_DISABLE_THEME_HELPERS_CACHE')         or define('NYX_DISABLE_THEME_HELPERS_CACHE',         false);
    defined('NYX_DISABLE_THEME_HELPERS_CRON')          or define('NYX_DISABLE_THEME_HELPERS_CRON',          false);
    defined('NYX_DISABLE_THEME_HELPERS_GENERIC')       or define('NYX_DISABLE_THEME_HELPERS_GENERIC',       false);
    defined('NYX_DISABLE_THEME_HELPERS_HEAD_OPTIONS')  or define('NYX_DISABLE_THEME_HELPERS_HEAD_OPTIONS',  false);
    defined('NYX_DISABLE_THEME_HELPERS_MAIL')          or define('NYX_DISABLE_THEME_HELPERS_MAIL',          false);
    defined('NYX_DISABLE_THEME_HELPERS_REWRITE')       or define('NYX_DISABLE_THEME_HELPERS_REWRITE',       false);
    defined('NYX_DISABLE_THEME_HELPERS_UPLOADS')       or define('NYX_DISABLE_THEME_HELPERS_UPLOADS',       false);
    defined('NYX_DISABLE_THEME_HELPERS_FUNCTIONS')     or define('NYX_DISABLE_THEME_HELPERS_FUNCTIONS',     []);
    defined('NYX_DISABLE_THEME_HELPERS_POST_TYPES')    or define('NYX_DISABLE_THEME_HELPERS_POST_TYPES',    []);
    defined('NYX_DISABLE_THEME_HELPERS_LOGIN_PAGES')   or define('NYX_DISABLE_THEME_HELPERS_LOGIN_PAGES',   []);
    defined('NYX_DISABLE_THEME_HELPERS_REST_ADM_MENU') or define('NYX_DISABLE_THEME_HELPERS_REST_ADM_MENU', ['menu-posts', 'menu-links', 'menu-comments']);
    defined('NYX_THEME_ASSETS_RELATIVE_PATH')          or define('NYX_THEME_ASSETS_RELATIVE_PATH',          '/assets/dist');

    if (!NYX_DISABLE_THEME_HELPERS) {
        require_once(__DIR__.'/helpers.php');

        if (!NYX_DISABLE_THEME_HELPERS_GMAPS) {
            require_once(__DIR__.'/wp.acf.gmaps.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_ACF) {
            require_once(__DIR__.'/wp.acf.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_ADMIN) {
            require_once(__DIR__.'/wp.admin.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_AT_A_GLANCE) {
            require_once(__DIR__.'/wp.at-a-glance.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_CACHE) {
            require_once(__DIR__.'/wp.cache.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_CRON) {
            require_once(__DIR__.'/wp.cron.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_GENERIC) {
            require_once(__DIR__.'/wp.generic.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_HEAD_OPTIONS) {
            require_once(__DIR__.'/wp.head.options.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_MAIL) {
            require_once(__DIR__.'/wp.mail.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_REWRITE) {
            require_once(__DIR__.'/wp.rewrite.php');
        }

        if (!NYX_DISABLE_THEME_HELPERS_UPLOADS) {
            require_once(__DIR__.'/wp.uploads.php');
        }
    }
