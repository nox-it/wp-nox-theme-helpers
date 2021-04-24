<?php

    add_action(
        'dashboard_glance_items',
        static function ()
        {
            $args = [
                'public'   => true,
                '_builtin' => false
            ];

            $output    = 'object';
            $operator  = 'and';
            $postTypes = [];

            if (is_array(NYX_DISABLE_THEME_HELPERS_POST_TYPES) && !empty(NYX_DISABLE_THEME_HELPERS_POST_TYPES)) {
                $postTypes = NYX_DISABLE_THEME_HELPERS_POST_TYPES;
            }

            foreach (get_post_types($args, $output, $operator) as $postType) {
                $numPosts = wp_count_posts($postType->name);
                $num      = number_format_i18n($numPosts->publish);
                $text     = _n($postType->labels->singular_name, $postType->labels->name, (int)$numPosts->publish);
                $cptName  = '';

                if (current_user_can('edit_posts')) {
                    $cptName = $postType->name;
                }

                if (str_starts_with($cptName, 'frm_')) {
                    continue;
                }

                $menuIcon = 'f155';
                $noneText = 'Nenhum';

                if (!empty($cptName) && array_key_exists($cptName, $postTypes) && isset($postTypes[$cptName]['icon'], $postTypes[$cptName]['male'])) {
                    $menuIcon = $postTypes[$cptName]['icon'];

                    if (!$postTypes[$cptName]['male']) {
                        $noneText = 'Nenhuma';
                    }
                }

                $cptLabel = (((int)$num === 0) ? "{$noneText} {$postType->labels->singular_name}" : "{$num}&nbsp;{$text}");

                /** @noinspection CssInvalidHtmlTagReference */
                echo <<<HTML
<li class="page-count {$cptName}-count">
    <a href="edit.php?post_type={$cptName}">{$cptLabel}</a>
    <style type="text/css">.page-count.{$cptName}-count a:before {content:'\\{$menuIcon}' !important;}</style>
</li>
HTML;
            }
        }
    );
