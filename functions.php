<?php 
// LOAD ALL THE THEME SCRIPTS AND STYLES!!!

require get_theme_file_path('/inc/search-route.php');

function saarbakt_files() {
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700');
	wp_enqueue_style( 'saarbakt styles', get_stylesheet_directory_uri() . '/style.css', array(), '4.1.4');

	// Vendor styles
	wp_enqueue_style( 'Glide styles', get_stylesheet_directory_uri() . '/styles/vendor/glide.css', array(), '4.1.4');
	wp_enqueue_style( 'Glide theme styles', get_stylesheet_directory_uri() . '/styles/vendor/glide-theme.css', array(), '4.1.4');

	// Main JS directory
	wp_register_script("main javascript", get_bloginfo("stylesheet_directory") . "js/script-min.js");
	wp_enqueue_script('main-saarbakt-js', get_theme_file_uri('js/script-min.js'), array('jquery'), '3.0.0', true);

	// Vendor scripts
	wp_enqueue_script('glide', get_theme_file_uri('js/vendor/glide.js'), '1.0.0', true);
	
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css');
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