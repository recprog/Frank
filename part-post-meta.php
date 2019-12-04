<?php

$elements = array(
	'published' => sprintf( 
		'<span class="meta-item meta-published time published">
			<abbr title="%s">%s</abbr>
		</span>', 
		esc_attr( get_the_time('r') ),  
		get_the_time( get_option( 'date_format' ) )
	),
	'updated' => sprintf( 
		'<span class="meta-item meta-updated time updated">
			<span class="value-title" title="%s"></span>
		</span>', 
		esc_attr( get_the_modified_date('r') )
	),
	'author' => sprintf( 
		'<span class="meta-item meta-author author vcard">
			<span class="name fn">
				<span class="value-title" title="%s"></span>
			</span>
		</span>', 
		esc_attr( get_the_author() )
	),
	'category' => sprintf( 
		'<span class="meta-item meta-category category">%s</span>', 
		get_the_category_list( ', ' ) 
	),
	'tags' => get_the_tag_list( '<span class="meta-item meta-tags tags">', '', '</span>' )
);

$comment_count = get_comments_number();

if ( $comment_count )
	$elements['comments'] = sprintf( 
			'<span class="meta-item meta-comment-count"><a href="%s#comments">%s</a></span>', 
			get_permalink(), 
			sprintf( _n( 'One Comment', '%d Comments', $comment_count, 'frank' ), number_format_i18n( get_comments_number() ) )
		);

echo implode( ' ', $elements );
