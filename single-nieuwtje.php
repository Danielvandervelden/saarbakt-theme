<?php get_header(); ?>

<div class="navigationblog">
	<div class="backbuttonblog">
		<form action="<?php echo site_url('/nieuwtjes') ?>">
			<button class="btn" type="submit"><i class="fa fa-chevron-left" aria-hidden="true"></i>Terug naar Nieuwtjes</button>
		</form>

	</div>
</div>
	<div class="page-content-wrapper">
		<div class="main-content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile;
		else: ?>
		<p> <?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>
