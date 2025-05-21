<?php get_header(); ?>

<article class="article article--blog">

  <?php get_template_part('inc/banner'); ?>

  <?php if ( have_posts() ) { ?>

    <div class="content content--grey content--top content--bottom">
      <div class="content__fixed">
        <ul class="loop list--exempt">

        <?php while ( have_posts() ) : the_post(); ?>

          <li class="loop__item">
            <?php get_template_part('inc/post'); ?>
          </li>

        <?php endwhile; wp_reset_query(); ?>

        </ul>

        <?php echo pagination(); ?>

      </div>
    </div>

  <?php } ?>

</article>

<?php get_footer();?>