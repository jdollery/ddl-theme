<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('template-parts/component', 'banner'); ?>

<?php if ( !empty( get_the_content() ) ) { ?>
<article class="block-y">
  <div class="outer">
    <div class="outer__row">
      <div class="inner">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</article>
<?php } ?>

<?php endwhile; ?>

<?php get_footer(); ?>