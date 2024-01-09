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
$banner_btn = 'banner_btn';

$treatment_archive_alt = get_field('treatment_archive_alt', 'option');
$treatment_archive_intro = get_field('treatment_archive_intro', 'option');
$treatment_archive_btn = 'treatment_archive_btn';

?>

<div class="banner<?php if ( is_front_page() ) { ?> banner--home<?php } ?>">

  <?php  if ( is_front_page() ) {  //static home ?>

    <video playsinline autoplay loop muted poster="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-poster.jpg">
      <source src="<?php echo get_template_directory_uri(); ?>/assets/video/placeholder-video-compressed.mp4" type="video/mp4">
      Sorry, your browser doesn’t support embedded videos.
    </video>

  <?php } elseif ( has_post_thumbnail() ) { ?>

    <img 
      class="banner__img"
      src="<?php echo $thumb_url ?>"
      alt="<?php echo $thumb_alt ?>" 
      width="1920" 
      height="1080"
      loading="lazy"
      decoding="async"
    >

  <?php // } else { ?>

    <!-- <img 
      class="banner__img"
      src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-banner.jpg"
      alt="<?php echo get_bloginfo( 'name' ) ?>"
      width="1920" 
      height="1080"
      loading="lazy"
      decoding="async"
    > -->

  <?php } ?>

  <div class="space-p">
    <div class="cell-row">
      <div class="cell-6">

        <?php if ( is_front_page() && is_home() ) { //home/blog ?>

          <h1 class="banner__title"><?php bloginfo( 'name' ); ?></h1>

          <?php if( bloginfo('description') ) { ?>
            <h4 class="banner__intro"><?php bloginfo( 'description' ); ?></h4>
          <?php } ?>

        <?php } elseif ( is_front_page() ) { //static home ?>

          <h1 class="banner__title"><?php bloginfo( 'name' ); ?></h1>

          <?php if( bloginfo('description') ) { ?>
            <h4 class="banner__intro"><?php bloginfo( 'description' ); ?></h4>
          <?php } ?>

        <?php } elseif ( is_front_page() ) { //static blog ?>

          <?php $blogTitle = get_the_title( get_option('page_for_posts', true) ); ?>

          <h1 class="banner__title"><?php echo $blogTitle ?></h1>
          <?php get_template_part('inc/breadcrumb'); ?>

          <?php if($banner_intro) { ?>
            <h4 class="banner__intro"><?php echo $banner_intro ?></h4>
          <?php } ?>

        <?php } elseif ( is_post_type_archive('treatments') ) { //treatment archive ?>

          <h1 class="banner__title"><?php echo get_the_archive_title() ?></h1>

          <?php get_template_part('inc/breadcrumb'); ?>

          <?php if ( $treatment_archive_intro ) { ?>
            <h4 class="banner__intro"><?php echo get_field('treatment_archive_intro', 'option'); ?></h4>
          <?php } ?>

          <?php if( have_rows($treatment_archive_btn, 'option') ) { 

            while( have_rows($treatment_archive_btn, 'option') ): the_row(); 

            $treatment_archive_btn_link = get_sub_field('treatment_archive_btn_link');
            $treatment_archive_btn_txt = get_sub_field('treatment_archive_btn_txt');
            $treatment_archive_btn_color = get_sub_field('treatment_archive_btn_color');
            $treatment_archive_btn_destination = get_sub_field('treatment_archive_btn_destination');

            ?>

            <a class="btn btn--<?php echo esc_html($treatment_archive_btn_color['value']); ?> btn--inline" href="<?php echo $treatment_archive_btn_link; ?>"<?php if( in_array ('external', $treatment_archive_btn_destination) ) { ?>target="_blank" rel="noopener noreferrer"<?php } ?>><?php echo $treatment_archive_btn_txt; ?></a>

            <?php endwhile; wp_reset_query();  ?>

          <?php } ?>

        <?php } elseif ( is_archive() ) { ?>

          <?php 
            $archiveTitle = get_the_archive_title(); 
            $archiveDescription = get_the_archive_description();
          ?>

          <h1 class="banner__title"><?php echo $archiveTitle; ?></h1>
          <?php get_template_part('inc/breadcrumb'); ?>

          <?php if($archiveDescription) { ?>
            <h4 class="banner__intro"><?php echo $archiveDescription ?></h4>
          <?php } ?>

        <?php } elseif ( is_search() ) { ?>

          <h1 class="banner__title">Search results</h1>
          <h4 class="banner__intro"><?php printf( esc_html__( 'You searched for: %s', 'ddl' ), '<span>' . get_search_query() . '</span>' );?></h4>

        <?php } elseif ( is_404() ) { ?>

          <h1 class="banner__title">Sorry, page not found.</h1>

        <?php } elseif ( is_singular( 'post' ) ) { ?>

          <?php $categories_list = preg_replace('/<a /', '<li><a ', get_the_category_list( ', ' )); ?>

          <h1 class="banner__title"><?php the_title(); ?></h1>
          <?php get_template_part('inc/breadcrumb'); ?>

          <div class="banner__meta">
            <ul class="banner__categories"><?php echo $categories_list ?></ul>
            <time class="banner__date"><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></time>
          </div>

        <?php } else { ?>

          <?php if($banner_alt) { ?>
            <h1 class="banner__title"><?php echo $banner_alt ?></h1>
          <?php } else { ?>
            <h1 class="banner__title"><?php the_title(); ?></h1>
          <?php } ?>
          <?php get_template_part('inc/breadcrumb'); ?>

          <?php if($banner_intro) { ?>
            <h4 class="banner__intro"><?php echo $banner_intro ?></h4>
          <?php } ?>

          <?php if( have_rows($banner_btn) ) { 

            while( have_rows($banner_btn) ): the_row(); 

            $banner_btn_link = get_sub_field('banner_btn_link');
            $banner_btn_txt = get_sub_field('banner_btn_txt');
            $banner_btn_color = get_sub_field('banner_btn_color');
            $banner_btn_destination = get_sub_field('banner_btn_destination');

            ?>

            <a class="btn btn--<?php echo esc_html($banner_btn_color['value']); ?> btn--inline" href="<?php echo $banner_btn_link; ?>"<?php if( in_array ('external', $banner_btn_destination) ) { ?>target="_blank" rel="noopener noreferrer"<?php } ?>><?php echo $banner_btn_txt; ?></a>

            <?php endwhile; wp_reset_query();  ?>

          <?php } ?>

        <?php } ?>

      </div>
    </div>
  </div>

</div>