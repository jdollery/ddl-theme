<?php

if( have_rows('content_section') ){

  while( have_rows('content_section') ): the_row(); 

  $content_hide = get_sub_field('content_hide');
  $content_spacing = get_sub_field('content_spacing');
  $content_bg = get_sub_field('content_bg');
  $content_location = get_sub_field('content_location');
  $content_media = get_sub_field('content_media');
  $content_sticky = get_sub_field('content_sticky');
  $content_option = get_sub_field('content_option');
  $content_img = get_sub_field('content_img');
  $content_fit = get_sub_field('content_fit');
  $content_position = get_sub_field('content_position');
  $content_video = get_sub_field('content_video');
  $content_poster = get_sub_field('content_poster');
  $content_shortcode = get_sub_field('content_shortcode');
  $content_text = get_sub_field('content_text');

  if ($content_hide == false) {

  ?>

  <section class="content content--<?php echo esc_html($content_bg['value']); ?><?php if( $content_media == true ) { ?> content--<?php echo esc_html($content_location['value']); ?><?php } ?><?php if( $content_spacing ) { foreach( $content_spacing as $space ): ?> content--<?php echo $space; endforeach; } ?>">

    <div class="content__row">

      <?php if( $content_media == true ) { ?>

      <div class="content__column<?php if( $content_sticky == true ) { ?> content__column--sticky<?php } ?>">  

        <?php if (esc_html($content_option['value'] == 'video')) { ?>

        <div class="content__media content__media--video" >

          <?php if ($content_poster) { ?>

            <?php 
              
              $poster_id = $content_poster['id'];

              $poster_url_array_lg = wp_get_attachment_image_src($poster_id, 'content_lg', true);
              $poster_url_array_sm = wp_get_attachment_image_src($poster_id, 'content_sm', true);

              $poster_url_lg = $poster_url_array_lg[0];
              $poster_url_sm = $poster_url_array_sm[0];
            
            ?>

            <picture>
              <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo $poster_url_lg ?>">
              <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo $poster_url_sm ?>">
              <img 
                id="videoToggle"
                class="content__img"
                src="<?php echo esc_url($content_poster['url']) ?>"
                alt="<?php if($content_poster['alt']){ echo $content_poster['alt']; } else { the_title(); } ?>"
                width="900"
                height="900"
                loading="lazy"
                decoding="async"
                data-url="<?php echo $content_video ?>"
              >
            </picture>

          <?php } else { ?>

            <picture>
              <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-poster-lg.jpg">
              <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-poster-sm.jpg">
              <img 
                id="videoToggle"
                class="content__img"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-poster-lg.jpg"
                alt="Placeholder video poster"
                width="900"
                height="900"
                loading="lazy"
                decoding="async"
                data-url="<?php echo get_template_directory_uri(); ?>/assets/video/placeholder-video-compressed.mp4"
              >
            </picture>

          <?php } ?>

        </div>

        <?php } elseif (esc_html($content_option['value'] == 'shortcode')) { ?>

        <section class="content__media content__media--shortcode" >

          <?php echo $content_shortcode ?>

        </section>

        <?php } else { ?>

        <div class="content__media content__media--img content__media--<?php echo esc_html($content_fit['value']); ?> content__media--<?php echo esc_html($content_position['value']); ?>" >

          <?php if ($content_img) { ?>

            <?php 
              
              $thumb_id = $content_img['id'];

              $thumb_url_array_lg = wp_get_attachment_image_src($thumb_id, 'content_lg', true);
              $thumb_url_array_sm = wp_get_attachment_image_src($thumb_id, 'content_sm', true);

              $thumb_url_lg = $thumb_url_array_lg[0];
              $thumb_url_sm = $thumb_url_array_sm[0];
            
            ?>

            <picture>
              <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo $thumb_url_lg ?>">
              <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo $thumb_url_sm ?>">
              <img 
                class="content__img"
                src="<?php echo esc_url($content_img['url']) ?>"
                alt="<?php if($content_img['alt']){ echo $content_img['alt']; } else { the_title(); } ?>"
                width="900"
                height="900"
                loading="lazy"
                decoding="async"
              >
            </picture>

          <?php } else { ?>

              <picture>
                <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-lg.jpg">
                <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-sm.jpg">
                <img 
                  class="content__img"
                  src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-lg.jpg"
                  alt="Placeholder image"
                  width="900"
                  height="900"
                  loading="lazy"
                  decoding="async"
                >
              </picture>

          <?php } ?>

        </div>

        <?php } ?>
        
      </div>

      <?php } ?>

      <div class="content__column">

        <article class="content__text">
          <?php echo $content_text ?>
        </article>

      </div>

    </div>

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>