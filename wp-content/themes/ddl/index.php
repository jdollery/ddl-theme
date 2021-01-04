<?php get_header(); ?>

<?php if ( have_posts() ) { ?>

  <?php get_template_part('inc/banner'); ?>

  <?php if( is_active_sidebar('sidebar') ) { ?>

  <div class="posts" id="mainContent">
    <div class="content">
      <div class="content__row">
        <div class="inner">
          <div class="inner__row">

            <?php while ( have_posts() ) : the_post(); ?>

              <?php if (is_sticky()) { ?>

                <article class="post post--sticky">

                  <!-- <?php get_template_part( 'template-parts/content/content', 'post' ); ?> -->

                </article>

              <?php } else { ?>

                <article class="post">

                  <!-- <?php get_template_part( 'template-parts/content/content', 'post' ); ?> -->

                </article>

              <?php } ?>

            <?php endwhile; ?>

            <!-- <?php echo pagination(); ?> -->

          </div>
        </div>
        <div class="aside">
          <div class="block__aside__content" role="complementary">
            <aside class="block__aside__widgets">
              <?php dynamic_sidebar('sidebar'); ?>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </div>
      
  <?php } else { ?>

  <div class="block" id="mainContent">
    <div class="block__container">
      <div class="block__content">
        <div class="block__feed">
          <div class="block__feed__content">

            <?php while ( have_posts() ) : the_post(); ?>

              <?php if (is_sticky()) { ?>

                <article class="post post--sticky">

                  <!-- <?php get_template_part( 'template-parts/content/content', 'post' ); ?> -->

                </article>

              <?php } else { ?>

                <article class="post">

                  <!-- <?php get_template_part( 'template-parts/content/content', 'post' ); ?> -->

                </article>

              <?php } ?>

            <?php endwhile; ?>

            <!-- <?php echo pagination(); ?> -->

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>

<?php } else { ?>

  <!-- <?php get_template_part( 'template-parts/component/component', 'title' ); ?> -->

  <div class="block" id="mainContent">
    <div class="block__container">
      <!-- <?php get_template_part( 'template-parts/content/content', 'none' ); ?> -->
    </div>
  </div>

<?php } ?>

<?php get_footer();?>