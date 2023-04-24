<section class="team">
  <div class="team__row">

    <?php
    
    $loop = new WP_Query( array(
      'post_type' => 'team', 
      'posts_per_page' => '100',
      'order'  => 'ASC', 
      'orderby' => 'menu_order',
    ) );

    while ( $loop->have_posts() ) : $loop->the_post(); ?>

      <article class="member">

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
          <div class="cell-row cell-row-gutter">
            <div class="cell cell-gutter span-12 pb-6 pb-sm-9">
              <picture class="member__media" <?php if( get_the_content() ) { ?>data-open="<?php echo $member_id ?><?php } ?>" >
                <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo $thumb_url ?>" alt="<?php echo $thumb_alt ?>">
                <?php } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-profile.jpg" alt="<?php the_title(); ?>">
                <?php } ?>
              </picture>
            </div>
            <div class="cell cell-gutter span-12 pb-6 pb-sm-9">
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
          <div class="cell-row cell-justify-center">
            <span class="btn btn--accent w-100" data-open="<?php echo $member_id ; ?>" >Read profile</span>
            <?php edit_post_link( __( 'Edit', 'textdomain' ), null, null, null, 'member__edit' ); ?>
          </div>
          <?php } ?>
        </div>

        <div class="slideout" data-sideout="<?php echo $member_id ; ?>">
          <div class="slideout__backdrop" data-close="<?php echo $member_id ; ?>">&nbsp;</div>
          <div class="slideout__row">
            <div class="slideout__body">
              <!-- <button class="slideout__close" data-close="<?php echo $member_id ; ?>"><span class="icon icon--close"><svg role="img"><use xlink:href="#close" href="#close"></use></svg></span></button> -->
              <div class="slideout__content">
              <div class="slideout__media" data-open="<?php echo $member_id ; ?>">
                <?php if ( has_post_thumbnail() ) { ?>
                  <img class="slideout__img" src="<?php echo $thumb_url ?>" alt="<?php echo $thumb_alt ?>">
                <?php } else { ?>
                  <img class="slideout__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-profile.jpg" alt="<?php echo get_the_title(); ?>">
                <?php } ?>
                </div>
                <h3 class="slideout__heading"><?php the_title(); ?></h3>
                <div class="slideout__meta">
                  <?php if ( $member_job ) { ?>
                    <h4 class="slideout__job"><?php echo $member_job ?></h4>
                  <?php } ?>
                  <?php if ( $member_creds ) { ?>
                    <div class="slideout__creds"><?php echo $member_creds ?></div>
                  <?php } ?>
                  <?php if ( $member_gdc ) { ?>
                    <p class="slideout__gdc">GDC Number: <a href="https://olr.gdc-uk.org/SearchRegister/SearchResult?RegistrationNumber=<?php echo $member_gdc ?>" target="_blank"><?php echo $member_gdc ?></a></p>
                  <?php } ?>
                </div>
                <div class="slideout__profile"><?php the_content(); ?></div>
                <button class="btn btn--accent btn--block w-100" data-close="<?php echo $member_id ; ?>">Close profile</button>
              </div>
            </div>
          </div>
        </div>

      </article>

    <?php 

    endwhile; wp_reset_query(); 
    
    ?>
    
  </div>
</section>