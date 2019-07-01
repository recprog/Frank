<?php

if ( post_password_required() )
	return;

if ( comments_open() || have_comments() ) : ?>

<div class="comments-wrap">
	<div class="comments <?php if ( have_comments() ) echo 'has-comments'; ?>" id="comments">

		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					printf(
						_n( 'One Comment', '%1$s Comments', get_comments_number(), 'frank' ),
						number_format_i18n( get_comments_number() ) 
					);
				?>
			</h2>

			<ol class="commentlist">
				<?php 
					wp_list_comments( array(
							'avatar_size' => 64,
							'short_ping' => true
						) ); 
				?>
			</ol>

			<?php
				// Comments are closed but there were some left before they were closed
				if ( ! comments_open() && get_comments_number() )
					printf( '<p class="nocomments">%s</p>', _e( 'Comments are closed.' , 'frank' ) );

				// Comment pagination enabled, show the links
				if ( get_option('page_comments') && get_comment_pages_count() )
					printf( '<div class="pagination">%s</div>', paginate_comments_links( array( 'echo' => false ) ) );
			?>
		<?php endif; ?>

		<?php 
			comment_form( array(
					'comment_notes_before' => null,
					'comment_notes_after' => null
				) ); 
		?>

	</div><!-- #comments -->
</div>

<?php endif;
