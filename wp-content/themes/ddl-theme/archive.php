<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php if ( have_posts() ) { ?>

<section class="content content--white content--top content--bottom">
  <div class="content__body">
    <ul class="loop list--exempt">

      <?php while ( have_posts() ) : the_post(); ?>

        <li class="loop__item">
          <?php get_template_part('inc/post'); ?>
        </li>

      <?php endwhile; wp_reset_query(); ?>

    </ul>
  </div>
</section>

<?php } ?>

<?php get_footer();?>