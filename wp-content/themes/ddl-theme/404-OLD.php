<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

  <article class="content content--white content--top content--bottom">
    <div class="content__body">
      <h2>We can&rsquo;t seem to find what you&rsquo;re looking for.</h2>
      <p>This could have happened because the link is broken or the page has moved.</p>
      <a class="btn btn--black btn--space" href="<?php echo site_url() ?>">Go to our home page</a>
    </div>
  </article>

<?php get_footer();?>