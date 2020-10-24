<?php

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Informações',
            'menu_title' => 'Informações',
            'menu_slug'  => 'theme-general-informations',
            'capability' => 'edit_posts',
            'redirect'   => false
        ]);
    }
