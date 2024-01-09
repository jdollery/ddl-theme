<?php

$sections = 'page_sections';

while( have_rows($sections) ): the_row();

$choose_section = get_sub_field('choose_section');

if( $choose_section == 'split' ) {
  get_template_part('inc/split');
}

if( $choose_section == 'accordion' ) {
  get_template_part('inc/accordion');
}

endwhile; wp_reset_postdata();