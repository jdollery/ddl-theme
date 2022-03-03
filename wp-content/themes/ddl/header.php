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
		<!-- <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-96x96.png" sizes="92x92">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-16x16.png" sizes="16x16"> -->
    <meta name="author" content="Dental Design - https://dental-design.marketing">
    <?php wp_head(); ?>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2Yj0cZfmd380OOF1JZQfSZEAxt_NbAtI&callback=initMap" type="text/javascript"></script> -->
	</head>

  <body <?php body_class(); ?> >

    <header class="header" id="mainHeader">
      <div class="header__outer">
        <div class="header__row">
          <div class="header__one">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" title="Back to the home page">
              <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" role="img" alt="<?php bloginfo( 'name' ); ?>" width="170" height="42"> -->
              Logo
            </a>
          </div>
          <div class="header__two">
            <?php get_template_part('template-parts/component', 'navigation'); ?>
          </div>
          <div class="header__three">
            <a href="#"><i class="fas fa-phone-alt"></i> 01234567891</a>
            <button class="button button-primary" type="button">Contact Us</button>
            <button class="burger" id="navToggle" type="button" title="Main menu">
              <span class="burger__inner"></span>
            </button>
          </div>
        </div>
      </div>
    </header>
    <div class="view">
      <main class="main">

  