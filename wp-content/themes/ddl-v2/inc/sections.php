<?php

$sections = 'page_sections';

while( have_rows($sections) ): the_row();

$choose_section = get_sub_field('choose_section');

if( $choose_section == 'split' ) {
  get_template_part('inc/split');
}

// if( $choose_section == 'wide' ) {
//   get_template_part('inc/wide');
// }

// if( $choose_section == 'steps' ) {
//   get_template_part('inc/steps');
// }

// if( $choose_section == 'reviews' ) {
//   get_template_part('inc/reviews');
// }

// if( $choose_section == 'content' ) {
//   get_template_part('inc/content');
// }

// if( $choose_section == 'faq' ) {
//   get_template_part('inc/faq');
// }

endwhile; wp_reset_postdata();