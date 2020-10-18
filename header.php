<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package "theme"
 */


$url_logo 			= get_field("theme_settings_general__logo", "option");
$logo 				= ($url_logo) ? $url_logo["sizes"]["large"] : IMAGES_DIRECTORY . '/logo.png';

$url_favicon 		= get_field("theme_settings_general__favicon", "option");
$favicon 			= ($url_favicon) ? $url_favicon["sizes"]["large"] : IMAGES_DIRECTORY . '/favicon.ico';

$global_phone 		= get_field("theme_settings_general__phone", "option");
$global_email 		= get_field("theme_settings_general__mail", "option");

$toggle_icon_selected = get_field("theme_settings_header__header_button_toggle_animation_type", "option");

$theme_settings_header__animation_header = get_field("theme_settings_header__animation_header", "option");

$classesAnimationHeader 	= $theme_settings_header__animation_header . " animated dms-animated--level-2";

$is_home = is_front_page() ? " is-front" : " not-front";

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns" xmlns:fb="http://ogp.me/ns/fb">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="<?php echo $favicon; ?>">
    <link rel="apple-touch-icon" href="<?php echo $favicon; ?>"/>
	<?php wp_head(); ?>

	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/75fe86297f.js" crossorigin="anonymous"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    
</head>

<body <?php body_class($is_home); ?>>

	<!-- FIRST LOADER -->
	<div id="dms-loader" class="dms-loader__bg js-dms-first-loader dms-loader--first">
		<div class="overlay">
			<div class="box">
		      	<div class="loader loader--size-128 loader--thickness-10"></div>
		    </div>
		</div>
	</div>
	<header>
		<!-- LANGUAGES -->
		<div class="dms-header__languages dms-block-languages">
			<?php include(locate_template('template-parts/template-part-languages.php')); ?>
		</div>
		<nav id="nav-menu" class="navbar navbar-expand-lg navbar-dark py-2">
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Enlace al inicio">
			<img
				class="img_logo"
				src="<?php echo esc_attr( $logo ); ?>"
				alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
			/>
			</a>
			<button
			class="navbar-toggler"
			type="button"
			data-toggle="collapse"
			data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent"
			aria-expanded="false"
			aria-label="Toggle navigation"
			>
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php

					wp_nav_menu( array(
						'theme_location' 	=>  'header_menu',
						'container'     	=>  '',
						'items_wrap'    	=> '<ul class="%2$s">%3$s</ul>',
						'menu_class'    	=> 'navbar-nav mr-auto',
						'walker'  			=> new WPDocs_Walker_Nav_Menu() // custom walker
					));

				?>
			</div>
		</nav>
	</header>

	<!-- MAIN -->
	<main class="container-fluid">