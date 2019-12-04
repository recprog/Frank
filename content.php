<?php

the_content();

wp_link_pages( array( 
	'before' => '<p class="link-pages">' . __( 'Pages:', 'frank' )
) );
