<ul class='metadata horizontal clearfix'>
	<li class='date'><time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time></li>
  <li class='author'>
    <?php
      echo _x('By', 'post_author_attribution', 'frank_theme');
      echo ' ';
      the_author_link();
    ?>
  </li>
	<li>Filed Under <?php the_category(', '); ?></li>											
	<li class='comments'>
	<?php
	  comments_number(__('No Comments', 'frank_theme'),
		                __('One Comment', 'frank_theme'),
		                __('% Comments', 'frank_theme'));
	?>
	</li>
	<?php
		if (strlen(get_the_title())==0) :
	?>
		<li class="permalink"><a href="<?php the_permalink() ?>">Permalink</a></li>
	<?php endif; ?>
</ul>