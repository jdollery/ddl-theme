<?php

$sections = 'page_sections';

while( have_rows($sections) ): the_row();

$choose_section = get_sub_field('choose_section');

if( $choose_section == 'sticky' ) {
  get_template_part('inc/sticky');
}

endwhile; wp_reset_postdata();