<?php

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$thumb_title = get_the_title($thumb_id);
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

$post_img = get_field('post_img');

?>


<a class="post" href="<?php echo get_permalink(); ?>">
  <div class="post__row">

    <div class="post__one">
      <?php if ( $post_img ) { ?>
        <img
          src="<?php echo esc_url($post_img['url']); ?>"
          alt="<?php echo $post_img['alt']; ?>" 
          width="200"
          height="200"
          loading="lazy"
          decoding="async"
        >
      <?php } elseif ( has_post_thumbnail() ) { ?>
        <img
          src="<?php echo $thumb_url ?>"
          alt="<?php echo $thumb_alt ?>"
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
          <h3 class="post__heading"><?php the_title(); ?></h3>
          <?php if(!is_post_type_archive('symptoms')) { ?>
          <div class="post__summary"><?php echo strip_tags( the_excerpt() ); ?></div>
          <?php } ?>
        </div>
        <span class="btn btn--black btn--block">Learn more</span>
      </div>
    </div>
  </div>
</a>