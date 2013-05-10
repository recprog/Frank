<h3 class="type-title">
	<?php _e('Home Page Settings', 'frank_theme'); ?>
</h3>
	<?php

	wp_nonce_field('frank_update_home_sections', 'frank_key');

	// GET EXISTING SECTIONS, IF PRESENT
	$frank_sections = get_option('_frank_options');
	$frank_updated  = false;
	if (!empty($_POST) && wp_verify_nonce($_POST['frank_key'], 'frank_update_home_sections')) {

		$sections     = array();

		foreach($_POST as $key => $value) {

			$keyflag = 'frank-display-type-';

			if(substr($key, 0, strlen($keyflag)) == $keyflag) {

				// FIND ID FLAG
				$frank_section_flag = substr($key, strlen($keyflag), strlen($key));

				// SINCE WE'RE PIGGY-BACKING SOME WP CORE FUNCTIONALTITY, THE POST
				// CATEGORIES HAVE A SLIGHTLY DIFFERENT ID DEPENDING ON WHAT WAS FIRST

				if($frank_section_flag == 'default') {

					echo $frank_post_category_flag = '';

				} else {

					$frank_post_category_flag = '-' . $frank_section_flag;

				}

				// ADD OUR DATA
				$sections[] = array(
					'display_type'      => frank_post_value_or_default('frank-display-type-' . $frank_section_flag, 'default_loop'),
					'header'      => frank_post_value_or_default('frank-section-header-' . $frank_section_flag, false),
					'title'      => frank_post_value_or_default('frank-section-title-' . $frank_section_flag, ''),
					'caption'      => frank_post_value_or_default('frank-section-caption-' . $frank_section_flag, ''),
					'num_posts'      => frank_post_value_or_default('frank-section-num-posts-' . $frank_section_flag, 10),
					'categories'      => frank_post_value_or_default('post_category-' . $frank_section_flag, array()),
				);

			}

		} // END FOREACH LOOP

		$frank_sections['sections'] = $sections;
		update_option('_frank_options', $frank_sections);
		$frank_updated = true;

	}

	$frank_sections = $frank_sections['sections'];

	// IF NOTHING'S SET, SET DEFAULTS
	if(empty($frank_sections)) {

		$frank_sections['sections'] = array(
			'display_type'      => 'default_loop',
			'header'             => false,
			'title'             => '',
			'caption'           => '',
			'num_posts'         => 10,
			'categories'        => array(),
			'default'           => true
		);

	} ?>

	<div class="button-container">

		<input type="submit" name="submit"  class="save-settings" value="<?php _e('Update Settings', 'frank_theme'); ?>" />

	<?php frank_update_settings_button($frank_updated); ?>

	</div><!-- // BUTTON CONTAINER --> 
	
	<div class="helper-container">
		<p class="section-helper">
			<?php
				_e('Content Sections give you the opportunity to create a dynamic homepage for you to keep your readers engaged. With a vast variety of different layouts, you have the choice to select a look that works best for you.', 'frank_theme');
			?>
		</p>
	</div>

	<div style="clear:both;"></div>

	<div id="frank-content-sections">           
	<?php

	foreach($frank_sections as $frank_section_id => $frank_section) : ?>

	<div class="frank-content-sections" id="frank-street-section-<?php echo $frank_section_id; ?>">

		<h3 class="content-titles">
			<?php _e('Content Section', 'frank_theme'); ?>
			<span class="frank-handle"></span>
			<a class="frank-content-section-delete" href="#">&times;</a>
		</h3>

		<div class="content-group">
			<?php
			$the_type = $frank_section['display_type'];
			$checkbox_name = "frank-section-header-" . (isset($frank_section['default']) ? 'default' : $frank_section_id);
			?>
			<div class="main-options-container">
				<!-- // DISPLAY TYPES -->
				<div class="display-types">
					<label class="section-title"><?php _e('Display Type:', 'frank_theme'); ?></label>
					<select name="frank-display-type-<?php echo (isset($frank_section['default']) ? 'default' : $frank_section_id); ?>" class="dropmenu option-display-type">
						<option<?php if($the_type == 'default_loop') { ?> selected="selected"<?php } ?> value="default_loop"><?php _e('Default Loop', 'frank_theme'); ?></option>
						<option<?php if($the_type == 'one_up_reg' ) { ?> selected="selected"<?php } ?> value="one_up_reg"><?php _e('One Up (Regular)', 'frank_theme'); ?></option>
						<option<?php if($the_type == 'one_up_lg' ) { ?> selected="selected"<?php } ?> value="one_up_lg"><?php _e('One Up (Large)', 'frank_theme'); ?></option>
						<option<?php if($the_type == 'two_up' ) { ?> selected="selected"<?php } ?> value="two_up"><?php _e('Two Up', 'frank_theme'); ?></option>
						<option<?php if($the_type == 'three_up' ) { ?> selected="selected"<?php } ?> value="three_up"><?php _e('Three Up', 'frank_theme'); ?></option>
						<option<?php if($the_type == 'four_up' ) { ?> selected="selected"<?php } ?> value="four_up"><?php _e('Four Up', 'frank_theme'); ?></option>
						<option<?php if($the_type == 'srd_loop' ) { ?> selected="selected"<?php } ?> value="srd_loop"><?php _e('Some Random Dude Loop', 'frank_theme'); ?></option>
					</select>
				</div>
				<div style="clear:both;"></div>
			</div>
			
			<div class="top-options-container">

				

				<!-- // SECTION HEADER TOGGLE -->
				<div class="display-headers">
					<input type="checkbox"
					 name=<?php echo $checkbox_name ?>
					class="checkbox"
					value="section_header"
					<?php 
					$value = !isset($frank_section['default']) ? stripslashes($frank_section['header']) : $frank_defaults['header'];
					checked($value); 
					?>
					/>
					<label class="section-title inline">
					<?php
						_e('Display section header', 'frank_theme');
					?>
					</label>
				</div>

				<!-- // SECTION TITLE -->
				<div class="display-titles optional-container" controlling-checkbox=<?php echo $checkbox_name ?> >
					<label class="section-title"><?php _e('Section Title:', 'frank_theme'); ?></label>
					<input type="text"
							 class="text text-title"
							 name="frank-section-title-<?php echo (isset($frank_section['default']) ? 'default' : $frank_section_id); ?>"
							 <?php
								$val_str = isset($frank_section['default']) ?  $frank_defaults['title'] : stripslashes($frank_section['title']);
								echo 'value="' . esc_attr($val_str) . '"';
							 ?>
					/>
				</div>
				
				<!-- // POSTS TO DISPLAY -->
				<div class="display-posts">
					<label class="section-title"><?php _e('Number of Posts:', 'frank_theme'); ?></label>
					<input type="text"
							 class="text"
							 name="frank-section-num-posts-<?php echo (isset($frank_section['default']) ? 'default' : $frank_section_id); ?>"
							 <?php
								$val_str = isset($frank_section['default']) ?  $frank_defaults['num_posts'] : stripslashes($frank_section['num_posts']);
								echo 'value="' . esc_attr($val_str) . '"';
							 ?>
						/>
				</div>

			</div><!-- // END TOP OPTIONS CONTAINER -->
			</div>
			<div style="clear:both;"></div>

			<div class="bottom-options-container">
				
				<!-- // SECTION CAPTIONS -->
				<div class="display-captions optional-container" controlling-checkbox=<?php echo $checkbox_name ?> >
					<label class="section-title"><?php _e('Section Caption:', 'frank_theme'); ?></label>
					<textarea name="frank-section-caption-<?php echo (isset($frank_section['default']) ? 'default' : $frank_section_id); ?>"
						<?php
							$caption_txt = isset($frank_section['default']) ? $frank_defaults['caption'] : stripslashes($frank_section['caption']);
							echo 'class="textarea">' . esc_textarea($caption_txt);
						?>
					</textarea>
				</div>
				
				
				<!-- // CATEGORIES TO DISPLAY -->
				<div class="display-categories">
					<label class="section-title"><?php _e('Categories to Display', 'frank_theme'); ?></label>
					<div class="categories-container">
						<ul class="categorychecklist">
							<?php wp_terms_checklist(); ?>
						</ul>
						
						<div style="clear:both;"></div>
						
						<ul class="frank-group">
							<li><a class="select-button frank-select" href="#"><?php _e('Select All', 'frank_theme'); ?></a></li>
							<li><a class="select-button frank-deselect" href="#"><?php _e('Deselect All', 'frank_theme'); ?></a></li>
						</ul>
						<div style="clear:both;"></div>
					</div>

					<div style="clear:both;"></div>

					<?php $categories = $frank_section['categories']; ?>
					
					<script type="text/javascript">
					jQuery(document).ready(function() {
						<?php if (is_array($categories)) : ?>
						<?php foreach($categories as $category) : ?>

							jQuery('#frank-street-section-<?php echo $frank_section_id; ?> .categorychecklist input').each(function(){

								if(jQuery(this).val() == <?php echo $category; ?>) {

									jQuery(this).attr('checked', true);

								}

							});

						<?php endforeach; ?>
						<?php endif; ?>

					});
					</script>

				</div>

			</div><!-- //  END BOTTOM OPTIONS CONTAINER -->

			<div style="clear:both;"></div>

		

		<div style="clear:both;"></div>

	</div><!-- // FRANK CONTENT SECTIONS --> <?php 
	
	endforeach; ?>
</div>
<div id="frank-add-content-section">
	<a href="#"><?php _e('+ Add New Section +', 'frank_theme'); ?></a>
</div>