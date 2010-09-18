<?php
/*
Template Name: Franklin Street Comment Section

http://codex.wordpress.org/Function_Reference/wp_insert_post
http://codex.wordpress.org/Function_Reference/update_post_meta
http://codex.wordpress.org/Function_Reference/post_meta_Function_Examples
http://hungred.com/how-to/wordpress-templatepage-meta-key-updatepostmeta/
http://www.emanueleferonato.com/2010/04/01/loading-wordpress-posts-with-ajax-and-jquery/

*/
?>

<?php
	$post = $_POST['id'];
	echo $post;
	$post = get_post($_POST['id']);
?>

<?php if ($post) : ?>
	<?php setup_postdata($post); ?>
<?php comments_template(); ?>
<?php endif; ?>