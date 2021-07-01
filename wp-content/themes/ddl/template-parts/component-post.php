<?php

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$thumb_title = get_the_title($thumb_id);
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

?>

<a class="card__inner" href="<?php echo get_permalink(); ?>" title="Go to article">
  <div class="card__body">
    <div class="card__media">
    <?php if ( has_post_thumbnail() ) { ?>
      <figure class="card__figure" style="background-image: url('<?php echo $thumb_url ?>')">
        <img class="card__img" src="<?php echo $thumb_url ?>" alt="<?php echo $thumb_alt ?>">
      </figure>
    <?php } else { ?>
      <figure class="card__figure" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg')">
        <img class="card__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg" alt="<?php the_title(); ?>">
      </figure>
    <?php } ?>
    </div>
    <div class="card__text">
      <h4 class="card__title"><?php the_title(); ?></h4>
      <p class="card__summary"><?php echo strip_tags( get_excerpt(165) ); ?></p>
    </div>
  </div>
  <div class="card__footer">
    <button class="button-primary" type="button">Learn more</button>
  </div>
</a>