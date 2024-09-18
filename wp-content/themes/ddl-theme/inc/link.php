<?php

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$thumb_title = get_the_title($thumb_id);
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

$quicklink_alt_title = get_field('quicklink_alt_title');
$quicklink_alt_img = get_field('quicklink_alt_img');
$quicklink_btn_text = get_field('quicklink_btn_text'); 

?>

<a class="post" href="<?php echo get_permalink(); ?>">
  <div class="post__row">

    <div class="post__one">

      <?php if ( $quicklink_alt_img ) { ?>

        <img
          src="<?php echo esc_url($quicklink_alt_img['url']); ?>"
          alt="<?php if($quicklink_alt_img['alt']){ echo $quicklink_alt_img['alt']; } else { the_title(); } ?>"
          width="200"
          height="200"
          loading="lazy"
          decoding="async"
        >

      <?php } elseif ( has_post_thumbnail() ) { ?>

        <img
          src="<?php echo $thumb_url ?>"
          alt="<?php if($thumb_alt){ echo $thumb_alt; } else { the_title(); } ?>"
          width="200"
          height="200"
          loading="lazy"
          decoding="async"
        >

      <?php } else { ?>

        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner.jpg"
          alt="<?php the_title(); ?>"
          width="200"
          height="200"
          loading="lazy"
          decoding="async"
        >

      <?php } ?>

    </div>

    <div class="post__two">
      <div class="post__body">
        <div>
          <?php if ( $quicklink_alt_title ) { ?>
            <h4 class="post__heading"><?php echo $quicklink_alt_title ?></h4>
          <?php } else { ?>
            <h4 class="post__heading"><?php the_title(); ?></h4>
          <?php } ?>
          <?php if(!is_post_type_archive('symptoms')) { ?>
          <div class="post__summary"><?php echo strip_tags( get_excerpt(165) ); ?></div>
          <?php } ?>
        </div>
        <span class="btn btn--black btn--space">Learn more</span>
      </div>
    </div>
  </div>
</a>