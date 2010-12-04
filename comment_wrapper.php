<?php
/*
Template Name: Franklin Street Comment Section
*/
?>

<?php
	//$post = $_POST['id'];
	$post = get_post($_POST['id']);
?>

<?php if ($post) : ?>
	<?php setup_postdata($post); ?>
<?php comments_template(); ?>
<?php endif; ?>