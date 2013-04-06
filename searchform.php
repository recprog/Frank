<?php
/**
 * @package Frank
 */
?>

<?php $search_placeholder = __('Type your query, hit enter', 'frank_theme'); ?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/" role="search">
	<input type="text" placeholder=<?php echo '"' . $search_placeholder . '" '; ?> class='textinput' name="s" id="s" />
</form>
