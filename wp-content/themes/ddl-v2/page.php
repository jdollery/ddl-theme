<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('inc/banner'); ?>

<article class="content block-y">
  <div class="cell-fluid cell-gutter-x">
    <div class="cell-row cell-row-gutter-x">
      <div class="cell cell-gutter-x cell-gutter-y cell-span-12">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</article>

<?php endwhile; ?>

<?php get_footer();?>