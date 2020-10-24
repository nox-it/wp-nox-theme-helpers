<?php

    add_action(
        'wp_dashboard_setup',
        static function () {
            global $wp_meta_boxes;

            $side   = [];
            $normal = [];

            if (isset($wp_meta_boxes['dashboard']['normal']['core'])) {
                foreach ($wp_meta_boxes['dashboard']['normal']['core'] as $key => $item) {
                    if ($key === 'dashboard_right_now') {
                        continue;
                    }

                    $normal[] = $key;
                }
            }

            if (isset($wp_meta_boxes['dashboard']['side']['core'])) {
                foreach ($wp_meta_boxes['dashboard']['side']['core'] as $key => $item) {
                    $side[] = $key;
                }
            }


            foreach ($normal as $current) {
                unset($wp_meta_boxes['dashboard']['normal']['core'][$current]);
            }

            $current = null;

            foreach ($side as $current) {
                unset($wp_meta_boxes['dashboard']['side']['core'][$current]);
            }
        }
    );

    add_action(
        'load-index.php',
        static function () {
            remove_action('welcome_panel', 'wp_welcome_panel');

            $user_id = get_current_user_id();

            if (0 !== get_user_meta($user_id, 'show_welcome_panel', true)) {
                update_user_meta($user_id, 'show_welcome_panel', 0);
            }
        }
    );

    add_action(
        'admin_menu',
        static function () {
            global $menu;

            $restricted = ['menu-posts', 'menu-links', 'menu-comments'];

            foreach ($menu as $key => $value) {
                if (isset($value[5]) && in_array((string)$value[5], $restricted)) {
                    unset($menu[$key]);
                }
            }
        }
    );
