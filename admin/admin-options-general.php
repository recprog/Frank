<div class="wrap">

    <div id="icon-options-general" class="icon32"><br /></div>
    <h2><?php _e('Franklin Street - General', 'franklinstreet'); ?></h2>


    <?php
        $franklin_general_updated = false;

        if ( !empty( $_POST ) && wp_verify_nonce( $_POST['franklin_general_key'], 'franklin_update_general' ) )
        {
	
			$franklin_street_general['header']=$_POST['franklin-general-header'];
			$franklin_street_general['footer']=$_POST['franklin-general-footer'];
	
            update_option( '_franklin_street_general', $franklin_street_general );

            $franklin_general_updated = true;

        }


        // we need to pull our existing sections, if present
        $franklin_street_general = get_option( '_franklin_street_general' );

        // if there's nothing, we'll set our defaults
        if( empty( $franklin_street_general ) )
        {
            $franklin_street_general[] = array(
                                        'header'      		=> '',
                                        'footer'            => ''
            );
        }

    ?>

    <?php if( $franklin_general_updated) : ?>
        <div class="message updated">
            <p><strong>Franklin Street</strong> general settings updated.</p>
        </div>
        <!-- /message -->
    <?php endif ?>

    <h3><?php _e('General Settings', 'franklinstreet'); ?></h3>

    <form action="" method="post">

        <?php wp_nonce_field( 'franklin_update_general', 'franklin_general_key' ); ?>

        <div id="franklin-general">
				<div>
                	<label for="franklin-general-header"><?php _e('Custom Header Code', 'franklinstreet'); ?></label>
                	<textarea name="franklin-general-header"><?php echo stripslashes($franklin_street_general['header']); ?></textarea>
				</div>
				<div>
					<label for="franklin-general-footer"><?php _e('Custom Footer Code', 'franklinstreet'); ?></label>
                	<textarea name="franklin-general-footer"><?php echo stripslashes($franklin_street_general['footer']); ?></textarea>
				</div>
        </div>

        <div id="franklin-save">
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save', 'franklinstreet'); ?>" />
            </p>
        </div>

    </form>

</div>