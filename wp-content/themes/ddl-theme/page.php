<?php get_header(); ?>

<article class="article article--page">

  <?php get_template_part('inc/banner'); ?>

  <?php if ( !empty( get_the_content() ) ) { ?>

    <div class="content content--white content--top content--bottom">
      <div class="content__body">
        <?php the_content(); ?>
      </div>
    </div>

  <?php } else {  

    get_template_part('inc/sections'); 

  }  ?>

  <?php if ( is_page(192) ) { 

    get_template_part('inc/team');

  } ?>

</article>

<?php get_footer();?>