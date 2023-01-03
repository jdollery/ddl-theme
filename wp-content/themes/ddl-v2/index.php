<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="block-p">
  <?php the_content(); ?>
</article>

<?php endwhile; ?>

<?php get_footer();?>