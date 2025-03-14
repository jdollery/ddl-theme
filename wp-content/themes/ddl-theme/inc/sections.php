<?php

$sections = 'page_sections';

while( have_rows($sections) ): the_row();

$choose_section = get_sub_field('choose_section');

if( $choose_section == 'content' ) {
  get_template_part('inc/content');
}

if( $choose_section == 'accordion' ) {
  get_template_part('inc/accordion');
}

if( $choose_section == 'quicklinks' ) {
  get_template_part('inc/quicklinks');
}

endwhile; wp_reset_postdata();