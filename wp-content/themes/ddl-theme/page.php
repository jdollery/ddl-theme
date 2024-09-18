<?php get_header(); ?>

<?php if ( is_front_page() ) { 
  
//   get_template_part('inc/carousel');

// } else { 

  get_template_part('inc/banner');

} ?>

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

<?php if ( is_page(72) ) { 

  get_template_part('inc/team');

} ?>

<?php get_footer();?>