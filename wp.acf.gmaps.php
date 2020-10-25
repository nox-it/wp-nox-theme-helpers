<?php

    add_action(
        'acf/init',
        static function () {
            if (function_exists('get_field') && function_exists('acf_update_setting')) {
                $gmapsKey = get_field('wp_acf_gmaps_key', 'option');

                if (!empty($gmapsKey)) {
                    acf_update_setting('google_api_key', $gmapsKey);
                }
            }
        }
    );
