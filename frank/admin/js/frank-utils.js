jQuery(document).ready(function(){

    // de/select all
    jQuery('.frank-categories ul.frank-group li a').live('click',function(){
        if(jQuery(this).hasClass('frank-select')){
            frank_value = true;
        }else{
            frank_value = false;
        }
        jQuery(this).parent().parent().parent().find('input').each(function(){
            jQuery(this).attr('checked', frank_value);
        });
        return false;
    });

    // add new section
    jQuery('#frank-add-content-section a').click(function(){
        // we'll first clone it and append it to the list
        jQuery('.frank-content-section:eq(0)').clone().appendTo('#frank-content-sections');

        // now we need to clear out any input that came with the clone
        jQuery('.frank-content-section:last input[type=text]').val('');
        jQuery('.frank-content-section:last textarea').val('');
        jQuery('.frank-content-section:last input[type=checkbox]').attr('checked', false);

        // we also need to manage our input IDs to prevent collision
        frankhash = new Date();
        frankhash = frankhash.getTime();

        // display type
        jQuery('.frank-content-section:last .frank-display-type select')
                        .attr('name','frank-display-type-'+frankhash)
                        .attr('id','frank-display-type-'+frankhash);
        jQuery('.frank-content-section:last .frank-display-type label')
                        .attr('for','frank-display-type-'+frankhash);

        // section title
        jQuery('.frank-content-section:last .frank-section-title input')
                        .attr('name','frank-section-title-'+frankhash)
                        .attr('id','frank-section-title-'+frankhash);
        jQuery('.frank-content-section:last .frank-section-title label')
                        .attr('for','frank-section-title-'+frankhash);

        // section caption
        jQuery('.frank-content-section:last .frank-section-caption textarea')
                        .attr('name','frank-section-caption-'+frankhash)
                        .attr('id','frank-section-caption-'+frankhash);
        jQuery('.frank-content-section:last .frank-section-caption label')
                        .attr('for','frank-section-caption-'+frankhash);

        // number of posts
        jQuery('.frank-content-section:last .frank-section-num-posts input')
                        .attr('name','frank-section-num-posts-'+frankhash)
                        .attr('id','frank-section-num-posts-'+frankhash);
        jQuery('.frank-content-section:last .frank-section-num-posts label')
                        .attr('for','frank-section-num-posts-'+frankhash);

        // categories
        jQuery('.frank-content-section:last .categorychecklist input').each(function(){
            frankcat = jQuery(this);
            frankcat.attr('name','post_category-'+frankhash+'[]');
            frankcat.attr('id',frankcat.attr('id')+'-'+frankhash);
        });

        if(jQuery('.frank-content-section').length>1){
            jQuery('.frank-handle').show();
            jQuery('#frank-content-sections').sortable('refresh');
        }

        return false;

    });

    // delete section
    jQuery('a.frank-content-section-delete').live('click',function(){
        if(confirm('Are you sure?'))
        {
            frank_section = jQuery(this).parent();
            frank_section.slideUp(function(){
                frank_section.remove();
                if(jQuery('.frank-content-section').length>1){
                    jQuery('.frank-handle').show();
                    jQuery('#frank-content-sections').sortable('refresh');
                }else{
                    jQuery('.frank-handle').hide();
                }
            });
        }
        return false;
    });


    // if we're loading saved sections, the category IDs/names aren't going to work, so
    jQuery('.frank-content-section').each(function(){
        if(jQuery(this).attr('id')!='default'&&!jQuery(this).hasClass('frank-content-section-default')){
            frankhash = jQuery(this).attr('id').replace('frank-street-section-','');
            jQuery(this).find('.categorychecklist input').each(function(){
                frankcat = jQuery(this);
                frankcat.attr('name','post_category-'+frankhash+'[]');
                frankcat.attr('id',frankcat.attr('id')+'-'+frankhash);
            });
        }
    });


    if(jQuery('.frank-content-section').length>1){
        jQuery('#frank-content-sections').sortable({
            axis: 'y',
            containment: 'parent',
            forceHelperSize: true,
            helper: 'clone',
            opacity: 0.6
        });
        jQuery('#frank-content-sections').disableSelection();
    }else{
        jQuery('.frank-handle').hide();
    }

});