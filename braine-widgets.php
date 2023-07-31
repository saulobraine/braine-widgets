<?php

/**
 * Plugin Name:       Widgets Premium • Braine
 * Description:       Adiciona widgets premium para Elementor
 * Version:           1.0
 * Requires at least: 5.2
 * Author:            Saulo Braine
 * Author URI:        https://braine.dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/* ACTIVATION */
register_activation_hook(__FILE__, function () {
    /* UPDATE PERMALINKS */
    flush_rewrite_rules();
});

/* DEACTIVATION */
register_deactivation_hook(__FILE__, function () {
    /* UPDATE PERMALINKS */
    flush_rewrite_rules();
});

define('MY_ACF_PATH', plugin_dir_path(__FILE__) . 'assets/acf/');
define('MY_ACF_URL', plugin_dir_url(__FILE__) . 'assets/acf/');

include_once MY_ACF_PATH . 'acf.php';
include_once __DIR__ . '/widgets/accordion/acf-config.php';

add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url($url) {
    return MY_ACF_URL;
}

// add_filter('acf/settings/show_admin', '__return_false');
// add_filter('acf/settings/show_updates', '__return_false', 100);

// Including widget file
require_once __DIR__ . '/widgets/widgets.php';