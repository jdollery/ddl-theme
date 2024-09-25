<section class="team">
  <div class="team__inner">

  <?php 

  $custom_terms = get_terms('team_categories');

  foreach($custom_terms as $custom_term) {

    wp_reset_query();

    $args = array(
      'post_type' => 'team',
      'order'  => 'ASC',
      'orderby' => 'menu_order',
      'tax_query' => array(
        array(
          'taxonomy' => 'team_categories',
          'field' => 'slug',
          'terms' => $custom_term->slug,
        ),
      ),
    );

    $loop = new WP_Query($args);

    if($loop->have_posts()) {

    ?>

    <h3 class="team__heading"><?php echo $custom_term->name ?></h3>

    <ul class="team__list list--exempt">

      <?php

      while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <li class="member">

          <?php

          $thumb_id = get_post_thumbnail_id( $post->ID );
          $thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
          $thumb_title = get_the_title($thumb_id);
          $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
          $thumb_url = $thumb_url_array[0];

          $member_job = get_field('member_job');
          $member_gdc = get_field('member_gdc'); 
          $member_creds = get_field('member_creds');

          global $post;
          $member_id = $post->post_name;

          ?>

          <div class="member__body">
            <div class="member__row">
              <div class="member__one">
                <figure class="member__media" data-open="<?php echo $member_id ; ?>" >

                  <?php if ( has_post_thumbnail() ) {
                
                    $portrait_id = get_post_thumbnail_id( $post->ID );
                    $portrait_alt = get_post_meta($portrait_id, '_wp_attachment_image_alt', true);
                    $portrait_title = get_the_title($portrait_id);

                    $portrait_url_array_lg = wp_get_attachment_image_src($portrait_id, 'member_lg', true);
                    $portrait_url_array_sm = wp_get_attachment_image_src($portrait_id, 'member_sm', true);

                    $portrait_url_lg = $portrait_url_array_lg[0];
                    $portrait_url_sm = $portrait_url_array_sm[0];
                  
                  ?>

                    <picture>
                      <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo $portrait_url_lg ?>">
                      <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo $portrait_url_sm ?>">
                      <img 
                        class="member__img"
                        src="<?php echo $portrait_url_lg ?>"
                        alt="<?php if($portrait_alt){ echo $portrait_alt; } else { the_title(); } ?>"
                        width="900"
                        height="750"
                        loading="lazy"
                        decoding="async"
                      >
                    </picture>

                  <?php } else { ?>

                    <picture>
                      <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-female-lg.jpg">
                      <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-female-sm.jpg">
                      <img 
                        class="member__img"
                        src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-female-lg.jpg"
                        alt="Placeholder image"
                        width="900"
                        height="750"
                        loading="lazy"
                        decoding="async"
                      >
                    </picture>

                  <?php } ?>

                </figure>
              </div>
              <div class="member__two">
                <h3 class="member__heading"><?php the_title(); ?></h3>
                <?php if ( $member_job ) { ?>
                  <p class="member__job"><?php echo $member_job ?></p>
                <?php } ?>
                <?php if ( $member_gdc ) { ?>
                  <p class="member__gdc">GDC: <a href="https://olr.gdc-uk.org/SearchRegister/SearchResult?RegistrationNumber=<?php echo $member_gdc ?>" target="_blank"><?php echo $member_gdc ?></a></p>
                <?php } ?>
              </div>
            </div>
            <?php if( get_the_content() ) { ?>
            <div class="member__footer">
              <button class="btn btn--blue w-100" data-open="<?php echo $member_id ; ?>" aria-pressed="false" aria-expanded="false" aria-controls="<?php echo $member_id ; ?>">Read Biography</button>
            </div>
            <?php } ?>
            <?php edit_post_link( __( 'Edit', 'textdomain' ), null, null, null, 'member__edit' ); ?>
          </div>

          <div class="slideout" id="<?php echo $member_id ; ?>" data-sideout="<?php echo $member_id ; ?>">
            <div class="slideout__backdrop" data-close="<?php echo $member_id ; ?>">&nbsp;</div>
            <div class="slideout__row">
              <div class="slideout__body">
                <button class="slideout__close" data-close="<?php echo $member_id ; ?>"><span class="hidden">Close</span></button>
                <div class="slideout__content">
                  <figure class="slideout__media">

                    <?php if ( has_post_thumbnail() ) { ?>

                      <picture>
                        <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo $portrait_url_lg ?>">
                        <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo $portrait_url_sm ?>">
                        <img 
                          class="slideout__img"
                          src="<?php echo $portrait_url_lg ?>"
                          alt="<?php if($portrait_alt){ echo $portrait_alt; } else { the_title(); } ?>"
                          width="900"
                          height="750"
                          loading="lazy"
                          decoding="async"
                        >
                      </picture>

                    <?php } else { ?>

                      <picture>
                        <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-female-lg.jpg">
                        <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-female-sm.jpg">
                        <img 
                          class="slideout__img"
                          src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-female-lg.jpg"
                          alt="Placeholder image"
                          width="900"
                          height="750"
                          loading="lazy"
                          decoding="async"
                        >
                      </picture>

                    <?php } ?>

                  </figure>
                  <h3 class="slideout__heading"><?php the_title(); ?></h3>
                  <div class="slideout__meta">
                    <?php if ( $member_job ) { ?>
                      <p class="slideout__job"><?php echo $member_job ?></p>
                    <?php } ?>
                    <?php if ( $member_creds ) { ?>
                      <div class="slideout__creds"><?php echo $member_creds ?></div>
                    <?php } ?>
                    <?php if ( $member_gdc ) { ?>
                      <p class="slideout__gdc">GDC Number: <a href="https://olr.gdc-uk.org/SearchRegister/SearchResult?RegistrationNumber=<?php echo $member_gdc ?>" target="_blank"><?php echo $member_gdc ?></a></p>
                    <?php } ?>
                  </div>
                  <div class="slideout__profile"><?php the_content(); ?></div>
                  <button class="btn btn--blue btn--space w-100 btn--sm" data-close="<?php echo $member_id ; ?>">Close profile</button>
                </div>
              </div>
            </div>
          </div>

        </li>

      <?php 

      endwhile; wp_reset_query(); 
      
      ?>

    </ul>  
    
    <?php 
      
      }

    } 
    
    ?>

  </div>
</section>