<?php get_header(); ?>

<?php get_template_part('template-parts/component', 'banner'); ?>

<div class="block-y" id="mainContent">
  <div class="outer">
    <div class="outer__row">
      <div class="inner">

        <?php if ( have_posts() ) { ?>

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

        <?php } else { ?>

        <p>Sorry, but nothing matched your search. Please try again using some different keywords.</p>
        <?php get_template_part('template-parts/component', 'search'); ?>

        <?php } ?>

      </div>
    </div>
  </div>
</div>

<?php get_footer();?>