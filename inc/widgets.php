<?php
/**
 * Declaring widgets
 *
 * @package PBBiz
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
add_filter('dynamic_sidebar_params', 'pbbiz_widget_classes');

if (!function_exists('pbbiz_widget_classes')) {
	/**
	 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
	 * so widgets can be displayed one, two, three or four per row.
	 *
	 * @global array $sidebars_widgets
	 *
	 * @param array $params {
	 *     @type array $args  {
	 *         An array of widget display arguments.
	 *
	 *         @type string $name          Name of the sidebar the widget is assigned to.
	 *         @type string $id            ID of the sidebar the widget is assigned to.
	 *         @type string $description   The sidebar description.
	 *         @type string $class         CSS class applied to the sidebar container.
	 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
	 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
	 *         @type string $after_title   HTML markup to append to the widget title when displayed.
	 *         @type string $widget_id     ID of the widget.
	 *         @type string $widget_name   Name of the widget.
	 *     }
	 *     @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 *         @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 * @return array $params
	 */
	function pbbiz_widget_classes($params)
	{

		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters('sidebars_widgets', $sidebars_widgets);

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if (isset($params[0]['id']) && strpos($params[0]['before_widget'], 'dynamic-classes')) {
			$sidebar_id   = $params[0]['id'];
			$widget_count = count($sidebars_widgets_count[$sidebar_id]);

			$widget_classes = 'widget-count-' . $widget_count;
			if (0 === $widget_count % 4 || $widget_count > 6) {
				// Four widgets per row if there are exactly four or more than six.
				$widget_classes .= ' col-md-3';
			} elseif (6 === $widget_count) {
				// If two widgets are published.
				$widget_classes .= ' col-md-2';
			} elseif ($widget_count >= 3) {
				// Three widgets per row if there's three or more widgets.
				$widget_classes .= ' col-md-4';
			} elseif (2 === $widget_count) {
				// If two widgets are published.
				$widget_classes .= ' col-md-6';
			} elseif (1 === $widget_count) {
				// If just on widget is active.
				$widget_classes .= ' col-md-12';
			}

			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace('dynamic-classes', $widget_classes, $params[0]['before_widget']);
		}

		return $params;
	}
} // endif function_exists( 'pbbiz_widget_classes' ).

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action('widgets_init', 'pbbiz_widgets_init');

if (!function_exists('pbbiz_widgets_init')) {

	function pbbiz_widgets_init() {
		// Global sidebar area
		register_sidebar(array(
			'name'          => esc_html__('Sidebar', 'PBBiz'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'PBBiz'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Top header left tagline area
		register_sidebar(array(
			'name'          => 'Top Header Left Widget', 'PBBiz',
			'id'            => 'top-header-widget-1',
			'description'   => 'Add widgets here.', 'PBBiz',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Mobile header left icon menu
		register_sidebar(array(
			'name'          => 'Mobile Header Widget', 'PBBiz',
			'id'            => 'mobile-header-widget-1',
			'description'   => 'Add widgets here.', 'PBBiz',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Top footer widget area
		register_sidebar(array(
			'name'          => 'Top Footer Widget',
			'id'            => 'top-footer-widget-1',
			'description'   => 'Appears in the top footer area',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Footer sidebar area 1/4
		register_sidebar(array(
			'name'          => 'Footer Sidebar 1',
			'id'            => 'footer-sidebar-1',
			'description'   => 'Appears in the footer area',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Footer sidebar area 2/4	
		register_sidebar(array(
			'name'          => 'Footer Sidebar 2',
			'id'            => 'footer-sidebar-2',
			'description'   => 'Appears in the footer area',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Footer sidebar area 3/4
		register_sidebar(array(
			'name'          => 'Footer Sidebar 3',
			'id'            => 'footer-sidebar-3',
			'description'   => 'Appears in the footer area',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Footer sidebar area 4/4
		register_sidebar(array(
			'name'          => 'Footer Sidebar 4',
			'id'            => 'footer-sidebar-4',
			'description'   => 'Appears in the footer area',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		// Colophon widget area
		register_sidebar(array(
			'name'          => 'Colophon Widget',
			'id'            => 'colophon-widget-1',
			'description'   => 'Appears in the colophon area',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
	}
} // endif function_exists( 'pbbiz_widgets_init' ).
