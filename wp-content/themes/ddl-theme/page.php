<?php get_header(); ?>

<article class="article article--page">

  <?php get_template_part('includes/banner'); ?>

  <?php if ( !empty( get_the_content() ) ) { ?>

    <div class="content content--white content--top content--bottom">
      <div class="content__fixed">
        <?php the_content(); ?>
      </div>
    </div>

  <?php } else {  

    get_template_part('includes/sections'); 

  }  ?>

  <?php if ( is_page(192) ) { 

    get_template_part('includes/team');

  } ?>

</article>

<?php get_footer();?>