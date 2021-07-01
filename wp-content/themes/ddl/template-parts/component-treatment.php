<?php

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$thumb_title = get_the_title($thumb_id);
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

?>

<div class="card__inner">
  <div class="card__body">
    <?php if ( has_post_thumbnail() ) { ?>
      <a class="card__media" href="<?php echo get_permalink(); ?>">
        <img class="card__img" src="<?php echo $thumb_url ?>" alt="<?php echo $thumb_alt ?>">
      </a>
    <?php } else { ?>
      <a class="card__media" href="<?php echo get_permalink(); ?>">
        <img class="card__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg" alt="<?php the_title(); ?>">
      </a>
    <?php } ?>
    <div class="card__text">
      <h4 class="card__title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
      <p class="card__summary"><?php echo strip_tags( get_excerpt(165) ); ?></p>
    </div>
  </div>
  <div class="card__footer">
    <a class="button-primary" href="<?php echo get_permalink(); ?>">Continue reading</a>
  </div>
</div>