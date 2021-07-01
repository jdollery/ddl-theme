<?php 

/* Template Name: Treatments Page */

get_header(); ?>

<?php get_template_part('template-parts/component', 'banner'); ?>

<div class="block-y" id="mainContent">
  <div class="outer">
    <div class="outer__row">
      <div class="inner">
        <div class="inner__row">

          <?php
          
          $loop = new WP_Query( array(
            'post_type' => 'treatments', 
            'posts_per_page' => '100',
            'order'  => 'ASC', 
            // 'tax_query' => array( //Only posts in these cats
            //   array(
            //       'taxonomy' => 'treatment-categories',
            //       'field'    => 'slug',
            //       'terms'    => 'nhs',
            //   ),
            // ),
            // 'post__not_in' => array(51, 59), //Exclude these posts
            // 'post__in' => array(52, 54, 59, 64) //Only these posts
          ) );
    
          while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <article class="card">

              <?php get_template_part( 'template-parts/component', 'treatment' ); ?>

            </article>

          <?php endwhile; wp_reset_query(); ?>

        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer();?>