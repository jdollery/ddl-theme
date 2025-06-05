<?php 

$args = array(
  'post_type' => 'fees',
  'order'  => 'DESC',
  'orderby' => 'menu_order',
  'posts_per_page' => 100,
);

$loop = new WP_Query($args);

if($loop->have_posts()) { ?>

    <section class="content content--black content--top content--bottom">
      <div class="content__fixed">

        <dl class="accordion">

          <?php 

          $i = 1;
          
          while ( $loop->have_posts() ) : $loop->the_post(); 
          
          ?>

            <dt class="accordion__item<?php if ($i == 1) { ?> accordion__item--open<?php } ?>" id="accordionItem" >
              <button class="accordion__toggle" id="accordion-title-<?php echo $i ?>" aria-expanded="<?php if ($i == 1) { ?>true<?php } else { ?>false<?php } ?>" aria-controls="accordion-description-<?php echo $i ?>">
                <span><?php the_title(); ?></span>
                <span class="accordion__icon"></span>
              </button>
            </dt>

            <dd class="accordion__description" id="accordion-description-<?php echo $i ?>" aria-labelledby="accordion-title-<?php echo $i ?>" style="<?php if ($i == 1) { ?>display: block;<?php } else { ?>display: none;<?php } ?>">        
              <div class="accordion__content">

                <table class="table-responsive ">
                  <thead>
                    <tr>
                      <th>Treatment</th>
                      <th>Fee</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                    
                    while( have_rows('fees_table') ): the_row(); 

                    $fees_treatment = get_sub_field('fees_treatment');
                    $fees_price = get_sub_field('fees_price');
                    
                    ?>

                    <tr>
                      <td data-title=""><?php echo $fees_treatment ?></td>
                      <td data-title="Fee"><?php echo $fees_price ?></td>
                    </tr>

                    <?php endwhile; wp_reset_postdata() ?>

                  </tbody>
                </table>

              </div>
            </dd>

            <?php 

            $i++; 

            endwhile; wp_reset_postdata()
            
            ?>

        </dl>
        
      </div>
    </section>

  <?php } ?>