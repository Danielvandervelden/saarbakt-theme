<?php get_header(); ?>

<div class="main-content-wrapper">
	<div class="navigationblog">
		<div class="backbuttonblog">
			<form action="<?php echo site_url('/recepten') ?>">
				<button class="btn btn-pink" type="submit"><i class="fa fa-chevron-left" aria-hidden="true"></i> Terug naar Recepten</button>
			</form>
		</div>
	</div>
	<div class="main-content">
		<div class="singleblogpostflexbox">
			<div class="single-blog-post">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile;
			else: ?>
				<p>
					<?php _e('Sorry, no posts matched your criteria.'); ?>
				</p>
				<?php endif; ?>
			</div>
			<div class="receptenbox">
				<h2 class="header-l ingrediententext"><span>Ingrediënten</span></h2>
				<div class="ingredientenflex">
					<div class="ingredientencontent">
						<p>
							<?php echo get_field('ingredienten'); ?>
						</p>
					</div>
					<div class="post-thumbnail-single">
						<?php the_post_thumbnail('thumbnailimagesingle'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
