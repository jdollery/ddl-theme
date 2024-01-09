<?php

if( have_rows('sticky_section') ){

  while( have_rows('sticky_section') ): the_row(); 

  $sticky_hide = get_sub_field('sticky_hide');
  $sticky_bg = get_sub_field('sticky_bg');
  $sticky_location = get_sub_field('sticky_location');
  $sticky_spacing = get_sub_field('sticky_spacing');
  $sticky_img = get_sub_field('sticky_img');
  $sticky_fit = get_sub_field('sticky_fit');
  $sticky_video = get_sub_field('sticky_video');
  $sticky_poster = get_sub_field('sticky_poster');
  $sticky_embed = get_sub_field('sticky_embed');
  $sticky_body = get_sub_field('sticky_body');

  if ($sticky_hide == false) {

  ?>

  <section class="sticky sticky--<?php echo esc_html($sticky_location['value']); ?> sticky--<?php echo esc_html($sticky_bg['value']); ?><?php if($sticky_spacing && in_array('top', $sticky_spacing)) { ?> space-p-t<?php } ?><?php if($sticky_spacing && in_array('bottom', $sticky_spacing)) { ?> space-p-b<?php } ?>">

    <div class="sticky__row">

      <?php if( $sticky_img || $sticky_video || $sticky_embed ) { ?>

        <div class="sticky__one" >  
          <div class="sticky__media sticky__media--<?php echo esc_html($sticky_fit['value']); ?>" >

            <?php if($sticky_video) { ?>
              <img id="videoToggle" src="<?php echo $sticky_poster ?>" alt="<?php the_sub_field('title'); ?>" data-url="<?php echo $sticky_video ?>">
            <?php } elseif($sticky_embed) { ?>
              <?php echo $sticky_embed ?>
            <?php } else { ?>
              <img src="<?php echo esc_url($sticky_img['url']); ?>" alt="<?php echo $sticky_img['alt']; ?>" loading="lazy" width="900" height="750">
            <?php } ?>
          
          </div>
        </div>

      <?php } ?>

      <div class="<?php if( $sticky_img || $sticky_video || $sticky_embed ) { ?>sticky__two<?php } else { ?>sticky__body<?php } ?>">
        <?php echo $sticky_body ?>
      </div>

    </div>

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>