<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<section class="quicklinks block-p">
  <ul class="quicklinks__list">

    <?php
    
    $loop = new WP_Query( array(
      'post_type' => 'post', 
      'order'  => 'ASC', 
      // 'post__not_in' => array(51, 59), //Exclude these posts
      // 'post__in' => array(140, 142) //Only these posts
    ) );

    while ( $loop->have_posts() ) : $loop->the_post(); ?>

      <li class="quicklinks__item">
        <a class="quicklinks__body" href="<?php echo get_permalink(); ?>">

        <div class="quicklinks__text">
          <h3 class="quicklinks__heading"><?php the_title(); ?></h3>
          <div class="quicklinks__summary"><?php echo strip_tags( the_excerpt() ); ?></div>
        </div>
        <span class="button button--black">Learn more</span>

        </a>
      </li>

    <?php endwhile; wp_reset_query(); ?>

  </ul>
</section>

<?php get_footer();?>