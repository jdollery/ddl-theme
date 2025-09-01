<?php

  if( have_rows('quicklinks_section') ){

  while( have_rows('quicklinks_section') ): the_row(); 

  $quicklinks_hide = get_sub_field('quicklinks_hide');
  $quicklinks_spacing = get_sub_field('quicklinks_spacing');
  $quicklinks_bg = get_sub_field('quicklinks_bg');
  $quicklinks_heading = get_sub_field('quicklinks_heading');
  $quicklinks_standfirst = get_sub_field('quicklinks_standfirst');
  $quicklinks_object = get_sub_field('quicklinks_object');
  $quicklinks_btn = get_sub_field('quicklinks_btn');

  if ($quicklinks_hide == false) {

  ?>

  <section class="content content--quicklinks content--<?php echo esc_html($quicklinks_bg['value']); ?><?php if( $quicklinks_spacing ) { foreach( $quicklinks_spacing as $space ): ?> content--<?php echo $space; endforeach; } ?>">

    <div class="content__fixed">

      <?php if($quicklinks_heading) { ?>
          
        <div class="content__heading">
          <h2><?php echo $quicklinks_heading ?></h2>
          <?php if($quicklinks_standfirst) { echo $quicklinks_standfirst; } ?>
        </div>

      <?php } ?>

      <?php if ($quicklinks_object) { ?>

        <?php $count = count($quicklinks_object); ?>

        <ul class="loop loop--<?php echo $count ?> list--exempt">

          <?php 
          
          foreach( $quicklinks_object as $post ): 

          setup_postdata($post); 
          
          ?>

            <li class="loop__item">
              <?php get_template_part('includes/post'); ?>
            </li>

          <?php 
        
          endforeach; 
          
          ?>

        </ul>

        <?php wp_reset_postdata(); ?>

      <?php } ?>

    </div>

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>