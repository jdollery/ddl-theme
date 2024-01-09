<?php

if( have_rows('accordion_section') ){

  while( have_rows('accordion_section') ): the_row(); 

    $accordion_hide = get_sub_field('accordion_hide');
    $accordion_spacing = get_sub_field('accordion_spacing');
    $accordion_heading = get_sub_field('accordion_heading');
    $accordion_list = 'accordion_list';

    if ($accordion_hide == false) {

    ?>

    <section class="accordion<?php if( $accordion_spacing ) { foreach( $accordion_spacing as $space ): ?> space-p-<?php echo $space; endforeach; } ?>">

      <div class="accordion__row">
        <?php if ($accordion_heading) { ?>
        <h3 class="accordion__heading"><?php echo $accordion_heading ?></h3>
        <?php } ?>
        <div class="accordion__body">

          <dl class="accordion__list">

            <?php while( have_rows($accordion_list) ): the_row(); ?>
            <div class="accordion__item" id="dropItem">
              <dt class="accordion__term">
                <button class="accordion__title">
                  <span><?php echo the_sub_field('accordion_title'); ?></span>
                  <span class="icon icon--arrow"><svg role="img"><use xlink:href="#arrow" href="#arrow"></use></svg></span>
                </button>
              </dt>
              <dd class="accordion__desc" id="dropDesc">
                <?php echo the_sub_field('accordion_description'); ?>
              </dd>
            </div>
            <?php endwhile; wp_reset_postdata() ?>

          </dl>
              
        </div>
      </div>
    </section>

    <?php

    }

  endwhile; wp_reset_postdata();  

  } 

?>