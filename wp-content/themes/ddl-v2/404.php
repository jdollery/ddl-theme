<?php get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<article class="content content--default">
  <div class="content__row">
    <div class="content__body">
      <h1>We can’t seem to find what you’re looking for.</h1>
      <p>This could have happened because the link is broken or the page has moved.</p>
      <a class="button button--blue button--body" href="<?php echo site_url() ?>">Go to our home page</a>
    </div>
  </div>
</article>

<?php get_footer();?>