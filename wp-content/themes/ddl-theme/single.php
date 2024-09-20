<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php if ( !empty( get_the_content() ) ) { ?>

  <article class="content content--white content--top content--bottom">
    <div class="content__body">
      <?php the_content(); ?>
    </div>
  </article>

<?php } else {  

  get_template_part('inc/sections'); 

}  ?>

<?php get_footer();?>