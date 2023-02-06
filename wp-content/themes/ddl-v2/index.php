<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<section class="archive block-p">
  <ul class="archive__list">
    <?php while ( have_posts() ) : the_post(); ?>
    
      <li class="archive__item">
        <a class="archive__link" href="<?php echo get_permalink(); ?>">
          <div class="archive__body">
            <h3 class="archive__heading"><?php the_title(); ?></h3>
            <div class="archive__summary"><?php echo strip_tags( the_excerpt() ); ?></div>
          </div>
          <span class="btn btn--black btn--block">Learn more</span>
        </a>
      </li>
  
    <?php endwhile; ?>
  </ul>
</section>

<?php get_footer();?>