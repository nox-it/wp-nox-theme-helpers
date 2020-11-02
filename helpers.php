<?php

    /**
     * @noinspection PhpUnused
     * @noinspection HtmlRequiredAltAttribute
     */

    #region Verifications
    /**
     * @param string $name
     *
     * @return bool
     */
    function nox_theme_helpers_fn_enabled(string $name): bool
    {
        $disabled = NOX_DISABLE_THEME_HELPERS_FUNCTIONS;

        if (!is_array($disabled)) {
            $disabled = [];
        }

        return (!in_array($name, $disabled, true) && !function_exists($name));
    }
    #endregion

    #region URLs
    if (nox_theme_helpers_fn_enabled('validate_url')) {
        /**
         * @param string $url
         *
         * @return bool
         *
         * @todo Verificar a melhor forma de validar URL
         */
        function validate_url(string $url): bool
        {
            /** @noinspection BypassedUrlValidationInspection */
            return filter_var($url, FILTER_VALIDATE_URL);
        }
    }

    if (nox_theme_helpers_fn_enabled('get_template_url')) {
        /**
         * @param string $path
         * @param string $prefix
         *
         * @return string
         *
         * @throws Exception
         */
        function get_template_url(string $path, string $prefix = ''): string
        {
            $template_url = get_template_directory_uri();

            if (!empty($prefix) && $prefix[0] !== '/') {
                $prefix = "/{$prefix}";
            }

            if (!empty($path) && $path[0] !== '/') {
                $path = "/{$path}";
            }

            $cache = ((ENV_IS_DEVELOPMENT) ? ((!str_contains($path, '?')) ? '?' : '&').'_cv='.random_int(100000, 999999) : '');

            return "{$template_url}{$prefix}{$path}{$cache}";
        }
    }

    if (nox_theme_helpers_fn_enabled('get_assets_url')) {
        /**
         * @param string $path
         * @param string $prefix
         *
         * @return string
         *
         * @throws Exception
         */
        function get_assets_url(string $path, string $prefix = ''): string
        {
            return get_template_url("{$prefix}/{$path}", '/assets/dist');
        }

        if (nox_theme_helpers_fn_enabled('get_images_url')) {
            /**
             * @param string $path
             *
             * @return string
             *
             * @throws Exception
             */
            function get_images_url(string $path): string
            {
                return get_assets_url($path, '/images');
            }
        }

        if (nox_theme_helpers_fn_enabled('get_fonts_url')) {
            /**
             * @param string $path
             *
             * @return string
             *
             * @throws Exception
             */
            function get_fonts_url(string $path): string
            {
                return get_assets_url($path, '/fonts');
            }
        }

        if (nox_theme_helpers_fn_enabled('get_scripts_url')) {
            /**
             * @param string $path
             *
             * @return string
             *
             * @throws Exception
             */
            function get_scripts_url(string $path): string
            {
                return get_assets_url($path, '/scripts');
            }
        }

        if (nox_theme_helpers_fn_enabled('get_styles_url')) {
            /**
             * @param string $path
             *
             * @return string
             *
             * @throws Exception
             */
            function get_styles_url(string $path): string
            {
                return get_assets_url($path, '/styles');
            }
        }

        if (nox_theme_helpers_fn_enabled('get_svg_url')) {
            /**
             * @param string $path
             *
             * @return string
             *
             * @throws Exception
             */
            function get_svg_url(string $path): string
            {
                return get_assets_url($path, '/svg');
            }
        }
    }
    #endregion

    #region Login Verification
    if (nox_theme_helpers_fn_enabled('is_login')) {
        /**
         * @return bool
         */
        function is_login()
        {
            global $pagenow;

            if (empty($pagenow) || $pagenow === 'index.php') {
                $pagenow = preg_replace('/(.*?\/|\?.*$)/', '', $_SERVER['REQUEST_URI']);
            }

            $loginPages       = ['wp-login.php', 'wp-register.php', 'administration', 'administracao', 'administracao-interna'];
            $customLoginPages = [];

            if (is_array(NOX_DISABLE_THEME_HELPERS_LOGIN_PAGES) && !empty(NOX_DISABLE_THEME_HELPERS_LOGIN_PAGES)) {
                $customLoginPages = NOX_DISABLE_THEME_HELPERS_LOGIN_PAGES;
            }

            return in_array(
                $pagenow,
                array_merge($loginPages, $customLoginPages),
                true
            );
        }
    }
    #endregion

    #region SEO & Content
    if (nox_theme_helpers_fn_enabled('get_as_content')) {
        /**
         * @param        $content
         * @param string $p_class
         *
         * @return mixed
         */
        function get_as_content($content, $p_class = '')
        {
            $content = preg_replace('/<ul.*>/i', '<ul>', $content);
            $content = preg_replace('/<ol.*>/i', '<ol>', $content);
            $content = preg_replace('/<h1/i', '<h4', $content);
            $content = preg_replace('/h1>/i', 'h4>', $content);
            $content = preg_replace('/<h2/i', '<h4', $content);
            $content = preg_replace('/h2>/i', 'h4>', $content);
            $content = preg_replace('/<h3/i', '<h4', $content);
            $content = preg_replace('/h3>/i', 'h4>', $content);
            $content = preg_replace('/<div/i', '<p', $content);
            $content = preg_replace('/div>/i', 'p>', $content);
            $content = apply_filters('the_content', $content);

            /** @noinspection RequiredAttributes */
            $content = strip_tags($content, '<strong><b><em><i><ul><ol><li><a><h4><h5><h6><p><img><blockquote><br><br/><br />');
            $content = preg_replace('/<(p|h4|h5|h6) ?([^>]+)?>/', '<$1>', $content);
            $content = preg_replace('/<p><\/p>/', '', $content);
            $content = preg_replace('/<p>&nbsp;<\/p>/', '', $content);
            $content = preg_replace('/<p>(.*)<\/p>/', '<p class="'.$p_class.'">$1</p>', $content);
            $content = preg_replace('/\[fl](.*)\[\/fl]/', '<span class="first-letter">$1</span>', $content);

            return $content;
        }
    }

    if (nox_theme_helpers_fn_enabled('get_as_description')) {
        /**
         * @param $content
         *
         * @return mixed|string
         */
        function get_as_description($content)
        {
            $content = strip_tags($content);
            $content = preg_replace('/(\n|\r\n|\n\r)/', '', $content);

            return $content;
        }
    }

    if (nox_theme_helpers_fn_enabled('get_parsed_keywords')) {
        /**
         * @param $keywords
         *
         * @return array|string
         */
        function get_parsed_keywords($keywords)
        {
            $tmpKeywords = [];

            if (is_array($keywords) && !empty($keywords)) {
                foreach ($keywords as $item) {
                    if (!empty($item['word'])) {
                        $tmpKeywords[] = esc_attr($item['word']);
                    }
                }

                if (count($tmpKeywords) > 0) {
                    return $tmpKeywords;
                }
            }

            return '';
        }
    }

    #region Excerpts
    if (nox_theme_helpers_fn_enabled('get_page_excerpt')) {
        /**
         * @param string $content
         *
         * @return mixed|string
         */
        function get_page_excerpt($content = '')
        {
            if (empty($content)) {
                return $content;
            }

            $result  = '';
            $matches = [];

            preg_match_all('#<\s*p[^>]*>(.*?)<\s*/\s*p>#ui', $content, $matches);

            if (!empty($matches)) {
                $result = $matches[0][0];

                if (isset($matches[0][1])) {
                    $result .= $matches[0][1];
                }

                add_filter('excerpt_length', 'get_page_excerpt_length');

                $result = get_page_trim_excerpt($result);
            }

            return $result;
        }
    }

    if (nox_theme_helpers_fn_enabled('get_page_excerpt_length')) {
        /**
         * @return int
         */
        function get_page_excerpt_length()
        {
            return 295;
        }
    }

    if (nox_theme_helpers_fn_enabled('get_page_trim_excerpt')) {
        /**
         * @param string $text
         *
         * @return mixed|string
         */
        function get_page_trim_excerpt($text = '')
        {
            $text = strip_shortcodes($text);

            $text           = apply_filters('the_content', $text);
            $text           = str_replace(']]>', ']]&gt;', $text);
            $excerpt_length = apply_filters('excerpt_length', 55);
            $excerpt_more   = apply_filters('excerpt_more', ' '.'[...]');
            $text           = wp_trim_words($text, $excerpt_length, $excerpt_more);

            return $text;
        }
    }

    if (nox_theme_helpers_fn_enabled('add_ellipsis')) {
        /**
         * @param string $str
         * @param int    $max
         * @param string $ellipsis
         *
         * @return string
         */
        function add_ellipsis(string $str, int $max, $ellipsis = '...')
        {
            $new = '';

            if (strlen($str) > $max) {
                foreach (explode(' ', $str) as $item) {
                    $aux_new_str = $new.' '.$item;

                    if (strlen($aux_new_str) <= $max) {
                        $new = $aux_new_str;
                    } else {
                        break;
                    }
                }

                $new = trim($new).$ellipsis;
            } else {
                $new = $str;
            }

            return $new;
        }
    }
    #endregion
    #endregion

    #region Template
    if (nox_theme_helpers_fn_enabled('get_current_page_template_slug')) {
        /**
         * @param int $id
         *
         * @return bool|mixed|string
         */
        function get_current_page_template_slug($id = 0)
        {
            $id = (int)$id;

            if ($id === 0) {
                global $post;

                if (isset($post->ID)) {
                    $id = (int)$post->ID;
                } else {
                    $id = 0;
                }

                if (empty($id)) {
                    return '';
                }
            }

            $templateName = get_page_template_slug($id);
            $templateName = preg_replace('/\.php.*?$/', '', $templateName);

            /** @noinspection RegExpSingleCharAlternation */
            $templateName = preg_replace('/(\/|\\\)/', '::', $templateName);

            return $templateName;
        }
    }

    if (nox_theme_helpers_fn_enabled('is_on_template')) {
        /**
         * @param string $slug
         * @param int    $id
         *
         * @return bool
         */
        function is_on_template(string $slug, $id = 0)
        {
            $templateName = get_current_page_template_slug($id);

            return $slug === (string)$templateName;
        }
    }

    if (nox_theme_helpers_fn_enabled('do_template_partial')) {
        /**
         * @param string $name
         * @param array  $vars
         */
        function do_template_partial(string $name, array $vars = [])
        {
            $defaultVars = do_template_partial_default_vars();

            if (!is_array($defaultVars)) {
                $defaultVars = [];
            }

            extract($defaultVars, EXTR_OVERWRITE);
            extract($vars, EXTR_OVERWRITE);

            $templateDir = get_template_directory();

            $file = "{$templateDir}/components/{$name}.php";

            if (is_file($file)) {
                /** @noinspection PhpIncludeInspection */
                include($file);
            }
        }

        if (nox_theme_helpers_fn_enabled('do_template_partial_default_vars')) {
            /**
             * @return array
             */
            function do_template_partial_default_vars(): array
            {
                return [];
            }
        }
    }
    #endregion

    #region Formatters
    if (nox_theme_helpers_fn_enabled('just_numbers')) {
        /**
         * @param string $string
         *
         * @return string
         */
        function just_numbers(string $string)
        {
            return (string)preg_replace('/([\D]+)/', '', $string);
        }
    }

    if (nox_theme_helpers_fn_enabled('html_implode')) {
        /**
         * @param array $pieces
         *
         * @return string
         */
        function html_implode(array $pieces)
        {
            return implode("\n", $pieces);
        }
    }

    if (nox_theme_helpers_fn_enabled('html_array_map')) {
        /**
         * @param callable $callback
         * @param array    $pieces
         *
         * @return string
         */
        function html_array_map(callable $callback, array $pieces)
        {
            return html_implode(array_map($callback, $pieces));
        }
    }

    if (nox_theme_helpers_fn_enabled('get_formated_date')) {
        /**
         * @param string $date
         * @param string $format
         *
         * @return string
         *
         * @throws Exception
         */
        function get_formated_date(string $date, string $format = 'Y-m-d H:i:s')
        {
            if (preg_match('/^([\d]{4})-([\d]{2})-([\d]{2}) ([\d]{2}):([\d]{2}):([\d]{2})$/', $date)) {
                $formatedDate = new DateTime($date);

                if ($formatedDate) {
                    return $formatedDate->format($format);
                }

                return $date;
            }

            if (preg_match('/^([\d]{4})-([\d]{2})-([\d]{2})$/', $date)) {
                $formatedDate = new DateTime($date.' 00:00:00');

                if ($formatedDate) {
                    return $formatedDate->format($format);
                }

                return $date;
            }

            return $date;
        }
    }

    #region ACF
    if (nox_theme_helpers_fn_enabled('get_attr_field')) {
        /**
         * @param bool $selector
         * @param bool $post_id
         * @param bool $format_value
         *
         * @return mixed
         */
        function get_attr_field($selector = false, $post_id = false, $format_value = false)
        {
            if (function_exists('get_field')) {
                return esc_attr(get_field($selector, $post_id, $format_value));
            }

            return '';
        }
    }

    if (nox_theme_helpers_fn_enabled('get_url_field')) {
        /**
         * @param string   $selector
         * @param bool|int $postId
         * @param bool     $formatValue
         *
         * @return string
         */
        function get_url_field(string $selector, $postId = false, bool $formatValue = false)
        {
            if (function_exists('get_field')) {
                $url = esc_url(get_field($selector, $postId, $formatValue));

                if (validate_url($url)) {
                    return $url;
                }
            }

            return '';
        }
    }

    if (nox_theme_helpers_fn_enabled('get_content_field')) {
        /**
         * @param        $selector
         * @param bool   $post_id
         * @param bool   $format_value
         * @param string $p_class
         *
         * @return mixed
         */
        function get_content_field($selector, $post_id = false, $format_value = false, $p_class = '')
        {
            if (function_exists('get_field')) {
                return get_as_content(get_field($selector, $post_id, $format_value), $p_class);
            }

            return '';
        }
    }
    #endregion

    #region Phones
    if (nox_theme_helpers_fn_enabled('get_phone_as_url')) {
        /**
         * @param string $phone
         *
         * @return string
         */
        function get_phone_as_url(string $phone)
        {
            $phone = get_phone_formated($phone);
            $phone = preg_replace('/([\D]+)/', '', $phone);

            return "tel:+55{$phone}";
        }
    }

    if (nox_theme_helpers_fn_enabled('get_phone_formated')) {
        /**
         * @param string $phone
         *
         * @return string
         */
        function get_phone_formated(string $phone)
        {
            $phone = str_replace('+55', '', $phone);
            $phone = preg_replace('/([\D]+)/', '', $phone);
            $phone = preg_replace('/^([\d]{2})([\d]{4,5})([\d]{4})$/', '$1 $2.$3', $phone);

            return $phone;
        }
    }

    if (nox_theme_helpers_fn_enabled('get_whatsapp_url')) {
        /**
         * @param string $phone
         *
         * @return string
         */
        function get_whatsapp_url(string $phone)
        {
            $phone = get_phone_formated($phone);
            $phone = preg_replace('/([\D]+)/', '', $phone);

            return "https://api.whatsapp.com/send?phone=55{$phone}";
        }
    }
    #endregion
    #endregion

    #region Images
    if (nox_theme_helpers_fn_enabled('get_image_field')) {
        /**
         * @param string $selector
         * @param bool   $post_id
         * @param string $size
         *
         * @return string
         */
        function get_image_field(string $selector, $post_id = false, $size = 'thumbnail')
        {
            if (function_exists('get_field')) {
                $imageId = (int)get_field($selector, $post_id, false);

                if ($imageId > 0) {
                    $image = wp_get_attachment_image_src($imageId, $size, false);

                    if (is_array($image) && isset($image[0]) && validate_url($image[0])) {
                        return $image[0];
                    }
                }
            }

            return '';
        }
    }
    #endregion

    #region Google Maps
    if (nox_theme_helpers_fn_enabled('get_gmaps_embed_url')) {
        /**
         * @param string $lat
         * @param string $lng
         * @param string $address
         *
         * @return string
         */
        function get_gmaps_embed_url(string $lat, string $lng, string $address)
        {
            $params = [
                'hl'     => 'pt-BR',
                'coord'  => "{$lat},{$lng}",
                'q'      => $address,
                'ie'     => 'UTF8',
                't'      => '',
                'z'      => '16',
                'output' => 'embed',
            ];

            /** @noinspection ImplodeMissUseInspection */
            $params = implode(
                '&',
                array_map(
                    fn($param, $key) => "{$key}=".urlencode($param),
                    $params,
                    array_keys($params)
                )
            );

            return "https://maps.google.com/maps?{$params}";
        }
    }
    #endregion

    #region Taxonomies
    if (nox_theme_helpers_fn_enabled('find_post_category_name')) {
        /**
         * @param int $postId
         *
         * @return string
         */
        function find_post_category_name(int $postId)
        {
            $category = wp_get_post_categories($postId);

            if (is_array($category) && !empty($category)) {
                $category = reset($category);

                if ($category instanceof WP_Term) {
                    $category = $category->name;
                } else {
                    $category = get_term($category);

                    if ($category instanceof WP_Term) {
                        $category = $category->name;
                    }
                }
            } else {
                $category = '';
            }

            return $category;
        }
    }
    #endregion

    #region Videos
    if (nox_theme_helpers_fn_enabled('get_vimeo_or_youtube_id_from_url')) {
        /**
         * @param string $url
         * @param bool   $checkOnly
         * @param string $type
         *
         * @return bool|string
         */
        function get_vimeo_or_youtube_id_from_url(string $url, bool $checkOnly = false, $type = 'youtube')
        {
            if (validate_url($url)) {
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches)) {
                    return (($checkOnly) ? ($type === 'youtube') : $matches[1]);
                }

                if (preg_match('/^(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([\d]{6,11})[?]?(.*)?$/', $url, $matches)) {
                    return (($checkOnly) ? ($type === 'vimeo') : $matches[5]);
                }
            }

            return false;
        }
    }
    #endregion

    #region Date/Time
    if (nox_theme_helpers_fn_enabled('time_elapsed_string')) {
        /**
         * @param string $datetime
         * @param bool   $full
         *
         * @return string
         * @throws Exception
         */
        function time_elapsed_string(string $datetime, bool $full = false): string
        {
            $now  = new DateTime();
            $ago  = new DateTime($datetime);
            $diff = $now->diff($ago);

            /** @noinspection PhpUndefinedFieldInspection */
            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = [
                'y' => 'ano',
                'm' => 'mês',
                'w' => 'semana',
                'd' => 'dia',
                'h' => 'hora',
                'i' => 'minuto',
                's' => 'segundo',
            ];

            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k.' '.$v.($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }

            unset($v);

            if (!$full) {
                $string = array_slice($string, 0, 1);
            }

            return $string ? implode(', ', $string).' atrás' : 'agora';
        }
    }
    #endregion

    #region PHP 8
    if (!function_exists('str_contains')) {
        /**
         * @param string $haystack
         * @param string $needle
         *
         * @return bool
         */
        function str_contains(string $haystack, string $needle): bool
        {
            /** @noinspection StrContainsCanBeUsedInspection */
            return '' === $needle || false !== strpos($haystack, $needle);
        }
    }

    if (!function_exists('str_starts_with')) {
        /**
         * @param string $haystack
         * @param string $needle
         *
         * @return bool
         */
        function str_starts_with(string $haystack, string $needle): bool
        {
            return 0 === strncmp($haystack, $needle, strlen($needle));
        }
    }
    #endregion
