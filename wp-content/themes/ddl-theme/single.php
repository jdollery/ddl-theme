<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php if ( !empty( get_the_content() ) ) { ?>

  <article class="space-p">
    <?php the_content(); ?>
  </article>

<?php } else {  

  get_template_part('inc/sections'); 

}  ?>

<?php get_footer();?>