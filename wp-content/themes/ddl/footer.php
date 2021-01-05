  </main>

  <footer class="footer">

    <div class="footer__content">        
      <div class="footer__row">
        <div class="footer__inner">
          <ul>
              <li>Site updated: <?php echo date('F Y'); ?></li>
              <?php wp_nav_menu( array (
              'theme_location' => 'footer-menu',
              'container' => false,
              'items_wrap' => '%3$s'
              ) ); ?>
          </ul>
          <ul>
            <li>Website made with <i class="fa fa-heart"></i> by <a href="https://dental-design.marketing/" target="_blank">Dental Design</a> </li>
            <li>Find Bright &amp; White on <a href="https://www.dentistfinder.net/" target="_blank">dentistfinder.net</a></li>
          </ul>
        </div>
      </div>
    </div>

    <?php edit_post_link( __( 'Edit', 'textdomain' ), null, null, null, 'button-edit' ); ?>
      
  </footer>
  
  <?php wp_footer(); ?>

	</body>
</html>