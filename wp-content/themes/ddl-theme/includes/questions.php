<?php

if( have_rows('questions_section') ){

  while( have_rows('questions_section') ): the_row(); 

    $questions_hide = get_sub_field('questions_hide');
    $questions_top = get_sub_field('questions_top');
    $questions_heading = get_sub_field('questions_heading');
    $questions_summary = get_sub_field('questions_summary');
    $questions_intro = get_sub_field('questions_intro');
    $questions_list = 'questions_list';

    if ($questions_hide == false) {

    ?>

    <section class="content content--grey content--top content--bottom">

      <div class="content__fixed">

        <?php if($questions_top == false) { ?>
            
          <div class="content__heading">
            <h2><?php if ($questions_heading) { echo $questions_heading; } else { ?>Frequently asked questions<?php } ?></h2>
            <?php if($questions_summary) { echo $questions_summary; } ?>
          </div>

        <?php } ?>

        <dl class="accordion">

          <?php 
          
          $i = 1;
          
          while( have_rows($questions_list) ): the_row(); 
          
          ?>

          <dt class="accordion__item<?php if ($i == 1) { ?> accordion__item--open<?php } ?>" id="accordionItem" >
            <button class="accordion__toggle" id="accordion-title-<?php echo $i ?>" aria-expanded="<?php if ($i == 1) { ?>true<?php } else { ?>false<?php } ?>" aria-controls="accordion-description-<?php echo $i ?>">
              <span><?php echo get_sub_field('questions_title'); ?></span>
              <span class="accordion__icon"></span>
            </button>
          </dt>  
          <dd class="accordion__description" id="accordion-description-<?php echo $i ?>" aria-labelledby="accordion-title-<?php echo $i ?>" style="<?php if ($i == 1) { ?>display: block;<?php } else { ?>display: none;<?php } ?>">        
            <div class="accordion__content">
              <?php echo get_sub_field('questions_description'); ?>
            </div>
          </dd>

          <?php 

          $i++; 
        
          endwhile; wp_reset_postdata() 
          
          ?>

        </dl>

      </div>


      <?php $faqs = get_sub_field('questions_list'); ?>

      <script type="application/ld+json" class="dd-schema-faq">
      {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
        <?php foreach ($faqs as $index => $faq) : $title = $faq['questions_title']; $description = $faq['questions_description']; ?>
          {
            "@type": "Question",
            "name": "<?= strip_tags($title); ?>",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "<?= strip_tags($description); ?>"
            }
          }<?php if ($index < count($faqs) - 1) echo ','; ?>
        <?php endforeach; ?>
        ]
      }
      </script>

    </section>

    <?php

    }

  endwhile; wp_reset_postdata();  

} ?>