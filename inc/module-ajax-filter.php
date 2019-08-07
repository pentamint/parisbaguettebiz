<?php

/**
 * Load AJAX filter module
 *
 * @package PBBiz
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('after_setup_theme', 'pbbiz_ajax_filter_setup');

if (!function_exists('pbbiz_ajax_filter_setup')) :

    function pbbiz_ajax_filter_setup()
    {

    }
endif;
