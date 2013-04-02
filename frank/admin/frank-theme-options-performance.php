				<h3 class="type-title"><?php _e('Performance Settings', 'frank_theme'); ?></h3>

					<?php

					$frank_updated = false;

					// PULL EXISTING SECTIONS, IF PRESENT
					$frank_performance = get_option('_frank_options');

					if (!empty($_POST) && wp_verify_nonce($_POST['frank_performance_key'], 'frank_update_performance')) {
					  $frank_performance['remove_script_version'] = frank_post_value_or_default('frank-performance-remove-script-version', '');
					  $frank_performance['remove_wordpress_version'] = frank_post_value_or_default('frank-performance-remove-wordpress-version', '');
					  

						update_option( '_frank_options', $frank_performance );
						$frank_updated = true;

					}

					// IF THERE'S NOTHING, SET DEFAULTS
					if(empty($frank_performance)) {

						$frank_performance = array(
							'remove_script_version'      					=> false,
							'remove_wordpress_version'            => false
						);

					} ?>

					<div class="button-container">

						<input type="submit" name="submit"  class="save-settings" value="<?php _e('Update Settings', 'frank_theme'); ?>" />

						<?php frank_update_settings_button($frank_updated); ?>

					</div><!-- // BUTTON CONTAINER -->

					
					<!-- REMOVE WORDPRESS VERSION -->
					<div id="first-option" class="option-container">
						<div class="feature">
							<input type="checkbox"
								   name="frank-performance-remove-wordpress-version"
								   class="checkbox"
								   value="remove_wordpress_version" 
									<?php checked( frank_get_option('remove_wordpress_version')); ?>
								/>

							<label for="frank-performance-remove-wordpress-version">
								<?php _e('Remove WordPress version meta tag.', 'frank_theme'); ?>
							</label>
						</div>
						<div class="feature-desc">
						  <?php
							  _e('This feature gives you the option to integrate a little bit of social networking directly into your posts. By turning this feature on, we\'ll automatically create a "Tweet" Button people can use to share your content!', 'frank_theme');
							?>
						</div>
						<div style="clear:both;"></div>
					</div>
					<!-- REMOVE SCRIPT VERSION -->
					<div class="option-container">
						<div class="feature">
							<input type="checkbox"
								   name="frank-performance-remove-script-version"
								   class="checkbox"
								   value="remove_script_version" 
									<?php checked( frank_get_option('remove_script_version')); ?>
								/>

							<label for="frank-performance-remove-script-version">
								<?php _e('Remove version URL parameter from scripts.', 'frank_theme'); ?>
							</label>
						</div>
						<div class="feature-desc">
							<?php
							  _e('By entering your handle once right here, you can easily reference this setting throughout the theme and change it later with ease, if needed. Refrain from using the \'@\' sign. An example handle: \'somerandomdude\'.', 'frank_theme');
							?>
						</div>
						<div style="clear:both;"></div>
					</div>