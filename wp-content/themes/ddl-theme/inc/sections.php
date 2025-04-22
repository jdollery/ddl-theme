<?php

$sections = 'page_sections';

while( have_rows($sections) ): the_row();

$choose_section = get_sub_field('choose_section');

foreach( $choose_section as $section ) {
  get_template_part('inc/'. $section ); //set ACF to array[both]
}

endwhile; wp_reset_postdata();