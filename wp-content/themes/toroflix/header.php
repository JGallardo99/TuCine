<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toroflix
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
   
    <?php wp_head(); ?>
</head>
<body id="Tf-Wp" <?php body_class(); ?>>

	<!--<Tf-Wp>-->
	<div id="page" class="Tf-Wp site">
	    
		<!--<Header>-->
		<header id="Hd" class="Header">
			<div class="Container">
                <div id="HdTop" class="Top">
                    <span class="MenuBtn AATggl CXHd" data-tggl="Tf-Wp"><i></i><i></i><i></i></span>
                    <div class="Search">
                        <?php get_template_part( 'formsearch' ); ?>
                    </div>
                    <figure class="Logo">
                    <?php
                        echo '<a href="'.esc_url( home_url( '/' ) ).'" rel="home"><img src="'.toroflix_config('logo', get_template_directory_uri().'/img/toroflix-logo.svg').'" alt="'.get_bloginfo( 'name' ).'" class="custom-logo"></a>';
                    ?>
                    </figure>
                    <nav class="Menu">
                        <ul>
                            <?php wp_nav_menu(array('container' => false, 'theme_location' => 'menu-1', 'items_wrap' => '%3$s', 'fallback_cb' => 'tr_default_menu', 'menu_id' => 'primary-menu')); ?>
                        </ul>
                    </nav>
                </div>
			</div>
		</header>
		<!--</Header>-->
		

		<!--<Body>-->
        <div class="Body site-content" id="content">