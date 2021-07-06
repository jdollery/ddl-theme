<nav class="navigation" id="headerNav" >
  <h4 id="primaryNavigation" class="sr-only">Primary navigation</h4>
  <ul aria-labelledby="primaryNavigation">
    <?php wp_nav_menu( array (
      'theme_location' => 'header-menu',
      'container' => false,
      'items_wrap' => '%3$s'
    ) ); ?>
  </ul>
</nav>