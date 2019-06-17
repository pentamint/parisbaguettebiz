<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pentamint_WP_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<script src="https://kit.fontawesome.com/ec23c08cf8.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pentamint-wp-theme' ); ?></a>

	<header id="masthead" class="site-header">

		<!-- Custom Top Header Area -->
		<div id="top-header">
			<div class="container">
				<?php if ( is_active_sidebar ( 'top-header-widget-1' ) ) : ?>
					<!-- #header-widget-1 -->
					<div id="top-header-widget-1" class="header-widget widget-area" role="complementary">
						<?php dynamic_sidebar ( 'top-header-widget-1' ); ?>
					</div>
				<?php endif; ?>
				<nav class="navbar navbar-secondary" role="navigation">
					<div class="nav-wrapper">
						<div class="collapse navbar-collapse menu-secondary" id="top-navbar-collapse-1">
							<?php
								wp_nav_menu( array(
									'menu'           	=> '',
									'theme_location'    => 'secondary',
									'depth'             => 2,
									'container'         => '',
									'container_class'   => 'collapse navbar-collapse',
									'container_id'      => 'top-navbar-collapse-1',
									'menu_class'        => 'nav navbar-nav',
									'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									'walker'            => new wp_bootstrap_navwalker())
								);
							?>
						</div><!-- .navbar-colapse -->
					</div><!-- .nav-wrapper -->
				</nav><!-- .navbar -->
			</div><!-- .container -->
		</div><!-- #top-header -->
		<!-- Custom Top Header Area End -->

		<div id="main-header">
			<div class="container">

				<!-- Custom Mobile Header Widget -->
				<?php if ( is_active_sidebar ( 'mobile-header-widget-1' ) ) : ?>
					<!-- #header-widget-1 -->
					<div id="mobile-header-widget-1" class="mobile-header-widget widget-area" role="complementary">
						<?php dynamic_sidebar ( 'mobile-header-widget-1' ); ?>
					</div>
				<?php endif; ?>
				<!-- Custom Mobile Header Widget End -->

				<div class="site-branding">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$pentamint_wp_theme_description = get_bloginfo( 'description', 'display' );
					if ( $pentamint_wp_theme_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $pentamint_wp_theme_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<!-- Custom Bootstrap Navigation -->
				<nav class="navbar navbar-default navbar-primary" role="navigation">
					<div class="nav-wrapper">
						<!-- Brand and toggle get grouped for better mobile display -->
						<button type="button" class="navbar-toggle hamburger hamburger--spring" data-toggle="collapse" data-target="#navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="hamburger-box">
						<span class="hamburger-inner"></span>
						</span>
						</button>
						<div class="collapse navbar-collapse menu-primary" id="navbar-collapse-1">
							<?php
							// -- Add search form -- //
							get_search_form();
							wp_nav_menu( array(
								'menu'           	=> '',
								'theme_location'    => 'primary',
								'depth'             => 3,
								'container'         => '',
								'container_class'   => 'collapse navbar-collapse',
								'container_id'      => 'navbar-collapse-1',
								'menu_class'        => 'nav navbar-nav',
								'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								'walker'            => new wp_bootstrap_navwalker())
							);
							?>
							<!-- Add toggle search icon -->
							<button class="btn btn-primary btn-search-toggle" type="button" data-toggle="collapse" data-target="#searchform" aria-expanded="false" aria-controls="saerchform">
								<i class="fas fa-search"></i>
							</button>
							<div class="menu-overlay"></div>
						</div><!-- navbar-colapse -->
					</div><!-- .nav-wrapper -->
				</nav><!-- .navbar -->
				<!-- Custom Bootstrap Navigation End -->
				
			</div><!-- .container -->
		</div><!-- #main-header -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
