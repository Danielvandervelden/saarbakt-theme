<?php

// LOAD ALL THE THEME SCRIPTS AND STYLES!!!

require get_theme_file_path('/inc/search-route.php');

function saarbakt_files() {
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro');
	wp_enqueue_style('style.css', get_stylesheet_uri());
	wp_enqueue_script('main-saarbakt-js', get_theme_file_uri('/js/script.js'), array('jquery'), NULL, '1.0', true);
	wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.1/js/all.js', array(), null );
	wp_localize_script('main-saarbakt-js', 'saarbaktData', array(
		'root_url' => get_site_url(),
	));
}

add_action('wp_enqueue_scripts', 'saarbakt_files');

// LOAD DIFFERENT FEATURES SUCH AS MENU PLACES, SUPPORT FOR THUMBNAILS, TITLE TAGS, ETC.
function saarbakt_features() {
	register_nav_menu('headerMenuLocation', 'Header Menu Location');
	register_nav_menu('footerMenuLocation', 'Footer Menu Location');
	add_theme_support('title-tag');
	add_theme_support( 'post-thumbnails');
	add_image_size('thumbnailimage', 150, auto, false);
	add_image_size('header_mobile', 768, auto, false);
	add_image_size('header_full', 2500, auto, false);
	add_image_size('thumbnailimagesingle', 300, auto, true);
	add_post_type_support( 'page', 'excerpt' );
}
add_action('after_setup_theme', 'saarbakt_features');

function frontpagetextID() {
	$args = array( 'post_type' => 'frontpagetext');

	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	get_the_ID();
	endwhile;
}
