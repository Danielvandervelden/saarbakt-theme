<?php
get_header();
?>

<div class="main-content-wrapper">

   <div class="blogpost">
		 <?php
		 while(have_posts()) {
		 the_post(); ?>
	<div class="single-blog-post">
		<div class="post-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnailimage'); ?></a></div>

	<div class="post-content">
	  <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

   <div class="metabox">
	   <p>Gepost door <?php the_author_posts_link(); ?> op <?php the_date('j F Y') ?> in de categorie: <?php echo get_the_category_list(', ') ?>.</p></div>

   <div class="generic-content">
   <p class="generic-content-p"><?php echo wp_trim_words(get_the_content(), 30);?></p>
   <form class="clearfix" action="<?php the_permalink(); ?>">
	   <button class="btn btn-pink btn-right" type="submit">Verder Lezen<i class="fa fa-chevron-right" aria-hidden="true"></i></button>
   </form>
   </div>
   </div>
 </div>
<?php  } ?>

  	<div class="post-navigation">
      	<?php posts_nav_link(); ?>
	</div>

</div>
	<?php echo get_template_part('template-parts/instagram'); ?>
</div>

<?php
get_footer();
?>
