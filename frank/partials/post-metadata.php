<ul class="metadata vertical">
	<li class="date"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time></li>
	<li class="author">By <?php the_author_link(); ?></li>
	<li class="categories"><?php the_category(', '); ?></li>
	<li class="tags"><?php the_tags('', ' '); ?></li>
	<li class="comments"><?php comments_popup_link('No comments', '1 comment', '% comments'); ?></li>	
	<?php
		if (strlen(get_the_title())==0) :
	?>
		<li class="permalink"><a href="<?php the_permalink() ?>">Permalink</a></li>
	<?php endif; ?>
</ul>