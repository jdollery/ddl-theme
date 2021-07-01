<?php get_header(); ?>

<?php if ( have_posts() ) { ?>

  <?php get_template_part('template-parts/component', 'banner'); ?>

  <?php if( is_active_sidebar('sidebar') ) { ?>

  <div class="block-y" id="mainContent">
    <div class="outer">
      <div class="outer__row">
        <div class="inner">
          <div class="inner__row">

            <?php while ( have_posts() ) : the_post(); ?>

              <?php if (is_sticky()) { ?>

                <article class="card card--sticky">

                  <?php get_template_part( 'template-parts/component', 'post' ); ?>

                </article>

              <?php } else { ?>

                <article class="card">

                  <?php get_template_part( 'template-parts/component', 'post' ); ?>

                </article>

              <?php } ?>

            <?php endwhile; ?>

            <?php echo pagination(); ?>

          </div>
        </div>
        <aside class="aside" role="complementary">
          <div class="aside__outer" >
            <div class="aside__outer__row">
              <?php dynamic_sidebar('sidebar'); ?>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
      
  <?php } else { ?>

  <div class="block-y" id="mainContent">
    <div class="outer">
      <div class="outer__row">
        <div class="inner">
          <div class="inner__row">

            <?php while ( have_posts() ) : the_post(); ?>

              <?php if (is_sticky()) { ?>

                <article class="card">

                  <?php get_template_part( 'template-parts/component', 'post' ); ?>

                </article>

              <?php } else { ?>

                <article class="card">

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

<?php } else { ?>

  <?php get_template_part('template-parts/component', 'banner'); ?>

  <div class="block-y" id="mainContent">
    <div class="outer">
      <div class="outer__row">
        <div class="inner">
          <div class="inner__row">
            <article class="post">
              Sorry, no posts yet.
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>

<?php get_footer();?>