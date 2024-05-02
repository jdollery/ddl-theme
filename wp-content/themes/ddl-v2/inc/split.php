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

<<<<<<< HEAD
  <section class="split split--<?php echo esc_html($split_bg['value']); ?><?php if( $split_media == true ) { ?> split--<?php echo esc_html($split_location['value']); ?><?php } ?><?php if( $split_spacing ) { foreach( $split_spacing as $space ): ?> split--<?php echo $space; endforeach; } ?>">
=======
  <section class="split split--<?php echo esc_html($split_location['value']); ?> split--<?php echo esc_html($split_bg['value']); ?><?php if( $split_spacing ) { foreach( $split_spacing as $space ): ?> split--<?php echo $space; endforeach; } ?>">
>>>>>>> 88ee99d4dec01a49965469ce8541476a99913c1e

    <div class="split__row">

      <?php if( $split_media == true ) { ?>

      <div class="split__column<?php if( $split_img || $split_video ) { ?> split__column--sticky<?php } ?>">  

        <?php if (esc_html($split_option['value'] == 'video')) { ?>

        <div class="split__media split__media--video" >

          <img
            id="videoToggle"
            src="<?php echo esc_url($split_poster['url']); ?>"
            alt="<?php if($split_poster['alt']){ echo $split_poster['alt']; } else { the_title(); } ?>" 
            width="900"
            height="900"
            loading="lazy"
            decoding="async"
            data-url="<?php echo $split_video ?>"
          >

        </div>

        <?php } elseif (esc_html($split_option['value'] == 'shortcode')) { ?>

        <section class="split__media split__media--shortcode" >

          <?php echo $split_shortcode ?>

        </section>

        <?php } else { ?>

        <div class="split__media split__media--img split__media--<?php echo esc_html($split_fit['value']); ?> split__media--<?php echo esc_html($split_position['value']); ?>" >

          <img
            src="<?php echo esc_url($split_img['url']); ?>"
            alt="<?php if($split_img['alt']){ echo $split_img['alt']; } else { the_title(); } ?>"
            width="900"
            height="900"
            loading="lazy"
            decoding="async"
          >

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