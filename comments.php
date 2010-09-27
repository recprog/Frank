<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { ?>
			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
			<?php return;
		}
	}
	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>
<!-- Start editing here. -->
<div id='comments_content'>
<?php if ($comments) : ?>
	<ul id="comments" class='incomplete'>
	<?php foreach ($comments as $comment) : ?>
		<li class="comment span-11 last clear">
			<div class="gravatar span-1"><?php echo get_avatar( $comment, 45 ); ?></div>
			<div class="content span-10 last">
				<div class='copy'><?php if ($comment->comment_approved == '0') : echo "<span id='comment_moderation'>Your comment is awaiting moderation.</span>"; endif; ?>
				<?php comment_text() ?>	
				</div>
				<div class='metadata'><small><?php comment_author_link() ?> at <?php comment_date('j.m.Y') ?> <?php comment_time() ?> <span class='edit'><?php edit_comment_link('edit'); ?></span></small></div>
			</div>
		</li>
		<?php $oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : ''; ?>
	
	<?php endforeach; ?>
	</ul>
	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<h3 id="no_comments">Be the first to leave a comment. Don't be shy.</h3>
		<?php else : ?>
		<p class="no_comments">Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>

<?php
/**
 * @package WordPress
 * @subpackage Franklin_Street
 */
?>
<?php if ('open' == $post->comment_status) : ?>

	<div id="comment_form" class="clearfix">
		
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

		<?php else : ?>
		<header>
			<h1>Leave Your Own Comment</h1>
		</header>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<?php if ( !$user_ID ) : ?>	
			<div class='span-3'>				
				<dl id="comment_form_info">
					<dt><label for="author">Name <?php if ($req) echo "(required)"; ?></label></dt>
					<dd><input autocomplete="off" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" class="textinput" tabindex="1" /></dd>
					<dt><label for="email">Email <?php if ($req) echo "(required)"; ?></label> </dt>
					<dd><input autocomplete="off" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" class="textinput" tabindex="2" /></dd>
					<dt><label for="url">Website</label></dt>
					<dd><input autocomplete="off" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" class="textinput" tabindex="3" /></dd>
				</dl>
			</div>
			<?php endif; ?>
			
			<div class='<?php echo ( !$user_ID )?'span-8':'span-11' ?> last'>
				<?php if ( $user_ID ) : ?>
					<p class='loggedin'>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
				<?php endif; ?>
				<dl id="comment_form_comment" class="<?php if ( $user_ID ) : ?>loggedin<?php endif; ?>">
					<dt><label for="comment">Your Comment</label></dt>
					<dd><textarea name="comment" class="<?php if ( $user_ID ) echo('loggedin') ?>" id="comment" cols="100%" rows="10" tabindex="4"></textarea></dd>
				</dl>
				<input name="submit" type="submit" id="submit" class="button <?php if ( $user_ID ) echo('loggedin') ?>" tabindex="5" value="Submit Comment" />
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			</div>
			<?php do_action('comment_form', $post->ID); ?>
		</form>	
</div>
	<?php endif; endif; ?>
</div>