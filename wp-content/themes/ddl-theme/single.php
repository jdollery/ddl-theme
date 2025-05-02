<?php get_header(); ?>

<article class="article article--single">

  <?php get_template_part('inc/banner'); ?>

  <?php if ( !empty( get_the_content() ) ) { ?>

    <div class="content content--white content--top content--bottom">
      <div class="content__fixed">
        <?php the_content(); ?>
      </div>
    </div>

  <?php } else {  

    get_template_part('inc/sections'); 

  }  ?>

</article>

<?php get_footer();?>