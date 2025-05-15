<?php

$quicklink_alt_title = get_field('quicklink_alt_title');
$quicklink_alt_img = get_field('quicklink_alt_img');
$quicklink_alt_btn = get_field('quicklink_alt_btn'); 

?>

<a class="post" href="<?php echo get_permalink(); ?>">
  <div class="post__row">

    <div class="post__media">

      <?php if ( $quicklink_alt_img ) { ?>

        <?php 
              
          $quicklink_id = $quicklink_alt_img['id'];

          $quicklink_url_array_lg = wp_get_attachment_image_src($quicklink_id, 'post_lg', true);
          $quicklink_url_array_sm = wp_get_attachment_image_src($quicklink_id, 'post_sm', true);

          $quicklink_url_lg = $quicklink_url_array_lg[0];
          $quicklink_url_sm = $quicklink_url_array_sm[0];
        
        ?>

        <picture>
          <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo $quicklink_url_lg ?>">
          <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo $quicklink_url_sm ?>">
          <img 
            src="<?php echo esc_url($quicklink_alt_img['url']); ?>"
            alt="<?php if($quicklink_alt_img['alt']){ echo $quicklink_alt_img['alt']; } else { the_title(); } ?>"
            width="200"
            height="200"
            loading="lazy"
            decoding="async"
          >
        </picture>

      <?php } elseif ( has_post_thumbnail() ) { 
        
        $thumbnail_id = get_post_thumbnail_id( $post->ID );
        $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        $thumbnail_title = get_the_title($thumbnail_id);
  
        $thumbnail_url_array_lg = wp_get_attachment_image_src($thumbnail_id, 'post_lg', true);
        $thumbnail_url_array_sm = wp_get_attachment_image_src($thumbnail_id, 'post_sm', true);
  
        $thumbnail_url_lg = $thumbnail_url_array_lg[0];
        $thumbnail_url_sm = $thumbnail_url_array_sm[0];
      
      ?>

        <picture>
          <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo $thumbnail_url_lg ?>">
          <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo $thumbnail_url_sm ?>">
          <img 
            src="<?php echo $thumbnail_url_lg ?>"
            alt="<?php if($thumbnail_alt){ echo $thumbnail_alt; } else { the_title(); } ?>"
            width="200"
            height="200"
            loading="lazy"
            decoding="async"
          >
        </picture>

      <?php } else { ?>

        <picture>
          <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner-lg.jpg">
          <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner-sm.jpg">
          <img 
            src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner-lg.jpg"
            alt="Placeholder image"
            width="200"
            height="200"
            loading="lazy"
            decoding="async"
          >
        </picture>

      <?php } ?>

    </div>

    <div class="post__body">
      <div class="post__top">
        <?php if ( $quicklink_alt_title ) { ?>
          <h3 class="post__heading"><?php echo $quicklink_alt_title ?></h3>
        <?php } else { ?>
          <h3 class="post__heading"><?php the_title(); ?></h3>
        <?php } ?>
        <?php if(!is_post_type_archive('symptoms')) { ?>
        <div class="post__summary"><?php echo strip_tags( get_excerpt(165) ); ?></div>
        <?php } ?>
      </div>
      <div class="post__bottom">
        <?php if ( $quicklink_alt_btn ) { ?>
          <span class="btn btn--space"><?php echo $quicklink_alt_btn ?></span>
        <?php } else { ?>
          <span class="btn btn--space">Learn more</span>
        <?php } ?>
      </div>
    </div>
  </div>
</a>