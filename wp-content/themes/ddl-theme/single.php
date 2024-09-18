<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php if ( !empty( get_the_content() ) ) { ?>

  <article class="content content--white content--top content--bottom">
    <div class="content__row">
      <div class="content__column">
        <div class="content__text">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </article>

<?php } else {  

  get_template_part('inc/sections'); 

}  ?>

<?php get_footer();?>