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
		<h1 id="comments-title"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h1>
	</header>
	<ul id="comments">
	<?php wp_list_comments( array( 'callback' => 'frank_comment' ) ); ?>		
	</ul>
	<div class="pagination small">		
		<span class="title">Comments:</span>
		<?php paginate_comments_links(); ?>	
	</div>
	
	<?php
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no_comments">Comments are closed.</p>
	<?php elseif (comments_open()) : ?>
		<p class="no_comments">Be the first to leave a comment. Don&rsquo;t be shy.</p>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

		
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

		<?php else : ?>		
		<?php
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(
			'author' => '<div id="comment-form-info">' . 
									'<label for="author">' . __( 'Name', 'frank-theme' ) . '' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="author" name="author" type="text" placeholder="Name (required)" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',
			'email'  => '<label for="email">' . __( 'Email', 'frank-theme' ) . '' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="email" name="email" type="text" placeholder="Email (required)" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />',
			'url'    => '<label for="url">' . __( 'Website', 'frank-theme' ) . '</label>' .
			            '<input id="url" name="url" type="text" placeholder="Website" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
		); 
	
		$comment_field = '<div id="comment-form-content"><label for="comment">' . _x( 'Comment', 'noun', 'frank-theme'  ) . '</label><textarea id="comment-form-textarea" placeholder="Your Comment" name="comment" aria-required="true"></textarea></div>';
		$logged_in_as = '<div id="comment-form-logged-in-as"><p>' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div>';
		$comment_notes_after = '<div class="row"><div id="comment-form-allowed-tags"><p>' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p></div></div>';
		
		comment_form(array('id_form' => 'comment-form', 'logged_in_as' => $logged_in_as, 'comment_notes_before' => '', 'comment_notes_after' => $comment_notes_after, 'title_reply' => 'Join the Discussion', 'fields' => $fields, 'comment_field' => $comment_field)); 
		?>
		
	<?php endif; endif; ?>
</div>