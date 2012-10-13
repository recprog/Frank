<?php
$next = get_next_posts_link();
$prev = get_previous_posts_link();
?>
<?php if($next || $prev): ?>	
<div class="pagination row">			
	<?php if($next): ?>
		<a href='<?php echo next_posts( $max_page, false ); ?>' class='button'>Older Entries</a>
	<?php endif; ?>
	<?php if($prev): ?>
		<a href='<?php echo previous_posts( $max_page, false ); ?>' class='button'>Newer Entries</a>
	<?php endif; ?>
</div>
<?php endif; ?>