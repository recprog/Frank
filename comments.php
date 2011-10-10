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
<div id='comments_container' class='clear'>
	<header>
		<h1>The Discussion</h1>
		<h2><?php comments_number('No Comments', 'One Comment', '% Comments' );?> on &#8220;<?php the_title(); ?>&#8221;</h2>
	</header>
<div id='comments_content'>
<?php if ($comments) : ?>
	<ul id="comments" class='incomplete'>
	<?php foreach ($comments as $comment) : ?>
		<li class="comment span-12 last clear">
			<div class="comment-info span-2">
				<ul class='metadata vertical'>
					<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php comment_date('F d, Y'); ?></time></li>
					<li class='author' id="vcard-<?php comment_ID() ?>">By <a class="url fn" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></li>
				</ul>
				
				<?php edit_comment_link('edit'); ?>
			</div>
			<div class="content span-7 suffix-3 last">
				<div class='copy'><?php if ($comment->comment_approved == '0') : echo "<span id='comment_moderation'>Your comment is awaiting moderation.</span>"; endif; ?>
				<?php comment_text() ?>	
				</div>
			</div>
		</li>
		<?php $oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : ''; ?>
	
	<?php endforeach; ?>
	</ul>
	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<p class="no_comments">Be the first to leave a comment. Don't be shy.</p>
		<?php else : ?>
		<p class="comments_closed">Comments are closed.</p>
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
			<div class='span-2' id="comment_form_info">				
					<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
					<input autocomplete="off" type="text" name="author" placeholder="Name (required)" id="author" value="<?php echo $comment_author; ?>" size="22" class="textinput" tabindex="1" />
					<label for="email">Email <?php if ($req) echo "(required)"; ?></label>
					<input autocomplete="off" type="text" name="email" placeholder="Email (required)" id="email" value="<?php echo $comment_author_email; ?>" size="22" class="textinput" tabindex="2" />
					<label for="url">Website</label>
					<input autocomplete="off" type="text" name="url" placeholder="URL" id="url" value="<?php echo $comment_author_url; ?>" size="22" class="textinput" tabindex="3" />
			</div>
			<?php else : ?>
				<div id='comment_form_info' class='span-2'>				
					By <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> (<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out&hellip;</a>)
				</div>
			<?php endif; ?>
			
			
			<div id="comment_form_comment" class='span-7 last <?php if ( $user_ID ) : ?>loggedin<?php endif; ?>'>
				<label for="comment">Your Comment</label>
				<textarea name="comment" placeholder="Your Comment" class="<?php if ( $user_ID ) echo('loggedin') ?>" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
				<input name="submit" type="submit" id="submit" class="button <?php if ( $user_ID ) echo('loggedin') ?>" tabindex="5" value="Submit Comment" />
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			</div>
			<?php do_action('comment_form', $post->ID); ?>
		</form>	
</div>
	<?php endif; endif; ?>
</div>
</div>