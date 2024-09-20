<?php 

/* Template Name: Treatments Page */

get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<section class="space-p">

  <?php

  $parents = new WP_Query( array(
    'post_type' => 'treatments', 
    'order'  => 'menu_order', 
    'order'  => 'ASC',
    // 'post__not_in' => array(51, 59), //Exclude these posts
    // 'post__in' => array(140, 142) //Only these posts
    'post_parent' => 0,
    'numberposts' => -1,
  ) );

  while ( $parents->have_posts() ) : $parents->the_post();

    $isParent =  array(
      'post_parent' => get_the_ID(), // Current post's ID
    );

    $hasChildren = get_children( $isParent );

    if( $hasChildren ) { ?>

      <div class="space-p-b parent">

        <h3><?php the_title(); ?></h3>

        <?php

        $strip_excerpt = get_the_excerpt();
        $tags = array("<p>", "</p>");
        $strip_excerpt = str_replace($tags, "", $strip_excerpt);

        ?>

        <?php if( $strip_excerpt ) { ?>
          <h6><?php echo $strip_excerpt; ?></h6>
        <?php } ?>

        <a class="btn btn--black btn--space" href="<?php echo get_permalink(); ?>">Learn more</a>

      </div>

      <?php 

      $children = new WP_Query( array(
        'post_type' => 'treatments', 
        'order'  => 'ASC', 
        'orderby' => 'menu_order',
        'post_parent' => get_the_ID(),
        'numberposts' => -1,
      ) );

      $total_children = $children -> found_posts;

      if( $children -> have_posts() ) { ?>

        <div>

          <ul class="loop">

            <?php
            
            while ( $children->have_posts() ) : $children->the_post();
            
            ?>

              <li class="loop__item">
                <?php get_template_part('inc/link'); ?>
              </li>

            <?php endwhile; wp_reset_query(); ?>

          </ul>

        </div>

      <?php } ?>

    <?php } else { ?>

      <div class="space-p-b">

        <h3><?php the_title(); ?></h3>

        <?php

        $strip_excerpt = get_the_excerpt();
        $tags = array("<p>", "</p>");
        $strip_excerpt = str_replace($tags, "", $strip_excerpt);

        ?>

        <?php if( $strip_excerpt ) { ?>
          <h6><?php echo $strip_excerpt; ?></h6>
        <?php } ?>

        <a class="btn btn--black btn--space" href="<?php echo get_permalink(); ?>">Learn more</a>

      </div>

    <?php } ?>

  <?php endwhile; wp_reset_query(); ?>

  </section>

<?php get_footer(); ?>