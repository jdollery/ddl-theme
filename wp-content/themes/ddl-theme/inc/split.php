<?php

if( have_rows('split_section') ){

  while( have_rows('split_section') ): the_row(); 

  $split_hide = get_sub_field('split_hide');
  $split_spacing = get_sub_field('split_spacing');
  $split_bg = get_sub_field('split_bg');
  $split_location = get_sub_field('split_location');
  $split_media = get_sub_field('split_media');
  $split_option = get_sub_field('split_option');
  $split_img = get_sub_field('split_img');
  $split_fit = get_sub_field('split_fit');
  $split_position = get_sub_field('split_position');
  $split_video = get_sub_field('split_video');
  $split_poster = get_sub_field('split_poster');
  $split_shortcode = get_sub_field('split_shortcode');
  $split_body = get_sub_field('split_body');

  if ($split_hide == false) {

  ?>

  <section class="split split--<?php echo esc_html($split_bg['value']); ?><?php if( $split_media == true ) { ?> split--<?php echo esc_html($split_location['value']); ?><?php } ?><?php if( $split_spacing ) { foreach( $split_spacing as $space ): ?> split--<?php echo $space; endforeach; } ?>">

    <div class="split__row">

      <?php if( $split_media == true ) { ?>

      <div class="split__column<?php if( $split_img || $split_video ) { ?> split__column--sticky<?php } ?>">  

        <?php if (esc_html($split_option['value'] == 'video')) { ?>

        <div class="split__media split__media--img split__media--<?php echo esc_html($split_fit['value']); ?> split__media--<?php echo esc_html($split_position['value']); ?>" >

        <?php 
            
            $urlPath = wp_get_attachment_url($split_img['id']); //get img URL path using id
            $serverPath = wp_get_original_image_path($split_img['id']); //get img server path using id

            $serverStrip = substr($serverPath, 0 , (strrpos($serverPath, "."))); //remove file extension
            $serverConvert = convert_img($serverPath, $serverStrip . '.webp', 100); //convert and generate webp

            $urlStrip = substr($urlPath, 0 , (strrpos($urlPath, "."))); //remove file extension
            $urlCombine = $urlStrip . '.webp'; //combine url and file extension 
          
          ?>

          <picture>
            <source type="image/webp" media="(min-width: 576px)" srcset="<?php echo $urlCombine ?>">
            <source type="image/jpg" media="(min-width: 576px)" srcset="<?php echo esc_url($split_img['url']) ?>">
            <img 
              class="split__img"
              src="<?php echo esc_url($split_img['url']) ?>"
              alt="<?php if($split_img['alt']){ echo $split_img['alt']; } else { the_title(); } ?>"
              width="900"
              height="900"
              loading="lazy"
              decoding="async"
            >
          </picture>

          <!-- <img
            src="<?php echo esc_url($split_img['url']); ?>"
            alt="<?php if($split_img['alt']){ echo $split_img['alt']; } else { the_title(); } ?>"
            width="900"
            height="900"
            loading="lazy"
            decoding="async"
          > -->

        </div>

        <?php } elseif (esc_html($split_option['value'] == 'shortcode')) { ?>

        <section class="split__media split__media--shortcode" >

          <?php echo $split_shortcode ?>

        </section>

        <?php } else { ?>

        <div class="split__media split__media--img split__media--<?php echo esc_html($split_fit['value']); ?> split__media--<?php echo esc_html($split_position['value']); ?>" >

        <?php 
            
            $urlPath = wp_get_attachment_url($split_img['id']); //get img URL path using id
            $serverPath = wp_get_original_image_path($split_img['id']); //get img server path using id

            $serverStrip = substr($serverPath, 0 , (strrpos($serverPath, "."))); //remove file extension
            $serverConvert = convert_img($serverPath, $serverStrip . '.webp', 100); //convert and generate webp

            $urlStrip = substr($urlPath, 0 , (strrpos($urlPath, "."))); //remove file extension
            $urlCombine = $urlStrip . '.webp'; //combine url and file extension 
          
          ?>

          <picture>
            <source type="image/webp" media="(min-width: 576px)" srcset="<?php echo $urlCombine ?>">
            <source type="image/jpg" media="(min-width: 576px)" srcset="<?php echo esc_url($split_img['url']) ?>">
            <img 
              class="split__img"
              src="<?php echo esc_url($split_img['url']) ?>"
              alt="<?php if($split_img['alt']){ echo $split_img['alt']; } else { the_title(); } ?>"
              width="900"
              height="900"
              loading="lazy"
              decoding="async"
            >
          </picture>

          <!-- <img
            src="<?php echo esc_url($split_img['url']); ?>"
            alt="<?php if($split_img['alt']){ echo $split_img['alt']; } else { the_title(); } ?>"
            width="900"
            height="900"
            loading="lazy"
            decoding="async"
          > -->

        </div>

        <?php } ?>
        
      </div>

      <?php } ?>

      <div class="split__column<?php if( !$split_media ) { ?> split__column--full<?php } ?>">

        <article class="split__body">
          <?php echo $split_body ?>
        </article>

      </div>

    </div>

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>