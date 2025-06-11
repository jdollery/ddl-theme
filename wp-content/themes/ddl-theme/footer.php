    </main>

    <footer class="footer">

      <ul>
        <?php wp_nav_menu( array (
        'theme_location' => 'footer-menu',
        'container' => false,
        'items_wrap' => '%3$s'
        ) ); ?>
        <li>Made &amp; marketed with <span class="icon icon--heart"><svg role="img"><use xlink:href="#heart" href="#heart"></use></svg></span> by <a href="https://dental-design.marketing/" target="_blank" rel="noopener noreferrer">Dental Design</a></li>
        <li>Site last updated: <?php echo date('F Y'); ?></li>
      </ul>  

    </footer>

    <?php get_template_part('includes/icons'); ?>

    <?php edit_post_link( __( 'Edit', 'textdomain' ), null, null, null, 'btn btn--edit' ); ?>

    <?php wp_footer(); ?>

  </body>
</html>