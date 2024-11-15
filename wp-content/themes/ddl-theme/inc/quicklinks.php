<?php

  if( have_rows('quicklinks_section') ){

  while( have_rows('quicklinks_section') ): the_row(); 

  $quicklinks_hide = get_sub_field('quicklinks_hide');
  $quicklinks_spacing = get_sub_field('quicklinks_spacing');
  $quicklinks_bg = get_sub_field('quicklinks_bg');
  $quicklinks_heading = get_sub_field('quicklinks_heading');
  $quicklinks_intro = get_sub_field('quicklinks_intro');
  $quicklinks_object = get_sub_field('quicklinks_object');
  $quicklinks_btn = get_sub_field('quicklinks_btn');

  if ($quicklinks_hide == false) {

  ?>

  <section class="quicklinks quicklinks--<?php echo esc_html($quicklinks_bg['value']); ?><?php if( $quicklinks_spacing ) { foreach( $quicklinks_spacing as $space ): ?> quicklinks--<?php echo $space; endforeach; } ?>">

    <?php if($quicklinks_heading) { ?>
    <div class="section__top">
      <h3 class="section__heading"><?php echo $quicklinks_heading ?></h3>
      <?php if($quicklinks_intro) { ?>
        <div class="section__lead"><?php echo $quicklinks_intro; ?>
      </div><?php } ?>
    </div>
    <?php } ?>

    <div class="section__middle">

      <ul class="quicklinks__list list--exempt">

        <?php 
        
        foreach( $quicklinks_object as $post ): 

        setup_postdata($post); 
        
        ?>

          <li class="quicklinks__item">
            <?php get_template_part('inc/post'); ?>
          </li>

        <?php 
      
        endforeach; 
        
        ?>

      </ul>

      <?php wp_reset_postdata(); ?>

    </div>

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>