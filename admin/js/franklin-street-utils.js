jQuery(document).ready(function(){

    // de/select all
    jQuery('.franklin-categories ul.franklin-group li a').live('click',function(){
        if(jQuery(this).hasClass('franklin-select')){
            franklin_value = true;
        }else{
            franklin_value = false;
        }
        jQuery(this).parent().parent().parent().find('input').each(function(){
            jQuery(this).attr('checked', franklin_value);
        });
        return false;
    });

    // add new section
    jQuery('#franklin-add-content-section a').click(function(){
        // we'll first clone it and append it to the list
        jQuery('.franklin-content-section:eq(0)').clone().appendTo('#franklin-content-sections');

        // now we need to clear out any input that came with the clone
        jQuery('.franklin-content-section:last input[type=text]').val('');
        jQuery('.franklin-content-section:last textarea').val('');
        jQuery('.franklin-content-section:last input[type=checkbox]').attr('checked', false);

        // we also need to manage our input IDs to prevent collision
        franklinhash = new Date();
        franklinhash = franklinhash.getTime();

        // display type
        jQuery('.franklin-content-section:last .franklin-display-type select')
                        .attr('name','franklin-display-type-'+franklinhash)
                        .attr('id','franklin-display-type-'+franklinhash);
        jQuery('.franklin-content-section:last .franklin-display-type label')
                        .attr('for','franklin-display-type-'+franklinhash);

        // section title
        jQuery('.franklin-content-section:last .franklin-section-title input')
                        .attr('name','franklin-section-title-'+franklinhash)
                        .attr('id','franklin-section-title-'+franklinhash);
        jQuery('.franklin-content-section:last .franklin-section-title label')
                        .attr('for','franklin-section-title-'+franklinhash);

        // section caption
        jQuery('.franklin-content-section:last .franklin-section-caption textarea')
                        .attr('name','franklin-section-caption-'+franklinhash)
                        .attr('id','franklin-section-caption-'+franklinhash);
        jQuery('.franklin-content-section:last .franklin-section-caption label')
                        .attr('for','franklin-section-caption-'+franklinhash);

        // number of posts
        jQuery('.franklin-content-section:last .franklin-section-num-posts input')
                        .attr('name','franklin-section-num-posts-'+franklinhash)
                        .attr('id','franklin-section-num-posts-'+franklinhash);
        jQuery('.franklin-content-section:last .franklin-section-num-posts label')
                        .attr('for','franklin-section-num-posts-'+franklinhash);

        // categories
        jQuery('.franklin-content-section:last .categorychecklist input').each(function(){
            franklincat = jQuery(this);
            franklincat.attr('name','post_category-'+franklinhash+'[]');
            franklincat.attr('id',franklincat.attr('id')+'-'+franklinhash);
        });

        return false;

    });

    // delete section
    jQuery('a.franklin-content-section-delete').live('click',function(){
        if(confirm('Are you sure?'))
        {
            franklin_section = jQuery(this).parent();
            franklin_section.slideUp(function(){
                franklin_section.remove();
            });
        }
        return false;
    });


    // if we're loading saved sections, the category IDs/names aren't going to work, so
    jQuery('.franklin-content-section').each(function(){
        if(jQuery(this).attr('id')!='default'&&!jQuery(this).hasClass('franklin-content-section-default')){
            franklinhash = jQuery(this).attr('id').replace('franklin-street-section-','');
            jQuery(this).find('.categorychecklist input').each(function(){
                franklincat = jQuery(this);
                franklincat.attr('name','post_category-'+franklinhash+'[]');
                franklincat.attr('id',franklincat.attr('id')+'-'+franklinhash);
            });
        }
    });

});