<h3 class="type-title"><?php _e('General Settings', 'frank_theme'); ?></h3>

<?php

wp_nonce_field( 'frank_update_general', 'frank_general_key' );
$frank_updated = false;

// PULL EXISTING SECTIONS, IF PRESENT
$frank_general = get_option('_frank_options');

if (!empty($_POST) && wp_verify_nonce($_POST['frank_general_key'], 'frank_update_general')) {
	$frank_general['header'] = frank_post_value_or_default('frank-general-header', '');
	$frank_general['footer'] = frank_post_value_or_default('frank-general-footer', '');
	$frank_general['tweet_post_button'] = frank_post_value_or_default('frank-general-tweet-post-button', false);
	$frank_general['tweet_post_attribution'] = frank_post_value_or_default('frank-general-tweet-post-attribution', '');

	update_option( '_frank_options', $frank_general );
	$frank_updated = true;

}

// IF THERE'S NOTHING, SET DEFAULTS
if(empty($frank_general)) {

	$frank_general = array(
		'header'                => '',
		'footer'                  => '',
		'tweet_post_button'       => false,
		'tweet_post_attribution'    => '',
	);

} ?>

<div class="button-container">

	<input type="submit" name="submit"  class="save-settings" value="<?php _e('Update Settings', 'frank_theme'); ?>" />

	<?php frank_update_settings_button($frank_updated); ?>

</div><!-- // BUTTON CONTAINER -->

<!-- CUSTOM HEADER CODE -->
<div id="first-option" class="option-container">
	<label class="feature-title"><?php _e('Custom Header Code', 'frank_theme'); ?></label>
	<div class="feature">
		<textarea name="frank-general-header" class="textarea"><?php echo esc_html(stripslashes(frank_get_option('header'))); ?></textarea>
	</div>
	<div class="feature-desc">
		<?php
			_e('This feature allows you to write or copy and paste your own code straight into the header. Many people use this feature to include their Google Analytics code, or other small bits of Javascript. Feel free to use this as you wish!', 'frank_theme');
		?>
	</div>
	<div style="clear:both;"></div>
</div>


<!-- CUSTOM FOOTER CODE -->
<div class="option-container">
	<label class="feature-title"><?php _e('Custom Footer Code', 'frank_theme'); ?></label>
	<div class="feature">
		<textarea name="frank-general-footer" class="textarea"><?php echo esc_html(stripslashes(frank_get_option('footer'))); ?></textarea>
	</div>
	<div class="feature-desc">
	<?php
		_e('This feature allows you to write or copy and paste your own code directly to the footer. A lot of people use this feature to include external and internal Javascript files, for plugins and things of the sort. Use it as you wish!', 'frank_theme');
	?>
	</div>
	<div style="clear:both;"></div>
</div>
<!-- TWEET THIS OPTION -->
<div class="option-container">
	<label class="feature-title"><?php _e('Tweet This', 'frank_theme'); ?></label>
	<div class="feature">
		<input type="checkbox"
				 name="frank-general-tweet-post-button"
				 class="checkbox"
				 value="tweet_post_button" 
				<?php checked( frank_get_option('tweet_post_button')); ?>
			/>

		<label for="frank-general-tweet-post-button">
			<?php _e('Add a "Tweet This Post" Button to Post Templates.', 'frank_theme'); ?>
		</label>
	</div>
	<div class="feature-desc">
		<?php
			_e('This feature gives you the option to integrate a little bit of social networking directly into your posts. By turning this feature on, we\'ll automatically create a "Tweet" Button people can use to share your content!', 'frank_theme');
		?>
	</div>
	<div style="clear:both;"></div>
</div>
<!-- TWEET THIS HANDLE -->
<div class="option-container optional-container" controlling-checkbox="frank-general-tweet-post-button">
	<label class="feature-title"><?php _e('Twitter Handle', 'frank_theme'); ?></label>
	<div class="feature">
		<input type="text"
				 name="frank-general-tweet-post-attribution"
				 class="text"
				 value="<?php echo esc_attr(stripslashes(frank_get_option('tweet_post_attribution'))); ?>" />
	</div>
	<div class="feature-desc">
		<?php
			_e('By entering your handle once right here, you can easily reference this setting throughout the theme and change it later with ease, if needed. Refrain from using the \'@\' sign. An example handle: \'somerandomdude\'.', 'frank_theme');
		?>
	</div>
	<div style="clear:both;"></div>
</div>  