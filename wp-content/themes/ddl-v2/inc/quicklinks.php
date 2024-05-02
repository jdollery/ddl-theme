<?php

  if( have_rows('quicklinks_section') ){

  while( have_rows('quicklinks_section') ): the_row(); 

  $quicklinks_hide = get_sub_field('quicklinks_hide');
  $quicklinks_spacing = get_sub_field('quicklinks_spacing');
  $quicklinks_bg = get_sub_field('quicklinks_bg');
  $quicklinks_heading = get_sub_field('quicklinks_heading');
  $quicklinks_summary = get_sub_field('quicklinks_summary');
  $quicklinks_object = get_sub_field('quicklinks_object');
  $quicklinks_btn = get_sub_field('quicklinks_btn');

  if ($quicklinks_hide == false) {

  ?>

  <section class="quicklinks quicklinks--<?php echo esc_html($quicklinks_bg['value']); ?><?php if( $quicklinks_spacing ) { foreach( $quicklinks_spacing as $space ): ?> quicklinks--<?php echo $space; endforeach; } ?>">

    <?php if($quicklinks_heading) { ?>
    <div class="quicklinks__top">
      <h2><?php echo $quicklinks_heading ?></h2>
      <?php if($quicklinks_heading) { 
        echo $quicklinks_summary;
      } ?>
      <?php if($quicklinks_btn) { ?>

        <?php 
          $quicklinks_btn_url = $quicklinks_btn['url'];
          $quicklinks_btn_text = $quicklinks_btn['title'];
          $quicklinks_btn_target = $quicklinks_btn['target'] ? $quicklinks_btn['target'] : '_self';
        ?>

        <a class="btn btn--space" href="<?php echo esc_url( $quicklinks_btn_url ); ?>" target="<?php echo esc_attr( $quicklinks_btn_target ); ?>">
          <?php echo esc_html( $quicklinks_btn_text ); ?>
        </a>

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

  </section>

  <?php

  }

  endwhile; wp_reset_postdata();  

} 

?>