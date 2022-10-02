<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('inc/banner'); ?>

<?php endwhile; ?>

<?php get_footer();?>