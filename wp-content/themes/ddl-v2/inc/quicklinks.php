<?php

  if( have_rows('quicklinks_section') ){

  while( have_rows('quicklinks_section') ): the_row(); 

  $quicklinks_hide = get_sub_field('quicklinks_hide');
  $quicklinks_spacing = get_sub_field('quicklinks_spacing');
  $quicklinks_heading = get_sub_field('quicklinks_heading');
  $quicklinks_summary = get_sub_field('quicklinks_summary');
  $quicklinks_object = get_sub_field('quicklinks_object');
  $quicklinks_btn_link = get_sub_field('quicklinks_btn_link');
  $quicklinks_btn_text = get_sub_field('quicklinks_btn_text');
  $quicklinks_btn_destination = get_sub_field('quicklinks_btn_destination');

  if ($quicklinks_hide == false) {

  ?>

  <section class="quicklinks<?php if( $quicklinks_spacing ) { foreach( $quicklinks_spacing as $space ): ?> space-p-<?php echo $space; endforeach; } ?>">

    <?php if($quicklinks_heading) { ?>
    <div class="space-p-b">
      <h2><?php echo $quicklinks_heading ?></h2>
      <?php if($quicklinks_heading) { ?>
      <div class="mt-11">
        <?php echo $quicklinks_summary ?>
      </div>
      <?php } ?>
    </div>
    <?php } ?>

    <div>

      <ul class="loop">

        <?php 
        
        foreach( $quicklinks_object as $post ): 

        setup_postdata($post); 

        $quicklink_alt_title = get_field('quicklink_alt_title');
        $quicklink_alt_img = get_field('quicklink_alt_img');
        $quicklink_btn_text = get_field('quicklink_btn_text');
        
        ?>

          <li class="loop__item">
            <?php get_template_part('inc/post'); ?>
          </li>

        <?php 
      
        endforeach; 
        
        ?>

      </ul>

      <?php wp_reset_postdata(); ?>

    </div>

    <?php if($quicklinks_btn_link) { ?>
    <div class="space-p-t">
      <a class="btn btn--black" href="<?php echo $quicklinks_btn_link; ?>"<?php if( in_array ('external', $quicklinks_btn_destination) ) { ?>target="_blank" rel="noopener noreferrer"<?php } ?>><?php echo $quicklinks_btn_text; ?></a>
    </div>
    <?php } ?>

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>