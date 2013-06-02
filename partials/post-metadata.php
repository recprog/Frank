<ul class="metadata vertical">
	<li class="date"><time datetime="<?php the_time( 'Y-m-d' ); ?>" itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></time></li>
	<li class='author'>
		<?php
			echo _x( 'By', 'post_author_attribution', 'frank_theme' );
			echo ' ';
			the_author_link();
		?>
	</li>
	<li class="categories"><?php the_category( ', ' ); ?></li>
	<li class="tags"><?php the_tags( '', ' ' ); ?></li>
	<li class="comments">
		<a href="<?php comments_link(); ?>">
			<?php
				comments_number(
					__( 'No Comments', 'frank_theme' ),
					__( 'One Comment', 'frank_theme' ),
					__( '% Comments', 'frank_theme' )
				);
			?>
		</a>
	</li> 
	<?php
		if ( strlen( get_the_title() ) == 0 ) :
	?>
		<li class="permalink"><a href="<?php the_permalink() ?>">Permalink</a></li>
	<?php endif; ?>
</ul>