<?php get_header(); ?>

<?php if ( is_front_page() ) { 
  
  get_template_part('inc/carousel');

} else { 

  get_template_part('inc/banner');

} ?>

<?php if ( !empty( get_the_content() ) ) { ?>

  <article class="block-p">
    <?php the_content(); ?>
  </article>

<?php } else {  

  get_template_part('inc/sections'); 

}  ?>

<?php if ( is_page('team') ) { 

  get_template_part('inc/team');

} ?>

<?php get_footer();?>