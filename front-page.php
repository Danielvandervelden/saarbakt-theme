<?php
get_header();

?>

<div class="main-content-wrapper">

	<?php $frontpageText = new Wp_Query(array(
		'posts_per_page' => 1,
		'post_type' => 'frontpagetext',
	));
	while($frontpageText->have_posts()) {
		$frontpageText->the_post(); ?>

		<div class="main-content">
			<h1><?php the_title(); ?></h1>
			<p><?php the_content(); ?></p>
		</div>

	<?php } ?>
	<div class="sara-foto">

		<?php
		$image = get_field('voorpagina_foto');

		if( !empty($image) ): ?>

		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">

	<?php endif; ?>
</div>
</div>

<div class="nieuws-recepten">
	<div class="recepten-frontpage">
		<?php

		$homepagePosts = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => 1
		));

		while ($homepagePosts->have_posts()) {
			$homepagePosts->the_post(); ?>

			<h2 class="header-l">Nieuwste Recept</h2>
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

			<?php }?>

			<?php wp_reset_postdata(); ?>

		</div>

		<div class="nieuws-homepage">
				<?php $nieuwtjes = new Wp_Query(array(
					'posts_per_page' => 1,
					'post_type' => 'nieuwtje',
				));
				while($nieuwtjes->have_posts()) {
					$nieuwtjes->the_post(); ?>
					<h2 class="header-l">Meest recente nieuws</h2>
					<div class="single-blog-post">
						<div class="post-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnailimage'); ?></a></div>

						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<div class="generic-content">
							<p><?php echo wp_trim_words(get_the_content(), 30);?></p>
						</div>
						<form action="<?php the_permalink(); ?>">
							<button class="btn" type="submit">Verder Lezen<i class="fa fa-chevron-right" aria-hidden="true"></i></button>
						</form>

				<?php  }
				?>

			</div>
		</div>
	</div>

	<?php
	get_footer();
	?>
