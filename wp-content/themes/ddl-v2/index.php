<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php if ( have_posts() ) { ?>

<section class="space-p">
  <ul class="loop">

    <?php while ( have_posts() ) : the_post(); ?>

      <li class="loop__item">
        <?php get_template_part('inc/post'); ?>
      </li>

    <?php endwhile; wp_reset_query(); ?>

    <?php echo pagination(); ?>
    
  </ul>
</section>

<?php } ?>

<?php get_footer();?>