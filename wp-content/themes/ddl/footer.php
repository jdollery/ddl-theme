    <?php get_template_part('template-parts/component', 'cta'); ?>
    
    </main>

    <footer class="footer">

      <?php if( is_active_sidebar('footer-widget-one') ) { ?>
      <div class="footer__outer">
        <div class="footer__outer__row">
          <div class="footer__one">
            <?php dynamic_sidebar('footer-widget-one'); ?>
          </div>
          <div class="footer__two">
            <?php dynamic_sidebar('footer-widget-two'); ?>
          </div>
          <div class="footer__three">
            <?php dynamic_sidebar('footer-widget-three'); ?>
          </div>
        </div>
      </div>
      <?php } ?>

      <div class="copyright">
        <div class="copyright__outer">
          <div class="copyright__outer__row">
            <div class="copyright__one">
              <ul>
                <li>&copy;<?php echo date("Y") ?> Dental Design - All Rights Reserved</li>
                <li>Last updated: <?php echo date('F Y'); ?></li>
              </ul>
            </div>
            <div class="copyright__two">
              Website design and marketing by <a href="https://dental-design.marketing/" target="_blank">Dental Design</a>
            </div>
          </div>
        </div>
      </div>

      <?php edit_post_link( __( 'Edit', 'textdomain' ), null, null, null, 'button-edit' ); ?>
        
    </footer>

  </div>
  
  <?php wp_footer(); ?>

	</body>
</html>