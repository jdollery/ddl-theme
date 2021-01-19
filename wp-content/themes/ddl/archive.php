<?php get_header(); ?>

<?php if ( have_posts() ) { ?>

  <?php get_template_part('template-parts/component', 'banner'); ?>

  <div class="posts" id="mainContent">
    <div class="content">
      <div class="content__row">
        <div class="inner">
          <div class="inner__row">

            <?php while ( have_posts() ) : the_post(); ?>

              <?php if (is_sticky()) { ?>

                <article class="item">

                  <?php get_template_part( 'template-parts/component', 'post' ); ?>

                </article>

              <?php } else { ?>

                <article class="item">

                  <?php get_template_part( 'template-parts/component', 'post' ); ?>

                </article>

              <?php } ?>

            <?php endwhile; ?>

            <?php echo pagination(); ?>

          </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>

<?php get_footer();?>