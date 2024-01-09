<?php 

/* Template Name: Treatments Page */

get_header(); ?>

<?php get_template_part('inc/banner'); ?>
<?php get_template_part('inc/sections'); ?>

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

  while ( $parents->have_posts() ) : $parents->the_post(); ?>

    <section class="space-p">

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

      <?php 

      $children = new WP_Query( array(
        'post_type' => 'treatments', 
        'order'  => 'ASC', 
        'orderby' => 'menu_order',
        'post_parent' => get_the_ID(),
        'numberposts' => -1,
      ) );

      $total_children = $children->found_posts;

      if( $children -> have_posts() ) { ?>

        <div>

          <ul class="loop">

            <?php
            
            while ( $children->have_posts() ) : $children->the_post();

            $thumb_id = get_post_thumbnail_id( $post->ID );
            $thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            $thumb_title = get_the_title($thumb_id);
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
            $thumb_url = $thumb_url_array[0];

            $quicklink_alt_title = get_field('quicklink_alt_title');
            $quicklink_btn_text = get_field('quicklink_btn_text'); 
            
            ?>

              <li class="loop__item">
                <?php get_template_part('inc/post'); ?>
              </li>

            <?php endwhile; wp_reset_query(); ?>

          </ul>

        </div>

      <?php } ?>

    </section>

  <?php endwhile; wp_reset_query(); ?>

<?php get_footer(); ?>