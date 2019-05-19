<div class="baking-bags">
	<div class="bakings-bags-video">

	</div>

	<div class="glide">
		<div class="glide__track" data-glide-el="track">
			<ul class="glide__slides">
			<?php $bakingbags = new Wp_Query(array(
                'posts_per_page' => 100,
                'post_type' => 'bakingbags',
                ));
                while($bakingbags->have_posts()) {
              $bakingbags->the_post(); ?>
				<li class="glide__slide single-baking-bag">
					<div class="baking-bag-thumbnail"><a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('thumbnailimage'); ?></a></div>

						<div class="generic-content">
						<h4><?php echo get_the_title() ?></h4>

						<form class="clearfix" action="<?php the_permalink(); ?>">
							<button class="btn btn-pink" type="submit">Koop nu!</button>
						</form>
						</div>
				</li>
				<?php  } ?>

				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>
</div>