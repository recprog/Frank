<div class="wrap">

    <div id="icon-options-general" class="icon32"><br /></div>
    <h2><?php _e('Franklin Street - General', 'frankstreet'); ?></h2>


    <?php
        $frank_general_updated = false;

        if ( !empty( $_POST ) && wp_verify_nonce( $_POST['frank_general_key'], 'frank_update_general' ) )
        {
	
			$frank_general['header']=$_POST['frank-general-header'];
			$frank_general['footer']=$_POST['frank-general-footer'];
			$frank_general['devmode']=$_POST['frank-general-devmode'];
	
            update_option( '_frank_general', $frank_general );

            $frank_general_updated = true;

        }


        // we need to pull our existing sections, if present
        $frank_general = get_option( '_frank_general' );

        // if there's nothing, we'll set our defaults
        if( empty( $frank_general ) )
        {
            $frank_general[] = array(
                                        'header'      		=> '',
                                        'footer'            => '',
										'devmode'			=> ''
            );
        }

    ?>

    <?php if( $frank_general_updated) : ?>
        <div class="message updated">
            <p><strong>Franklin Street</strong> general settings updated.</p>
        </div>
        <!-- /message -->
    <?php endif ?>

    <h3><?php _e('General Settings', 'frankstreet'); ?></h3>

    <form action="" method="post">

        <?php wp_nonce_field( 'frank_update_general', 'frank_general_key' ); ?>

        <div id="frank-general">
				<div>
                	<label for="frank-general-header"><?php _e('Custom Header Code', 'frankstreet'); ?></label>
                	<textarea name="frank-general-header"><?php echo stripslashes($frank_general['header']); ?></textarea>
				</div>
				<div>
					<label for="frank-general-footer"><?php _e('Custom Footer Code', 'frankstreet'); ?></label>
                	<textarea name="frank-general-footer"><?php echo stripslashes($frank_general['footer']); ?></textarea>
				</div>
				<div>
					<input type="checkbox" name="frank-general-devmode" value="devmode" <?php if($frank_general['devmode']): ?> checked="checked" <?php endif; ?> /> <label for="frank-general-devmode"><?php _e('Developer Mode', 'frankstreet'); ?></label>
				</div>
        </div>

        <div id="frank-save">
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save', 'frankstreet'); ?>" />
            </p>
        </div>

    </form>

</div>