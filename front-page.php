<?php
get_header();

?>

<div class="main-content-wrapper">

		<div class="main-content">
			<p><?php the_content(); ?></p>
		</div>

	<div class="sara-foto">
		<?php
		$image = get_field('voorpagina_foto');
		echo '<img src="' . $image . '" alt="voorpagina foto">';
		?>
</div>
</div>

<div class="nieuws-recepten">
	<div class="recepten-frontpage main-content-wrapper">
		<?php

		$homepagePosts = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => 1
		));

		while ($homepagePosts->have_posts()) {
			$homepagePosts->the_post(); ?>

			<h2>Nieuwste Recept</h2>
			<div class="single-blog-post">
				<div class="post-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnailimage'); ?></a></div>

			<div class="post-content">
			  <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

		   <div class="metabox">
			   <p>Gepost door <?php the_author_posts_link(); ?> op <?php the_date('j F Y') ?> in de categorie: <?php echo get_the_category_list(', ') ?>.</p></div>

		   <div class="generic-content">
		   <p class="generic-content-p"><?php echo wp_trim_words(get_the_content(), 30);?></p>
		   <form class="clearfix" action="<?php the_permalink(); ?>">
			   <button class="btn btn-pink btn-right" type="submit">Verder Lezen <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
		   </form>
		   </div>
		   </div>
		 </div>

			<?php }?>

			<?php wp_reset_postdata(); ?>

		</div>

		<div class="nieuws-homepage main-content-wrapper">
				<?php $nieuwtjes = new Wp_Query(array(
					'posts_per_page' => 1,
					'post_type' => 'nieuwtje',
				));
				while($nieuwtjes->have_posts()) {
					$nieuwtjes->the_post(); ?>
					<h2>Meest recente nieuws</h2>
					<div class="single-blog-post">
						<?php if(get_the_post_thumbnail()) { ?>
						<div class="post-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnailimage'); ?></a></div>
						<?php } ?>
						<div class="post-content">
							<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

							<div class="generic-content">
								<p><?php echo wp_trim_words(get_the_content(), 30);?></p>
							</div>
							<form class="clearfix" action="<?php the_permalink(); ?>">
								<button class="btn btn-pink btn-right" type="submit"><span>Verder Lezen</span> <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
							</form>
						</div>
				<?php  }
				?>

			</div>
		</div>
	</div>

	<?php
	get_footer();
	?>
