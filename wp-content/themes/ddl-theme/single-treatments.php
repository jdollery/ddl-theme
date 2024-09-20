<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>
<?php get_template_part('inc/sections'); ?>

<?php
    
$loop = new WP_Query( array(
  'post_type' => 'treatments', 
  'order'  => 'ASC', 
  'orderby' => 'menu_order',
  'post_parent' => get_the_ID(),
  'numberposts' => -1,
) );

if ( $loop->have_posts() ) { ?>

  <section class="content content--white content--top content--bottom">
    <div class="content__body">
    
      <ul class="loop list--exempt">

        <?php  while ( $loop->have_posts() ) : $loop->the_post(); ?>

          <li class="loop__item">
            <?php get_template_part('inc/post'); ?>
          </li>

        <?php endwhile; wp_reset_query(); ?>

      </ul>

    </div>
  </section>

<?php } ?>

<?php get_footer();?>