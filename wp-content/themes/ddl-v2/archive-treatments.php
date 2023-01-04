<?php 

/* Template Name: Treatments Page */

get_header(); ?>

<?php get_template_part('inc/banner'); ?>
<?php get_template_part('inc/sections'); ?>

<section class="archive block-p">
  <ul class="archive__list">

    <?php
    
    $loop = new WP_Query( array(
      'post_type' => 'treatments', 
      'order'  => 'ASC', 
      // 'post__not_in' => array(51, 59), //Exclude these posts
      // 'post__in' => array(140, 142) //Only these posts
    ) );

    while ( $loop->have_posts() ) : $loop->the_post(); ?>

      <li class="archive__item">
        <a class="archive__link" href="<?php echo get_permalink(); ?>">
          <div class="archive__body">
            <h3 class="archive__heading"><?php the_title(); ?></h3>
            <div class="archive__summary"><?php echo strip_tags( the_excerpt() ); ?></div>
          </div>
          <span class="btn btn--black btn--block">Learn more</span>
        </a>
      </li>

    <?php endwhile; wp_reset_query(); ?>

  </ul>
</section>

<?php get_footer();?>