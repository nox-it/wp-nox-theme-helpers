<?php

    if (!function_exists('add_wp_cron_job')) {
        /**
         * @param string   $name
         * @param string   $recurrence
         * @param callable $hook
         */
        function add_wp_cron_job(string $name, string $recurrence, callable $hook): void
        {
            add_action($name, $hook);

            add_action(
                'wp',
                static function () use ($name, $recurrence) {
                    if (!wp_next_scheduled($name)) {
                        wp_schedule_event(current_time('timestamp'), $recurrence, $name);
                    }
                }
            );
        }
    }

    if (!function_exists('load_cron_jobs')) {
        /**
         * @return void
         */
        function load_cron_jobs(): void
        {
            $templateDir = get_template_directory();
            $cronDir     = "{$templateDir}/cron";

            if (is_dir($cronDir)) {
                $cronFiles = scandir($cronDir, SCANDIR_SORT_NONE);

                if (is_array($cronFiles)) {
                    foreach ($cronFiles as $file) {
                        if (preg_match('/^(.*)\.php$/', $file)) {
                            /** @noinspection PhpIncludeInspection */
                            require_once("{$cronDir}/{$file}");
                        }
                    }
                }
            }
        }

        load_cron_jobs();
    }

    add_filter(
        'cron_schedules',
        static function ( $schedules ) {
            $schedules['nox_every_minute'] = [
                'interval' => 60,
                'display'  => 'Every Minute'
            ];
            $schedules['nox_every_five_minutes'] = [
                'interval' => (60 * 5),
                'display'  => 'Every Five Minutes'
            ];

            return $schedules;
        }
    );
