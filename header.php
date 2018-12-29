<?php
$blog_home = get_option('page_for_posts');
$homepage = get_option('page_on_front');
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (is_front_page()) {

	if(wp_is_mobile()) {
		$header_image = get_the_post_thumbnail_url($homepage, 'header_mobile');
	} else {
		$header_image = get_the_post_thumbnail_url($homepage, 'header_full');
	}
} elseif (is_home()) {

    if (wp_is_mobile()) {
        $header_image = get_the_post_thumbnail_url($blog_home, 'header_mobile');
    } else {
        $header_image = get_the_post_thumbnail_url($blog_home, 'header_full');
    }
} elseif (strpos($url, 'nieuwtjes') !== false) {
	if (wp_is_mobile()) {
		$header_image = get_the_post_thumbnail_url(96, 'header_mobile');
	} else {
		$header_image = get_the_post_thumbnail_url(96, 'header_full');
	}
} 
elseif (strpos($url, 'tips-tricks') !== false) {
	if (wp_is_mobile()) {
		$header_image = get_the_post_thumbnail_url(101, 'header_mobile');
	} else {
		$header_image = get_the_post_thumbnail_url(101, 'header_full');
	}
} elseif (strpos($url, 'contact') !== false) {
	if (wp_is_mobile()) {
		$header_image = get_the_post_thumbnail_url(101, 'header_mobile');
	} else {
		$header_image = get_the_post_thumbnail_url(101, 'header_full');
	}
}
else if ($header_image === NULL) {
	if (wp_is_mobile()) {
        $header_image = get_the_post_thumbnail_url($blog_home, 'header_mobile');
    } else {
        $header_image = get_the_post_thumbnail_url($blog_home, 'header_full');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head(); ?> <!-- make sure everthing in functions.php gets loaded -->
	<title>SaarBakt</title>
</head>
<body <?php body_class(); ?>>
	<div class="page-wrapper">
	<header class="header-container" style="background-image: url('<?php echo $header_image; ?>')">
		<nav class="clearfix" id="nav-bar" class="sticky" role="navigation">
			<div class="mobile-menu-icon"><i class="fa fa-bars" aria-hidden="true"></i></div>
			<div class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></div>

			<div class="navigationdesktop">
					<?php wp_nav_menu( array( 'container_class' => 'main-nav', 'theme_location' => 'headerMenuLocation' ) ); ?>
			</div>
		</nav>
		<div id="backdrop"></div>
		<div id="mobile-menu">
			<div class="exit"><i class="fas fa-times"></i></div>
			<h2>Menu</h2>
		</div>

		<div class="saarbaktlogo">
			<a href="<?php echo site_url("/Home") ?>"><img src="<?php echo get_theme_file_uri('images/Saarbaktlogoheader.png')?>"></a>
		</div>
	</header>
 
	<?php if(is_home()) { ?>
		<h1 class="page-title"><span class="title">Alle baksels</span></h1>
	<?php } else if (is_category()) { ?>
		<h1 class="page-title"><span class="title"><?php single_cat_title(); ?></span></h1>
	<?php } else { ?>
		<h1 class="page-title"><span class="title"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_title(); endwhile;
		else: ?>
		<?php _e('Oh, nee toch?!'); ?>
		<?php endif; ?></span></h1>
	<?php } ?>
