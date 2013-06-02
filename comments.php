<?php
/**
 * @package Frank
 */
?>

<div id='comments-container'>
	<?php if ( post_password_required() ) : ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p> ?></p>
	</div>
	<?php
			return;
		endif;
		$oddcomment = 'class="alt" ';
	?>


<?php if ( have_comments() ) : ?>
	<header id="comments-header">
		<h1 id="comments-title">
		<?php
			comments_number(
				__( 'No Comments', 'frank_theme' ),
				__( 'One Comment', 'frank_theme' ),
				__( '% Comments', 'frank_theme' )
			);
		?>
		</h1>
	</header>
	<ul id="comments">
	<?php wp_list_comments( array( 'callback' => 'frank_comment' ) ); ?>
	</ul>

	<?php if ( (int) get_option( 'page_comments' ) === 1 && ! is_null( paginate_comments_links( array( 'echo' => false ) ) ) ): ?>
	<div class="pagination small">
		<span class="title">Comments:</span>
		<?php paginate_comments_links( 'prev_text=Previous&next_text=Next' ); ?>
	</div>
	<?php endif; ?>

	<?php
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p id="comments" class="no_comments">Comments are closed.</p>
	<?php elseif (comments_open()) : ?>
		<p id="comments" class="no_comments">
			<?php _e( 'Be the first to leave a comment. Don&rsquo;t be shy.', 'frank_theme' ); ?>
		</p>
<?php endif; ?>


<?php if ( 'open' == $post->comment_status ) : ?>

		<?php if ( get_option( 'comment_registration' ) && ! $user_ID ) : ?>
		<p>You must be <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?redirect_to=<?php echo urlencode( get_permalink() ); ?>">logged in</a> to post a comment.</p>

		<?php else : ?>
		<?php
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$name_label    = __( 'Name (required)', 'frank_theme' );
		$email_label   = __( 'Email (required)', 'frank_theme' );
		$website_label = __( 'Website', 'frank_theme' );

		$fields = array(
			'author' => '<div id="comment-form-info">' .
									'<label for="author">' . __( 'Name', 'frank_theme' ) . '' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
									'<input id="author" name="author" type="text" placeholder=\'' . $name_label . '\' value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',
			'email'  => '<label for="email">' . __( 'Email', 'frank_theme' ) . '' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
									'<input id="email" name="email" type="text" placeholder=\'' . $email_label . '\' value=""' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />',
			'url'    => '<label for="url">' . __( 'Website', 'frank_theme' ) . '</label>' .
									'<input id="url" name="url" type="text" placeholder=\'' . $website_label . '\' value=""' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
		);

		$comment_placeholder = __( 'Your Comment', 'frank_theme' );
		$comment_field = '<div id="comment-form-content"><label for="comment">' . _x( 'Comment', 'noun', 'frank_theme'  ) . '</label><textarea id="comment-form-textarea" placeholder="' . $comment_placeholder . '" name="comment" aria-required="true"></textarea></div>';

		$logged_in_string = __( 'Logged in as', 'frank_theme' );
		$log_out_string   = __( 'Log out?', 'frank_theme' );
		$log_out_hover    = __( 'Log out of this account', 'frank_theme' );
		$logged_in_as     = '<div id="comment-form-logged-in-as"><p>' . $logged_in_string . ' ' . sprintf( 
			'<a href="%1$s">%2$s</a>. <a href="%3$s" title="%4$s">%5$s</a>',
			admin_url( 'profile.php' ),
			$user_identity,
			wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ),
			$log_out_hover,
			$log_out_string
		) . '</p></div>';

		$html_explanation    = sprintf( __( 'You may use these %1$s tags and attributes:', 'frank_theme' ), '<abbr title="HyperText Markup Language">HTML</abbr>' );
		$comment_notes_after = '<div class="row"><div id="comment-form-allowed-tags"><p>' . $html_explanation . ' ' . '<code>' . allowed_tags() . '</code>' . '</p></div></div>';

		$reply_title = __( 'Join the Discussion', 'frank_theme' );

		comment_form(
			array(
				'id_form' => 'comment-form',
				'logged_in_as' => $logged_in_as,
				'comment_notes_before' => '',
				'comment_notes_after' => $comment_notes_after,
				'title_reply' => $reply_title,
				'fields' => $fields,
				'comment_field' => $comment_field,
			)
		);
		?>

	<?php
	endif;
endif;
?>
</div>