<?php

    // default data for first run
    $frank_defaults = array(
                    'title'             => 'Section Title',
                    'caption'           => 'Section Caption',
                    'num_posts'         => 10
    );

?>

<div class="wrap">

    <div id="icon-options-general" class="icon32"><br /></div>
    <h2><?php _e('Franklin Street - Home Page Sections', 'frankstreet'); ?></h2>


    <?php
        $frank_updated = false;

        if ( !empty( $_POST ) && wp_verify_nonce( $_POST['frank_key'], 'frank_update_home_sections' ) )
        {
            $frank_content_sections = array();
            foreach( $_POST as $key => $value )
            {
                $keyflag = 'frank-display-type-';
                if( substr( $key, 0, strlen( $keyflag ) ) == $keyflag )
                {
                    // find our ID flag
                    $frank_section_flag = substr( $key, strlen( $keyflag ), strlen( $key ) );

                    // since we're piggybacking some WP core functionality, the
                    // post categories have a slightly different ID depending on what was first

                    if( $frank_section_flag == 'default' )
                    {
                        $frank_post_category_flag = '';
                    }
                    else
                    {
                        $frank_post_category_flag = '-' . $frank_section_flag;
                    }

                    // add our data
                    $frank_content_sections[] = array(
                                        'display_type'      => $_POST['frank-display-type-' . $frank_section_flag],
                                        'title'             => $_POST['frank-section-title-' . $frank_section_flag],
                                        'caption'           => $_POST['frank-section-caption-' . $frank_section_flag],
                                        'num_posts'         => intval( $_POST['frank-section-num-posts-' . $frank_section_flag] ),
                                        'categories'        => $_POST['post_category' . $frank_post_category_flag]
                    );
                }
            }

            update_option( '_frank_street_home_sections', $frank_content_sections );

            $frank_updated = true;

        }


        // we need to pull our existing sections, if present
        $frank_sections = get_option( '_frank_street_home_sections' );

        // if there's nothing, we'll set our defaults
        if( empty( $frank_sections ) )
        {
            $frank_sections[] = array(
                                        'display_type'      => 'default_loop',
                                        'title'             => '',
                                        'caption'           => '',
                                        'num_posts'         => '',
                                        'categories'        => array(),
                                        'default'           => true
            );
        }

    ?>

    <?php if( $frank_updated ) : ?>
        <div class="message updated">
            <p><strong>Franklin Street</strong> home page sections updated.</p>
        </div>
        <!-- /message -->
    <?php endif ?>

    <h3><?php _e('Content Sections', 'frankstreet'); ?></h3>

    <form action="" method="post">

        <?php wp_nonce_field( 'frank_update_home_sections', 'frank_key' ); ?>

        <div id="frank-content-sections">

            <?php foreach( $frank_sections as $frank_section_id => $frank_section ) : ?>
                <div class="frank-content-section frank-group<?php if( isset( $frank_section['default'] ) ) : ?> frank-content-section-default<?php endif ?>" id="frank-street-section-<?php echo $frank_section_id; ?>">

                    <span class="frank-handle"></span>
                    <a class="frank-content-section-delete" href="#">X</a>

                    <div class="frank-display-type">
                        <label for="frank-display-type-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>"><?php _e('Display Type:', 'frankstreet'); ?></label>
                        <select name="frank-display-type-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>" id="frank-display-type-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>">
							<option<?php if( $frank_section['display_type'] == 'default_loop' ) : ?> selected="selected"<?php endif ?> value="default_loop"><?php _e('Default Loop', 'frankstreet'); ?></option>
                            <option<?php if( $frank_section['display_type'] == 'one_up_reg' ) : ?> selected="selected"<?php endif ?> value="one_up_reg"><?php _e('One Up (Regular)', 'frankstreet'); ?></option>
                            <option<?php if( $frank_section['display_type'] == 'one_up_lg' ) : ?> selected="selected"<?php endif ?> value="one_up_lg"><?php _e('One Up (Large)', 'frankstreet'); ?></option>
                            <option<?php if( $frank_section['display_type'] == 'two_up' ) : ?> selected="selected"<?php endif ?> value="two_up"><?php _e('Two Up', 'frankstreet'); ?></option>
							<option<?php if( $frank_section['display_type'] == 'three_up' ) : ?> selected="selected"<?php endif ?> value="three_up"><?php _e('Three Up', 'frankstreet'); ?></option>
                            <option<?php if( $frank_section['display_type'] == 'four_up' ) : ?> selected="selected"<?php endif ?> value="four_up"><?php _e('Four Up', 'frankstreet'); ?></option>
							<option<?php if( $frank_section['display_type'] == 'srd_loop' ) : ?> selected="selected"<?php endif ?> value="srd_loop"><?php _e('Some Random Dude Loop', 'frankstreet'); ?></option>
                        </select>
                    </div>
                    <!-- /frank-display-type -->

                    <div class="frank-meta frank-group">

                        <div class="frank-meta frank-fields">
                            <ul>
                                <li class="frank-section-title">
                                    <label for="frank-section-title-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>"><?php _e('Section Title', 'frankstreet'); ?></label>
                                    <input type="text" name="frank-section-title-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>" id="frank-section-title-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>" value="<?php echo !isset( $frank_section['default'] ) ? stripslashes( $frank_section['title'] ) : $frank_defaults['title']; ?>" />
                                </li>
                                <li class="frank-section-caption">
                                    <label for="frank-section-caption-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>"><?php _e('Section Caption', 'frankstreet'); ?></label>
                                    <textarea name="frank-section-caption-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>" id="frank-section-caption-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>"><?php echo !isset( $frank_section['default'] ) ? stripslashes( $frank_section['caption'] ) : $frank_defaults['caption']; ?></textarea>
                                </li>
                                <li class="frank-section-num-posts">
                                    <label for="frank-section-num-posts-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>"><?php _e('Number of Posts', 'frankstreet'); ?></label>
                                    <input type="text" name="frank-section-num-posts-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>" id="frank-section-num-posts-<?php echo ( isset( $frank_section['default'] ) ? 'default' : $frank_section_id ); ?>" value="<?php echo !isset( $frank_section['default'] ) ? stripslashes( $frank_section['num_posts'] ) : $frank_defaults['num_posts']; ?>" />
                                </li>
                            </ul>
                        </div>
                        <!-- /frank-meta- frank-fields -->

                        <div class="frank-meta frank-categories categorydiv">
                            <p><?php _e('Categories to Display', 'frankstreet'); ?></p>
                            <div class="tabs-panel">
                                <ul class="categorychecklist">
                                    <?php wp_terms_checklist( ) ?>
                                </ul>
                            </div>
                            <!-- /tabs-panel -->

                            <!-- in order to keep things WP standard, we're going to auto-check via jQuery -->
                            <script type="text/javascript">
                                jQuery(document).ready(function(){
                                    <?php foreach( $frank_section['categories'] as $category ) : ?>
                                        jQuery('#frank-street-section-<?php echo $frank_section_id; ?> ul.categorychecklist input').each(function(){
                                            if(jQuery(this).val()==<?php echo $category; ?>){
                                                jQuery(this).attr('checked', true);
                                            }
                                        })
                                    <?php endforeach; ?>
                                });
                            </script>

                            <ul class="frank-group">
                                <li><a class="button frank-select" href="#"><?php _e('Select All', 'frankstreet'); ?></a></li>
                                <li><a class="button frank-deselect" href="#"><?php _e('Deselect All', 'frankstreet'); ?></a></li>
                            </ul>
                        </div>
                        <!-- /frank-meta- frank-categories -->
                    </div>
                    <!-- /frank-meta frank-group -->

                </div>
                <!-- /frank-content-section -->
            <?php endforeach; ?>

        </div>
        <!-- /frank-content-sections -->

        <div id="frank-add-content-section">
            <a href="#"><?php _e('Add New Section', 'frankstreet'); ?></a>
        </div>
        <!-- /frank-add-content-section -->

        <div id="frank-save">
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save', 'frankstreet'); ?>" />
            </p>
        </div>

    </form>

</div>