<?php

  if( have_rows('quicklinks_section') ){

  while( have_rows('quicklinks_section') ): the_row(); 

  $quicklinks_hide = get_sub_field('quicklinks_hide');
  $quicklinks_spacing = get_sub_field('quicklinks_spacing');
  $quicklinks_object = get_sub_field('quicklinks_object');

  if ($quicklinks_hide == false) {

  ?>

  <section class="quicklinks<?php if( $quicklinks_spacing ) { foreach( $quicklinks_spacing as $space ): ?> space-p-<?php echo $space; endforeach; } ?>">

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

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>