<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('inc/banner'); ?>

<article class="content">
  <div class="cell-fluid cell-gutter">
    <div class="cell-row cell-row-gutter">
      <div class="cell cell-gutter span-12">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</article>

<?php endwhile; ?>

<?php get_footer();?>