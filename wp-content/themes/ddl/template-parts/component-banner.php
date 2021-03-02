<?php 

if ( is_front_page() && is_home() || is_search() || is_404() ) { ?>
      
<div class="banner" style="background-image: url('/assets/img/rio-arc-product-01.jpg')">

<?php } elseif ( is_archive() ) { ?>   

<div class="banner" style="background-image: url('/assets/img/rio-arc-product-01.jpg')">

<?php } else {

$post = get_queried_object();
setup_postdata( $post );

$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$thumb_title = get_the_title($thumb_id);
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];

$page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID() );
$blogDescription = esc_attr( get_post_meta( $page_id, 'title_description', true )); 

$pageDescription = esc_attr( get_post_meta( get_the_ID(), 'title_description', true ) ); 

if ( has_post_thumbnail() ) { ?>

<div class="banner" style="background-image: url('<?php echo $thumb_url ?>')">

<?php } else { ?>

<div class="banner">

<?php } ?>

<?php } ?>

  <div class="outer">

  <?php if ( is_front_page() && is_home() ) { //home/blog ?>

    <h1 class="banner__title"><?php bloginfo( 'name' ); ?></h1>
    <h4 class="banner__subtitle"><?php bloginfo( 'description' ); ?></h4>

  <?php } elseif ( is_front_page() ) { //static home ?>

    <h1 class="banner__title"><?php the_title(); ?></h1>
    <?php if( !empty($pageDescription) ) { ?>
    <h4 class="banner__subtitle"><?php echo $pageDescription ?></h4>
    <?php } ?>

  <?php } elseif ( is_home() ) { //static blog ?>

    <?php $blogTitle = get_the_title( get_option('page_for_posts', true) ); ?>

    <h1 class="banner__title"><?php echo $blogTitle ?></h1>
    <?php if( !empty($blogDescription) ) { ?>
    <h4 class="banner__subtitle"><?php echo $blogDescription ?></h4>
    <?php } ?>

  <?php } elseif ( is_archive() ) { ?>

    <?php 
      $archiveTitle = get_the_archive_title(); 
      $archiveDescription = get_the_archive_description();
    ?>

    <h1 class="banner__title"><?php echo $archiveTitle; ?></h1>
    <?php if( !empty($archiveDescription) ) { ?>
    <h4 class="banner__subtitle"><?php echo $archiveDescription; ?></h4>
    <?php } ?>

  <?php } elseif ( is_search() ) { ?>

    <h1 class="banner__title">Search results</h1>
    <h4 class="banner__subtitle"><?php printf( esc_html__( 'You searched for: %s', 'ddl' ), '<span>' . get_search_query() . '</span>' );?></h4>

  <?php } elseif ( is_404() ) { ?>

    <h1 class="banner__title">We can&rsquo;t seem to find what you&rsquo;re looking for.</h1>

  <?php } elseif ( is_singular( 'post' ) ) { ?>

    <div class="banner__meta">
      <span class="banner__categories"><?php echo get_the_category_list(); ?></span>
      <span class="banner__date"><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
    </div>
    <h1 class="banner__title"><?php the_title(); ?></h1>
    <h4 class="banner__subtitle"><?php echo $pageDescription ?></h4>

  <?php } else { ?>

    <h1 class="banner__title"><?php the_title(); ?></h1>
    <?php if( !empty($pageDescription) ) { ?>
    <h4 class="banner__subtitle"><?php echo $pageDescription ?></h4>
    <?php } ?>

  <?php } ?>
  
  </div>

</div>