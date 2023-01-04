<?php

if( have_rows('split_section') ){

while( have_rows('split_section') ): the_row(); 

$split_location = get_sub_field('split_location');
$split_img = get_sub_field('split_img');
$split_video = get_sub_field('split_video');
$split_poster = get_sub_field('split_poster');
$split_text = get_sub_field('split_text');

?>

<section class="split split--<?php echo esc_html($split_location['value']); ?>">

  <div class="split__row">

    <!-- <div class="split__one" data-sticky-container>   -->
    <div class="split__one">
      <!-- <div class="split__media" data-sticky data-margin-top="200" data-sticky-class="is-sticky"> -->
      <div class="split__media">

      <?php if($split_video) { ?>
        <video src="<?php echo $split_video ?>" controls type="video/mp4" poster="<?php echo $split_poster ?>"> 
          Sorry, your browser doesn’t support embedded videos.
        </video>
      <?php } else { ?>
        <img src="<?php echo esc_url($split_img['url']); ?>" alt="<?php echo $split_img['alt']; ?>" loading="lazy" width="900" height="750">
      <?php } ?>
      
      </div>
    </div>

    <div class="split__two wow <?php if($split_location['value'] == 'left') { ?>fadeInRight<?php } elseif($split_location['value'] == 'right') {?>fadeInLeft<?php } ?>" data-wow-duration="1s" data-wow-delay="0.5s">
      <?php echo $split_text ?>
    </div>

  </div>

</section>

<?php

endwhile; wp_reset_postdata();  

}

?>