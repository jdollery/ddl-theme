<?php 

$post = get_queried_object();
setup_postdata( $post );

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$thumb_title = get_the_title($thumb_id);
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

$page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID() );
$blog_description = esc_attr( get_post_meta( $page_id, 'title_description', true )); 

$archive_title = get_the_archive_title(); 
$archive_description = get_the_archive_description();

$blog_title = get_the_title( get_option('page_for_posts', true) );

$banner_alt = get_field('banner_alt');
$banner_intro = get_field('banner_intro');
$banner_position = get_field('banner_position');

?>

<div class="banner<?php if ( is_front_page() && is_home() || is_front_page() ) { ?> banner--home<?php } ?>">

  <?php  if ( has_post_thumbnail() ) { ?>
    <img class="banner__img banner__img--<?php echo esc_html($banner_position['value']); ?>" src="<?php echo $thumb_url ?>" alt="<?php echo $thumb_alt ?>" loading="lazy" width="1920" height="1080">
  <?php } ?>

  <div class="cell-fluid">
    <div class="cell-row<?php if ( is_front_page() ) { ?> cell-justify-end<?php } ?>">
      <div class="<?php if ( is_front_page() ) { ?>banner__outer<?php } elseif ( has_post_thumbnail() ) { ?>cell cell-span-5<?php } else {?>cell cell-span-12<?php } ?>">

        <div class="banner__inner<?php if ( has_post_thumbnail() ) { ?> banner__inner--img<?php } ?>">

          <?php if ( is_front_page() && is_home() ) { ?>

            <div class="banner__top">
              <h1 class="banner__title"><?php bloginfo( 'name' ); ?></h1>
            </div>

            <?php if( bloginfo('description') ) { ?>
            <div class="banner__bottom">
              <div class="banner__intro"><?php bloginfo( 'description' ); ?></div>
            </div>
            <?php } ?>

          <?php } elseif ( is_front_page() ) { //static home ?>

            <div class="banner__top">
              <?php if($banner_alt) { ?>
              <h1 class="banner__title"><?php echo $banner_alt ?></h1>
              <?php } else { ?>
              <h1 class="banner__title"><?php bloginfo( 'name' ); ?></h1>
              <?php } ?>
            </div>

            <div class="banner__bottom">
              <?php if($banner_intro) { ?>
              <img class="banner__logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-plain.svg" alt="<?php bloginfo( 'name' ); ?>">
              <div class="banner__intro"><?php echo $banner_intro ?></div>
              <?php } ?>
              <a class="button button--white" href="<?php echo site_url() ?>/nhs-treatment/">NHS Treatment</a>
              <a class="button button--white" href="<?php echo site_url() ?>/private-treatment/">Private Treatment</a>
            </div>

          <?php } elseif ( is_home() ) { //static blog ?>

            <?php $blogTitle = get_the_title( get_option('page_for_posts', true) ); ?>

            <div class="banner__top">
              <h1 class="banner__title"><?php echo $blogTitle ?></h1>
              <?php get_template_part('inc/breadcrumb'); ?>
            </div>

            <?php if($banner_intro) { ?>
            <div class="banner__bottom">
              <div class="banner__intro"><?php echo $banner_intro ?></div>
            </div>
            <?php } ?>

          <?php } elseif ( is_post_type_archive('referrals') ) { ?>

            <div class="banner__top">
              <h1 class="banner__title"><?php echo get_the_archive_title() ?></h1>
              <?php get_template_part('inc/breadcrumb'); ?>
            </div>
            
            <?php if ( get_field('referral_archive_intro', 'option') ) { ?>
              <div class="banner__bottom">
                <div class="banner__intro"><?php echo get_field('referral_archive_intro', 'option'); ?></div>
              </div>
            <?php } ?>

          <?php } elseif ( is_post_type_archive('locations') ) { ?>

            <div class="banner__top">
              <h1 class="banner__title"><?php echo get_the_archive_title() ?></h1>
              <?php get_template_part('inc/breadcrumb'); ?>
            </div>

            <?php if ( get_field('location_archive_intro', 'option') ) { ?>
              <div class="banner__bottom">
                <div class="banner__intro"><?php echo get_field('location_archive_intro', 'option'); ?></div>
              </div>
            <?php } ?>

            <?php } elseif ( is_post_type_archive('treatments') ) { ?>

              <div class="banner__top">
                <h1 class="banner__title"><?php echo get_the_archive_title() ?></h1>
                <?php get_template_part('inc/breadcrumb'); ?>
              </div>

              <?php if ( get_field('treatment_archive_intro', 'option') ) { ?>
                <div class="banner__bottom">
                  <div class="banner__intro"><?php echo get_field('treatment_archive_intro', 'option'); ?></div>
                </div>
              <?php } ?>

          <?php } elseif ( is_archive() ) { ?>

            <?php 
              $archiveTitle = get_the_archive_title(); 
              $archiveDescription = get_the_archive_description();
            ?>

            <div class="banner__top">
              <h1 class="banner__title"><?php echo $archiveTitle; ?></h1>
              <?php get_template_part('inc/breadcrumb'); ?>
            </div>

            <?php if ( $archiveDescription ) { ?>

            <div class="banner__bottom">
              <div class="banner__intro"><?php echo $archiveDescription ?></div>
            </div>

            <?php } ?>

          <?php } elseif ( is_search() ) { ?>

            <div class="banner__top">
              <h1 class="banner__title">Search results</h1>
            </div>

            <div class="banner__bottom">
              <div class="banner__intro"><?php printf( esc_html__( 'You searched for: %s', 'ddl' ), '<span>' . get_search_query() . '</span>' );?></div>
            </div>

          <?php } elseif ( is_404() ) { ?>

            <div class="banner__top">
              <h1 class="banner__title">Sorry, page not found.</h1>
            </div>

          <?php } elseif ( is_singular( 'post' ) ) { ?>

            <div class="banner__top">
              <h1 class="banner__title"><?php the_title(); ?></h1>
              <?php get_template_part('inc/breadcrumb'); ?>
            </div>

            <div class="banner__bottom">
              <ul class="banner__meta">
                <li class="banner__categories"><?php echo get_the_category_list(); ?></li>
                <li class="banner__date"><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></li>
              </ul>
            </div>

          <?php } else { ?>

            <div class="banner__top">

              <?php if($banner_alt) { ?>
              <h1 class="banner__title"><?php echo $banner_alt ?></h1>
              <?php } else { ?>
              <h1 class="banner__title"><?php the_title(); ?></h1>
              <?php } ?>
              <?php get_template_part('inc/breadcrumb'); ?>
            </div>

            <?php if($banner_intro) { ?>
            <div class="banner__bottom">
              <div class="banner__intro"><?php echo $banner_intro ?></div>
            </div>
            <?php } ?>

          <?php } ?>

        </div>

      </div>
    </div>
  </div>

</div>