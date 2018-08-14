<?php
get_header();
?>

<div class="headertext">
	<h2 class="header-l">Posts in de categorie: <?php single_cat_title(); ?></h2>
</div>

<div class="container-blogpostfeed">

   <div class="blogpost">
		 <?php
		 while(have_posts()) {
		 the_post(); ?>
	<div class="single-blog-post">
		<div class="post-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnailimage'); ?></a></div>

	<div class="post-content">
	  <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

   <div class="metabox">
	   <p>Gepost door <?php the_author_posts_link(); ?> op <?php the_date('n.j.y') ?> in de categorie: <?php echo get_the_category_list(', ') ?>.</p></div>

   <div class="generic-content">
   <p class="generic-content-p"><?php echo wp_trim_words(get_the_content(), 30);?></p>
   <form action="<?php the_permalink(); ?>">
	   <button class="btn" type="submit">Verder Lezen<i class="fa fa-chevron-right" aria-hidden="true"></i></button>
   </form>
   </div>
   </div>
 </div>
<?php  }

echo paginate_links();
 ?>

</div>

	  <div class="instagramfeed">

		 <h2 class="">Recente Instagram Posts</h2>

		 <!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/dacb915036445ac9959c4fff6c77a6c9.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
	  </div>

</div>

<?php
get_footer();
?>
