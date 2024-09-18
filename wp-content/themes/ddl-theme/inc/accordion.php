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

      <div class="accordion__top">

        <?php if ($accordion_heading) { ?>
        <h3 class="accordion__heading"><?php echo $accordion_heading ?></h3>
        <?php if($accordion_intro) { echo $accordion_intro; } ?>
        <?php } ?>

      </div>
        
      <div class="accordion__middle">

        <dl class="accordion__list">

          <?php 
          
          $i = 1;
          
          while( have_rows($accordion_list) ): the_row(); 
          
          ?>

          <span class="accordion__item" id="dropItem" >
            <dt class="accordion__term">
              <button class="accordion__title" id="title-<?php echo $i ?>" aria-expanded="false" aria-controls="description-<?php echo $i ?>">
                <span><?php echo the_sub_field('accordion_title'); ?></span>
                <span class="icon icon--arrow"><svg role="img"><use xlink:href="#arrow" href="#arrow"></use></svg></span>
              </button>
            </dt>
            <dd class="accordion__desc" id="description-<?php echo $i ?>" aria-labelledby="title-<?php echo $i ?>" >
              <?php echo the_sub_field('accordion_description'); ?>
            </dd>
          </span>

          <?php 

          $i++;

          endwhile; wp_reset_postdata() 
          
          ?>

        </dl>
            
      </div>

    </section>

    <?php

    }

  endwhile; wp_reset_postdata();  

  } 

?>