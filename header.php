<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PBBiz
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://kit.fontawesome.com/ec23c08cf8.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'PBBiz' ); ?></a>

	<header id="masthead" class="site-header">

		<div id="top-header">
			<div class="container">
				<?php if ( is_active_sidebar ( 'top-header-widget-1' ) ) : ?>
					<!-- #header-widget-1 -->
					<div id="header-widget-1" class="header-widget widget-area" role="complementary">
						<?php dynamic_sidebar ( 'top-header-widget-1' ); ?>
					</div>
				<?php endif; ?>
				<nav class="navbar navbar-secondary" role="navigation">
					<div class="nav-wrapper">
						<?php
							wp_nav_menu( array(
								'theme_location'    => 'secondary',
								'container_class'   => 'collapse navbar-collapse',
								'container_id'      => 'top-navbar-nav',
								'menu_class'        => 'nav navbar-nav',
								'menu_id'         	=> 'top-menu',
								'depth'             => 2,
								'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								'walker'            => new wp_bootstrap_navwalker())
							);
						?>
					</div><!-- .nav-wrapper -->
				</nav><!-- .navbar -->
			</div><!-- .container -->
		</div><!-- #top-header -->

		<div id="main-header">
			<div class="container">
				<!-- #mobile-header-widget-1 -->
				<?php if ( is_active_sidebar ( 'mobile-header-widget-1' ) ) : ?>
					<!-- #header-widget-1 -->
					<div id="mobile-header-widget-1" class="mobile-header-widget widget-area" role="complementary">
						<?php dynamic_sidebar ( 'mobile-header-widget-1' ); ?>
					</div>
				<?php endif; ?>

				<!-- .site-branding -->
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
					$pbbiz_description = get_bloginfo( 'description', 'display' );
					if ( $pbbiz_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $pbbiz_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<!-- #site-navigation -->
				<nav class="navbar navbar-default navbar-primary" role="navigation">
					<div class="nav-wrapper">
						<!-- Brand and toggle get grouped for better mobile display -->
						<button type="button" class="navbar-toggle hamburger hamburger--spring" data-toggle="collapse" data-target="#navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="hamburger-box">
						<span class="hamburger-inner"></span>
						</span>
						</button>
							<?php
							// -- Add search form -- //
							get_search_form();
							wp_nav_menu( array(
								'theme_location'    => 'primary',
								'container_class'   => 'collapse navbar-collapse',
								'container_id'      => 'navbar-collapse-1',
								'menu_class'        => 'nav navbar-nav',
								'menu_id'			=> 'main-menu',
								'depth'             => 2,
								'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								'walker'            => new wp_bootstrap_navwalker())
							);
							?>
							<!-- Add toggle search icon -->
							<button class="btn btn-primary btn-search-toggle" type="button" data-toggle="collapse" data-target="#searchform" aria-expanded="false" aria-controls="saerchform">
								<i class="fas fa-search"></i>
							</button>
							<div class="menu-overlay"></div>
						<!-- </div>navbar-colapse -->
					</div><!-- .nav-wrapper -->
				</nav><!-- .navbar -->
			</div><!-- .container -->
		</div><!-- #main-header -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
