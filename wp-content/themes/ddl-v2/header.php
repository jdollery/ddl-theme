<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en-GB"> <![endif]-->
<!--[if IE 7]><html class="no-js ie ie7 lt-ie9 lt-ie8" lang="en-GB"> <![endif]-->
<!--[if IE 8]><html class="no-js ie ie8 lt-ie9" lang="en-GB"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Dental Design - https://dental-design.marketing">
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2Yj0cZfmd380OOF1JZQfSZEAxt_NbAtI" type="text/javascript"></script>
	</head>

  <body <?php body_class(); ?> >

    <header class="header" id="mainHeader">
      
      <div class="cell-row cell-row-gutter-x cell-align-center cell-justify-between">

        <div class="cell-auto cell-gutter-x">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" title="Back to the home page">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" role="img" alt="<?php bloginfo( 'name' ); ?>" width="260" height="82">
          </a>
        </div>

        <div class="cell-0 cell-gutter-x text-center">
          <nav class="navigation" id="headerNav">
            <ul>
              <?php wp_nav_menu( array (
                'theme_location' => 'header-menu',
                'container' => false,
                'items_wrap' => '%3$s'
              ) ); ?>
            </ul>
          </nav> 
        </div>

        <div class="cell-auto cell-gutter-x">

          <a class="btn btn--accent" href="<?php echo site_url() ?>/contact/">Book an appointment</a>
          
          <button class="burger" id="navToggle" type="button" title="Main menu">
            <span class="burger__inner"></span>
          </button>

        </div>

      </div>

    </header>

  <main class="main">
    <span class="main__overlay" id="viewOverlay"></span>