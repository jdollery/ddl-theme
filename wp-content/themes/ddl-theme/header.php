<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Dental Design - https://dental-design.marketing">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2Yj0cZfmd380OOF1JZQfSZEAxt_NbAtI" type="text/javascript"></script> -->
    <!-- <script>
      (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "AIzaSyA2Yj0cZfmd380OOF1JZQfSZEAxt_NbAtI",
        v: "weekly",
      });
    </script> -->
    <?php wp_head(); ?>
	</head>

  <body <?php body_class(); ?> >

    <header class="header" id="mainHeader">
      
      <div class="cell-row cell-row-gutter-x cell-align-center cell-justify-between">

        <div class="cell-auto cell-gutter-x">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" title="Back to the home page">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?php bloginfo( 'name' ); ?>" width="260" height="82">
          </a>
        </div>

        <div class="cell-0 cell-gutter-x text-center">
          <nav class="navigation" id="headerNav" aria-labelledby="navToggle">
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

          <a class="btn btn--accent" href="<?php echo get_the_permalink( 147 ) ?>">Book an appointment</a>
          
          <button class="burger" id="navToggle" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="headerNav">
            <span class="burger__inner"></span>
            <!-- <div class="burger__inner"><div class="burger__trigger"><span class="burger__icon"></span></div><div class="burger__text">Menu</div></div> -->
          </button>

        </div>

      </div>

    </header>

  <main class="main">
    <span class="main__overlay" id="viewOverlay"></span>