<?php 

/* Template Name: Treatments Page */

get_header(); ?>

<?php get_template_part('inc/banner'); ?>
<?php get_template_part('inc/sections'); ?>

<section class="space-p">
  <ul class="loop">

    <?php
    
    $loop = new WP_Query( array(
      'post_type' => 'treatments', 
      'order'  => 'ASC', 
      // 'post__not_in' => array(51, 59), //Exclude these posts
      // 'post__in' => array(140, 142) //Only these posts
      'post_parent' => get_the_ID(),
      'numberposts' => -1,
    ) );

    while ( $loop->have_posts() ) : $loop->the_post(); ?>

      <li class="loop__item">
        <?php get_template_part('inc/post'); ?>
      </li>

    <?php endwhile; wp_reset_query(); ?>

  </ul>
</section>

<?php get_footer();?>