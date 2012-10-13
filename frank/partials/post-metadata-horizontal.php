<ul class='metadata horizontal clearfix'>
	<li class='date'><time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time></li>
	<li class='author'>By <?php the_author_link(); ?></li>	
	<li>Filed Under <?php the_category(', '); ?></li>											
	<li class='comments'><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>
</ul>