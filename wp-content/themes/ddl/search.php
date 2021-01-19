<?php get_header(); ?>

<?php if ( have_posts() ) { ?>

  <?php get_template_part('template-parts/component', 'banner'); ?>

  <div class="posts" id="mainContent">
    <div class="content">
      <div class="content__row">
        <div class="inner">
          <ul class="inner__row">

            <?php while ( have_posts() ) : the_post(); ?>
              <li>
                <a href="<?php echo get_permalink(); ?>" title="Go to article">
                  <h4 class="item__title"><?php the_title(); ?></h4>
                  <p><?php echo strip_tags( get_excerpt(165) ); ?></p>
                </a>
              </li>
            <?php endwhile; ?>

            <?php echo pagination(); ?>

          </ul>
        </div>
      </div>
    </div>
  </div>

<?php } else { ?>

  <?php get_template_part('template-parts/component', 'banner'); ?>

  <article class="article" id="mainContent">
    <div class="content">
      <div class="content__row">
        <div class="inner">
          <p>Sorry, but nothing matched your search. Please try again using some different keywords.</p>
          <?php get_template_part('template-parts/component', 'search-form'); ?>
        </div>
      </div>
    </div>
  </article>

<?php } ?>

<?php get_footer();?>