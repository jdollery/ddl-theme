<?php 

/* Template Name: Treatments Page */

get_header(); ?>

<?php get_template_part('inc/banner'); ?>
<?php get_template_part('inc/sections'); ?>

<section class="quicklink block-p-x block-m-y">
  <div class="cell-fluid">
    <ul class="quicklink__list">

      <?php
      
      $loop = new WP_Query( array(
        'post_type' => 'treatments', 
        'order'  => 'ASC', 
        // 'post__not_in' => array(51, 59), //Exclude these posts
        // 'post__in' => array(140, 142) //Only these posts
      ) );

      while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <li class="quicklink__item">
          <a class="quicklink__body" href="<?php echo get_permalink(); ?>">

          <div class="quicklink__text">
            <h3 class="quicklink__heading"><?php the_title(); ?></h3>
            <p class="quicklink__summary"><?php echo strip_tags( the_excerpt() ); ?></p>
          </div>
          <span class="button">Learn more</span>

          </a>
        </li>

      <?php endwhile; wp_reset_query(); ?>

    </ul>
  </div>
</section>

<?php get_footer();?>