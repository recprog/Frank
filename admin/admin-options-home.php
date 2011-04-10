<div class="wrap">

    <div id="icon-options-general" class="icon32"><br /></div>
    <h2><?php _e('Franklin Street - Home Page Sections', 'franklinstreet'); ?></h2>


    <?php
        $franklin_updated = false;

        if ( !empty( $_POST ) && wp_verify_nonce( $_POST['franklin_key'], 'franklin_update_home_sections' ) )
        {
            $franklin_content_sections = array();
            foreach( $_POST as $key => $value )
            {
                $keyflag = 'franklin-display-type-';
                if( substr( $key, 0, strlen( $keyflag ) ) == $keyflag )
                {
                    // find our ID flag
                    $franklin_section_flag = substr( $key, strlen( $keyflag ), strlen( $key ) );

                    // since we're piggybacking some WP core functionality, the
                    // post categories have a slightly different ID depending on what was first

                    if( $franklin_section_flag == 'default' )
                    {
                        $franklin_post_category_flag = '';
                    }
                    else
                    {
                        $franklin_post_category_flag = '-' . $franklin_section_flag;
                    }

                    // add our data
                    $franklin_content_sections[] = array(
                                        'display_type'      => $_POST['franklin-display-type-' . $franklin_section_flag],
                                        'title'             => $_POST['franklin-section-title-' . $franklin_section_flag],
                                        'caption'           => $_POST['franklin-section-caption-' . $franklin_section_flag],
                                        'num_posts'         => intval( $_POST['franklin-section-num-posts-' . $franklin_section_flag] ),
                                        'categories'        => $_POST['post_category' . $franklin_post_category_flag]
                    );
                }
            }

            update_option( '_franklin_street_home_sections', $franklin_content_sections );

            $franklin_updated = true;

        }


        // we need to pull our existing sections, if present
        $franklin_street_sections = get_option( '_franklin_street_home_sections' );

        // if there's nothing, we'll set our defaults
        if( empty( $franklin_street_sections ) )
        {
            $franklin_street_sections[] = array(
                                        'display_type'      => 'one_up_reg',
                                        'title'             => '',
                                        'caption'           => '',
                                        'num_posts'         => '',
                                        'categories'        => array(),
                                        'default'           => true
            );
        }

    ?>

    <?php if( $franklin_updated ) : ?>
        <div class="message updated">
            <p><strong>Franklin Street</strong> home page sections updated.</p>
        </div>
        <!-- /message -->
    <?php endif ?>

    <h3><?php _e('Content Sections', 'franklinstreet'); ?></h3>

    <form action="" method="post">

        <?php wp_nonce_field( 'franklin_update_home_sections', 'franklin_key' ); ?>

        <div id="franklin-content-sections">

            <?php foreach( $franklin_street_sections as $franklin_street_section_id => $franklin_street_section ) : ?>
                <div class="franklin-content-section franklin-group<?php if( isset( $franklin_street_section['default'] ) ) : ?> franklin-content-section-default<?php endif ?>" id="franklin-street-section-<?php echo $franklin_street_section_id; ?>">

                    <a class="franklin-content-section-delete" href="#">X</a>

                    <div class="franklin-display-type">
                        <label for="franklin-display-type-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>"><?php _e('Display Type:', 'franklinstreet'); ?></label>
                        <select name="franklin-display-type-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>" id="franklin-display-type-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>">
                            <option<?php if( $franklin_street_section['display_type'] == 'one_up_reg' ) : ?> selected="selected"<?php endif ?> value="one_up_reg"><?php _e('One Up (Regular)', 'franklinstreet'); ?></option>
                            <option<?php if( $franklin_street_section['display_type'] == 'one_up_lg' ) : ?> selected="selected"<?php endif ?> value="one_up_lg"><?php _e('One Up (Large)', 'franklinstreet'); ?></option>
                            <option<?php if( $franklin_street_section['display_type'] == 'two_up' ) : ?> selected="selected"<?php endif ?> value="two_up"><?php _e('Two Up', 'franklinstreet'); ?></option>
                            <option<?php if( $franklin_street_section['display_type'] == 'four_up' ) : ?> selected="selected"<?php endif ?> value="four_up"><?php _e('Four Up', 'franklinstreet'); ?></option>
							<option<?php if( $franklin_street_section['display_type'] == 'right_aside' ) : ?> selected="selected"<?php endif ?> value="right_aside"><?php _e('Right Aside', 'franklinstreet'); ?></option>
                        </select>
                    </div>
                    <!-- /franklin-display-type -->

                    <div class="franklin-meta franklin-group">

                        <div class="franklin-meta franklin-fields">
                            <ul>
                                <li class="franklin-section-title">
                                    <label for="franklin-section-title-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>"><?php _e('Section Title', 'franklinstreet'); ?></label>
                                    <input type="text" name="franklin-section-title-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>" id="franklin-section-title-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>" value="<?php echo stripslashes( $franklin_street_section['title'] ); ?>" />
                                </li>
                                <li class="franklin-section-caption">
                                    <label for="franklin-section-caption-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>"><?php _e('Section Caption', 'franklinstreet'); ?></label>
                                    <textarea name="franklin-section-caption-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>" id="franklin-section-caption-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>"><?php echo stripslashes( $franklin_street_section['caption'] ); ?></textarea>
                                </li>
                                <li class="franklin-section-num-posts">
                                    <label for="franklin-section-num-posts-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>"><?php _e('Number of Posts', 'franklinstreet'); ?></label>
                                    <input type="text" name="franklin-section-num-posts-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>" id="franklin-section-num-posts-<?php echo ( isset( $franklin_street_section['default'] ) ? 'default' : $franklin_street_section_id ); ?>" value="<?php echo stripslashes( $franklin_street_section['num_posts'] ); ?>" />
                                </li>
                            </ul>
                        </div>
                        <!-- /franklin-meta- franklin-fields -->

                        <div class="franklin-meta franklin-categories categorydiv">
                            <p><?php _e('Categories to Display', 'franklinstreet'); ?></p>
                            <div class="tabs-panel">
                                <ul class="categorychecklist">
                                    <?php wp_terms_checklist( ) ?>
                                </ul>
                            </div>
                            <!-- /tabs-panel -->

                            <!-- in order to keep things WP standard, we're going to auto-check via jQuery -->
                            <script type="text/javascript">
                                jQuery(document).ready(function(){
                                    <?php foreach( $franklin_street_section['categories'] as $category ) : ?>
                                        jQuery('#franklin-street-section-<?php echo $franklin_street_section_id; ?> ul.categorychecklist input').each(function(){
                                            if(jQuery(this).val()==<?php echo $category; ?>){
                                                jQuery(this).attr('checked', true);
                                            }
                                        })
                                    <?php endforeach; ?>
                                });
                            </script>

                            <ul class="franklin-group">
                                <li><a class="button franklin-select" href="#"><?php _e('Select All', 'franklinstreet'); ?></a></li>
                                <li><a class="button franklin-deselect" href="#"><?php _e('Deselect All', 'franklinstreet'); ?></a></li>
                            </ul>
                        </div>
                        <!-- /franklin-meta- franklin-categories -->
                    </div>
                    <!-- /franklin-meta franklin-group -->

                </div>
                <!-- /franklin-content-section -->
            <?php endforeach; ?>

        </div>
        <!-- /franklin-content-sections -->

        <div id="franklin-add-content-section">
            <a href="#"><?php _e('Add New Section', 'franklinstreet'); ?></a>
        </div>
        <!-- /franklin-add-content-section -->

        <div id="franklin-save">
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save', 'franklinstreet'); ?>" />
            </p>
        </div>

    </form>

</div>