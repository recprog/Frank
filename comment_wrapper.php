<?php
/*
Template Name: Franklin Street Comment Section
*/
?>

http://codex.wordpress.org/Function_Reference/wp_insert_post
http://www.emanueleferonato.com/2010/04/01/loading-wordpress-posts-with-ajax-and-jquery/


<?php


$comments = get_comments('post_id=1');
foreach($comments as $comm) :
	echo($comm->comment_author);
endforeach;

?>