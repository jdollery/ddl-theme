<?php 

  $post = get_queried_object();
  setup_postdata( $post );

  $page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID() );
  $blog_description = esc_attr( get_post_meta( $page_id, 'title_description', true )); 

  $archive_title = get_the_archive_title(); 
  $archive_description = get_the_archive_description();

  $blog_title = get_the_title( get_option('page_for_posts', true) );

  $banner_alt_title = get_field('banner_alt_title');
  $banner_hide_img = get_field('banner_hide_img');
  $banner_hide_summary = get_field('banner_hide_summary');
  $banner_summary = get_field('banner_summary');

?>

<div class="banner<?php if ( is_front_page() ) { ?> banner--home<?php } ?>">

  <div class="banner__row<?php if ( is_front_page() ) { ?> banner__row--vh<?php } ?>">

    <div class="banner__column banner__column--body">

      <header class="banner__header">

        <?php if ( is_front_page() && is_home() ) { //home/blog ?>

          <h1 class="banner__title"><?php bloginfo( 'name' ); ?></h1>

          <?php if( bloginfo('description') ) { ?>
            <div class="banner__summary"><h4><?php bloginfo( 'description' ); ?></h4></div>
          <?php } ?>

        <?php } elseif ( is_front_page() ) { //static home ?>

          <?php if($banner_alt_title) { ?>
            <h1 class="banner__title"><?php echo $banner_alt_title ?></h1>
          <?php } else { ?>
            <h1 class="banner__title"><?php bloginfo( 'name' ); ?></h1>
          <?php } ?>

          <?php if( $banner_hide_summary == false ) { ?>

            <?php if($banner_summary) { ?>
              <div class="banner__summary"><?php echo $banner_summary ?></div>
            <?php } elseif( has_excerpt() ) { ?>
              <div class="banner__summary"><?php echo the_excerpt(); ?></div>
            <?php } elseif( bloginfo('description') ) { ?>
              <div class="banner__summary"><?php bloginfo( 'description' ); ?></div>
            <?php } ?>

          <?php } ?>

        <?php } elseif ( is_home() ) { //static blog ?>

          <?php $blog_title = get_the_title( get_option('page_for_posts', true) ); ?>

          <h1 class="banner__title"><?php echo $blog_title ?></h1>

          <?php get_template_part('inc/breadcrumb'); ?>

          <?php if( $banner_hide_summary == false ) { ?>

            <?php if($banner_summary) { ?>
              <div class="banner__summary"><?php echo $banner_summary ?></div>
            <?php } elseif( has_excerpt() ) { ?>
              <div class="banner__summary"><?php echo the_excerpt(); ?></div>
            <?php } ?>

          <?php } ?>

        <?php } elseif ( is_archive() ) { ?>

          <?php 
            $archive_title = get_the_archive_title(); 
            $archive_description = get_the_archive_description();
          ?>

          <h1 class="banner__title"><?php echo $archive_title; ?></h1>

          <?php get_template_part('inc/breadcrumb'); ?>

          <?php if($archive_description) { ?>
            <div class="banner__summary"><?php echo $archive_description ?></div>
          <?php } ?>

        <?php } elseif ( is_search() ) { ?>

          <h1 class="banner__title">Search results</h1>
          <h4><?php printf( esc_html__( 'You searched for: %s', 'ddl' ), '<span>' . get_search_query() . '</span>' );?></h4>

        <?php } elseif ( is_404() ) { ?>

          <h1 class="banner__title">Sorry, page not found.</h1>

        <?php } elseif ( is_singular( 'post' ) ) { ?>

          <?php $categories_list = preg_replace('/<a /', '<li><a ', get_the_category_list( ', ' )); ?>

          <h1 class="banner__title"><?php the_title(); ?></h1>

          <?php get_template_part('inc/breadcrumb'); ?>

          <div class="banner__meta">
            <ul class="banner__categories list--exempt"><?php echo $categories_list ?></ul>
            <time class="banner__date"><span class="icon icon--calendar"><svg role="img"><use xlink:href="#calendar" href="#calendar"></use></svg></span><?php echo get_the_date(); ?></time>
          </div>

          <?php if( $banner_hide_summary == false ) { ?>

            <?php if($banner_summary) { ?>
              <div class="banner__summary"><?php echo $banner_summary ?></div>
            <?php } elseif( has_excerpt() ) { ?>
              <div class="banner__summary"><?php echo the_excerpt(); ?></div>
            <?php } elseif( bloginfo('description') ) { ?>
              <div class="banner__summary"><?php bloginfo( 'description' ); ?></div>
            <?php } ?>

          <?php } ?>

        <?php } else { ?>

          <?php if($banner_alt_title) { ?>
            <h1 class="banner__title"><?php echo $banner_alt_title ?></h1>
          <?php } else { ?>
            <h1 class="banner__title"><?php the_title(); ?></h1>
          <?php } ?>

          <?php get_template_part('inc/breadcrumb'); ?>

          <?php if( $banner_hide_summary == false ) { ?>

            <?php if($banner_summary) { ?>
              <div class="banner__summary"><?php echo $banner_summary ?></div>
            <?php } elseif( has_excerpt() ) { ?>
              <div class="banner__summary"><?php echo the_excerpt(); ?></div>
            <?php } ?>

          <?php } ?>

        <?php } ?>

      </header>

    </div>

    <?php if ( is_front_page() ) {  //static home ?>

      <div class="banner__column banner__column--media" aria-hidden="true">

        <video playsinline autoplay loop muted poster="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-poster-lg.jpg">
          <source src="<?php echo get_template_directory_uri(); ?>/assets/video/placeholder-video.mp4" type="video/mp4">
          Sorry, your browser doesn’t support embedded videos.
        </video>

      </div>

    <?php 

    } elseif ( !is_404() && !is_search() && !is_archive() && $banner_hide_img == false ) { ?>

      <div class="banner__column banner__column--media">

        <?php if ( has_post_thumbnail() ) { 
          
          $media_id = get_post_thumbnail_id( $post->ID );
          $media_alt = get_post_meta($media_id, '_wp_attachment_image_alt', true);
          $media_title = get_the_title($media_id);

          $media_url_array_lg = wp_get_attachment_image_src($media_id, 'banner_lg', true);
          $media_url_array_sm = wp_get_attachment_image_src($media_id, 'banner_sm', true);

          $media_url_lg = $media_url_array_lg[0];
          $media_url_sm = $media_url_array_sm[0];
          
        ?>

          <picture>
            <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo $media_url_lg ?>">
            <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo $media_url_sm ?>">
            <img 
              class="banner__img"
              src="<?php echo $media_url_lg ?>"
              alt="<?php if($media_alt){ echo $media_alt; } else { the_title(); } ?>"
              width="1920" 
              height="1080"
              decoding="async"
            >
          </picture>

        <?php  } else { ?>

          <picture>
            <source type="image/jpg" media="(min-width: 480px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner-lg.jpg">
            <source type="image/jpg" media="(max-width: 479px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner-sm.jpg">
            <img 
              class="banner__img"
              src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner-lg.jpg"
              alt="Placeholder image"
              width="1920" 
              height="1080"
              decoding="async"
            >
          </picture>

        <?php } ?>

      </div>
    
    <?php } ?>

  </div>

</div>