<?php

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$thumb_title = get_the_title($thumb_id);
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

?>

<a href="<?php echo get_permalink(); ?>" title="Go to article">
  <div class="item__body">
    <div class="item__media">
    <?php if ( has_post_thumbnail() ) { ?>
      <figure style="background-image: url('<?php echo $thumb_url ?>')">
        <img src="<?php echo $thumb_url ?>" alt="<?php echo $thumb_alt ?>">
      </figure>
    <?php } else { ?>
      <figure style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg')">
        <img src="('<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg')" alt="<?php the_title(); ?>">
      </figure>
    <?php } ?>
    </div>
    <div class="item__text">
      <h4 class="item__title"><?php the_title(); ?></h4>
      <p><?php echo strip_tags( get_excerpt(165) ); ?></p>
    </div>
    <div class="item__footer">
      <button class="button-primary" type="button">Learn more</button>
    </div>
  </div> 
</a>