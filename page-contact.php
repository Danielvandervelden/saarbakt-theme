<?php get_header(); ?>

                <div class="main-content">
                  <?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile;
            else: ?>
            <p> <?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
               </div>

<?php get_footer(); ?>
