<?php

if( have_rows('accordion_section') ){

  while( have_rows('accordion_section') ): the_row(); 

    $accordion_hide = get_sub_field('accordion_hide');
    $accordion_spacing = get_sub_field('accordion_spacing');
    $accordion_heading = get_sub_field('accordion_heading');
    $accordion_intro = get_sub_field('accordion_intro');
    $accordion_list = 'accordion_list';

    if ($accordion_hide == false) {

    ?>

    <section class="accordion<?php if( $accordion_spacing ) { foreach( $accordion_spacing as $space ): ?> accordion--<?php echo $space; endforeach; } ?>">

      <?php if ($accordion_heading) { ?>
      <div class="section__top">
        <h3 class="section__heading"><?php echo $accordion_heading ?></h3>
        <?php if ($accordion_intro) { ?> 
          <div class="section__lead">
            <?php echo $accordion_intro; ?>
          </div>
        <?php } ?>
      </div>
      <?php } ?>

      <div class="section__middle">

        <dl class="accordion__list">

          <?php 
          
          $i = 1;
          
          while( have_rows($accordion_list) ): the_row(); 
          
          ?>

          <dt class="accordion__item<?php if ($i == 1) { ?> accordion__item--open<?php } ?>" id="accordionItem" >
            <button class="accordion__toggle" id="accordion-title-<?php echo $i ?>" aria-expanded="<?php if ($i == 1) { ?>true<?php } else { ?>false<?php } ?>" aria-controls="accordion-description-<?php echo $i ?>">
              <span><?php echo the_sub_field('accordion_title'); ?></span>
              <span class="icon icon--chevron"><svg role="img"><use xlink:href="#chevron" href="#chevron"></use></svg></span>
            </button>
          </dt>  
          <dd class="accordion__description" id="accordion-description-<?php echo $i ?>" aria-labelledby="accordion-title-<?php echo $i ?>" style="<?php if ($i == 1) { ?>display: block;<?php } else { ?>display: none;<?php } ?>">        
            <div class="accordion__content">
              <?php echo the_sub_field('accordion_description'); ?>
            </div>
          </dd>

          <?php 

          $i++; 
        
          endwhile; wp_reset_postdata() ?>

        </dl>

      </div>

    </section>

    <?php

    }

  endwhile; wp_reset_postdata();  

  } 

?>