<?php get_header(); ?>

  <div class="main-content-wrapper nieuwtjes">
    <div class="blogpost">
      <?php $nieuwtjes = new Wp_Query(array(
                'posts_per_page' => 4,
                'post_type' => 'nieuwtje',
                ));
                while($nieuwtjes->have_posts()) {
              $nieuwtjes->the_post(); ?>
      <div class="single-blog-post">
        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

        <div class="generic-content">
          <p class="generic-content-p">
            <?php echo wp_trim_words(get_the_content(), 30);?>
          </p>
          <div class="post-thumbnail"><a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('thumbnailimage'); ?></a></div>

          <form class="clearfix" action="<?php the_permalink(); ?>">
            <button class="btn btn-pink btn-right" type="submit">Verder Lezen<i class="fa fa-chevron-right" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      <?php  } ?>

    <div class="post-navigation">
      <?php posts_nav_link(); ?>
    </div>
    </div>

    <?php echo get_template_part('template-parts/instagram'); ?>

  </div>

  </div>

<?php get_footer();?>