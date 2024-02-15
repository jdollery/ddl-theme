<?php

if( have_rows('split_section') ){

  while( have_rows('split_section') ): the_row(); 

  $split_hide = get_sub_field('split_hide');
  $split_spacing = get_sub_field('split_spacing');
  $split_bg = get_sub_field('split_bg');
  $split_location = get_sub_field('split_location');
  $split_img = get_sub_field('split_img');
  $split_fit = get_sub_field('split_fit');
  $split_video = get_sub_field('split_video');
  $split_poster = get_sub_field('split_poster');
  $split_embed = get_sub_field('split_embed');
  $split_body = get_sub_field('split_body');

  if ($split_hide == false) {

  ?>

  <section class="split split--<?php echo esc_html($split_location['value']); ?> split--<?php echo esc_html($split_bg['value']); ?><?php if( $split_spacing ) { foreach( $split_spacing as $space ): ?> space-p-<?php echo $space; endforeach; } ?>">

    <div class="split__row">

      <?php if( $split_img || $split_video || $split_embed ) { ?>

        <div class="split__one">  

          <?php if ( $split_video ) { ?>

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

          <?php } elseif ( $split_embed ) { ?>

          <div class="split__media split__media--embed" >

            <?php echo $split_embed ?>

          </div>

          <?php } else { ?>

          <div class="split__media split__media--<?php echo esc_html($split_fit['value']); ?>" >

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

      <div class="<?php if( $split_img || $split_video || $split_embed ) { ?>split__two<?php } else { ?>split__body<?php } ?>">
        <?php echo $split_body ?>
      </div>

    </div>

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>