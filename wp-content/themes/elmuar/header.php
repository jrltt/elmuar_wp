<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elisa_Murcia_Artengo
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Heebo:300,400" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'elmuar' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="header--menu">
    		<p id="showLeftPush" class="header--menu__symbol">
    			<a href="#" class="menu-button" id="menuButton">
    				<span class="burger-icon"></span>
					</a>
				</p>
			</div>
			<div class="header--title">
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a class="site--header__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div>
			<div class="header--leng">
				<ul class="header--leng__list">
					<li>ESP</li>
					<li>FRA</li>
				</ul>
			</div>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
		<nav id="cbp-spmenu-s1" class="main-navigation--custom" role="navigation">
			<?php custom_navigation_menu(); ?>
		</nav><!-- #site-navigation -->
	<div id="layer" class="site-layer"></div>
	<div id="content" class="site-content">
