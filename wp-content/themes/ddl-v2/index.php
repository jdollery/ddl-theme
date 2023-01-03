<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="content block-p">
  <div class="cell">
    <?php the_content(); ?>
  </div>
</article>

<?php endwhile; ?>

<?php get_footer();?>