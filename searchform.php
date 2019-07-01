
<form method="get" class="searchform" action="<?php echo home_url(); ?>" role="search">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search', 'frank' ); ?></span>
		<input type="search" name="s" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'frank' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
	</label>
	<input type="submit" name="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'frank' ); ?>" />
</form>