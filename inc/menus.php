<?php

/**
 * Register Menus
 *
 * @package PBBiz
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('after_setup_theme', 'pbbiz_menu_setup');

if (!function_exists('pbbiz_menu_setup')) :

    function pbbiz_menu_setup()
    {
        // Secondary Nav Menu
        register_nav_menus(array(
            'secondary' => esc_html__('Secondary Menu', 'PBBiz'),
        ));

        // Footer Nav Menu
        register_nav_menus(array(
            'top-footer' => esc_html__('Top Footer Menu', 'PBBiz'),
        ));

        // Colophon Nav Menu
        register_nav_menus(array(
            'colophon' => esc_html__('Colophon Menu', 'PBBiz'),
        ));
    }
endif;
