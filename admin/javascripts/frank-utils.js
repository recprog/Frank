
// LAST UPDATED ON NOVEMBER 13TH, 2012 (FH)

function setContainerEnabledState(container, enabled) {
    container.css({ opacity: enabled ? 1.0 : 0.5 });
    var formElems = container.find("input");
    if (enabled){
        formElems.removeAttr("disabled");
    } else {
        formElems.attr("disabled", "disabled");
    }
}

function registerEnableStateCallback(container, checkboxSelector) {
    jQuery(checkboxSelector).click(function(){
        var checked = jQuery(this).is(':checked');
        setContainerEnabledState(container, checked);
    });
}

jQuery(document).ready(function(){

    var optionalContainers = jQuery.find('.optional-container');
    jQuery.each(optionalContainers, function(index, value) {
        var container = jQuery(value);
        var controllingCheckboxName = container.attr("controlling-checkbox")
        var controllingCheckboxSelector = 'input[name=\"' + controllingCheckboxName + '\"]';
        var checked = jQuery(controllingCheckboxSelector).is(':checked');
        setContainerEnabledState(container, checked);
        registerEnableStateCallback(container, controllingCheckboxSelector);
    });

    // SELECT ALL & DESELECT ALL (IN "Categories to display" BOX)
    jQuery('.display-categories a.select-button').click(function() {

	    var frank_value = jQuery(this).hasClass('frank-select')
        jQuery(this).closest(".categories-container").find('input').each(function(){

            jQuery(this).attr('checked', frank_value);

        });

        return false;

    });

	jQuery('.option-display-type').change(function() {
		var section = jQuery(this).parents('.frank-content-sections');
		if(jQuery(this).find("option:selected").val()=="default_loop") {
			jQuery(section).find('.display-categories').hide();
			jQuery(section).find('.display-posts').hide();
		} else {
			jQuery(section).find('.display-categories').show();
			jQuery(section).find('.display-posts').show();
		}
	})

    // APPEND NEW SECTION TO THE LIST
    jQuery('#frank-add-content-section a').click(function() {

        // WE'LL FIRST CLONE IT, THEN APPEND IT TO THE LIST
        var clonedItem = jQuery('.frank-content-sections:eq(0)').clone();
        
        // MAKE SURE NEW CONTENT SECTION LOADS BENEATH OTHERS & ABOVE THE "ADD NEW" BUTTON
        jQuery('.frank-content-sections:last').after(clonedItem);

        // NOW WE NEED TO CLEAR OUT ANY INPUT THAT CAME WITH THE CLONE
        jQuery('.frank-content-sections:last input[type=text]').val('');
        jQuery('.frank-content-sections:last textarea').val('');
        jQuery('.frank-content-sections:last input[type=checkbox]').attr('checked', false);

        // WE ALSO NEED TO MANAGE OUR INPUT ID'S TO PREVENT COLLISION
        var frankhash = new Date();
        	frankhash = frankhash.getTime();

        // DISPLAY TYPE TO USE
        jQuery('.frank-content-sections:last .display-types select')
        	.attr('name','frank-display-type-' + frankhash)
            .attr('id','frank-display-type-' + frankhash);

        // SECTION TITLE TO DISPLAY
        jQuery('.frank-content-sections:last .display-titles input')
	        .attr('name','frank-section-title-' + frankhash)
	        .attr('id','frank-section-title-' + frankhash);

        // SECTION CAPTION TO DISPLAY
        jQuery('.frank-content-sections:last .display-captions textarea')
		    .attr('name','frank-section-caption-' + frankhash)
		    .attr('id','frank-section-caption-' + frankhash);

        // NUMBER OF POSTS TO DISPLAY
        jQuery('.frank-content-sections:last .display-posts input')
	        .attr('name','frank-section-num-posts-' + frankhash)
	        .attr('id','frank-section-num-posts-' + frankhash);

        // CATEGORIES TO DISPLAY
        jQuery('.frank-content-sections:last .categorychecklist input').each(function() {

            var frankcat = jQuery(this);

            frankcat.attr('name', 'post_category-' + frankhash + '[]');
            frankcat.attr('id', frankcat.attr('id') + '-' + frankhash);

        });
        
        // MAKE SURE SORTABLE FUNCTIONALITY ACTIVATES IMMEDIATLY IF THERE ARE MORE THAN ONE CONTENT SECTIONS
        if(jQuery('.frank-content-sections').length > 1) {

            jQuery('.frank-handle').show();
            jQuery('.frank-handle:first').after('<p class="dragdrop">' + admin_strings.drag_section_instruction + '</p>');
            jQuery('#frank-content-sections').sortable('refresh');

        } else {

	        jQuery('.frank-handle').hide();

        }

        return false;

    });

    // DELETE SECTION BY CLICKING ON 'X' IN THE UPPER RIGHT HAND CORNER OF BLOCK
    jQuery('a.frank-content-section-delete').click(function(){
	    
	    // CONFIRMATION MESSAGE & FUNCTIONALITY TO DELETE CONTENT SECTIONS
        if(confirm(admin_strings.delete_section_alert)) {

        	var frank_section;

            frank_section = jQuery(this).parent().parent();

            frank_section.slideUp(function() {

                frank_section.remove();

                if(jQuery('.frank-content-sections').length > 1){

                    jQuery('.frank-handle').show();
                    jQuery('.frank-handle:first').after('<p class="dragdrop">' + admin_strings.drag_section_instruction + '</p>');
                    jQuery('#frank-content-sections').sortable('refresh');

                } else {

                    jQuery('.frank-handle').hide();

                }

            });

        }

        return false;

    });

    // IF WE'RE LOADING SAVED SECTIONS, THE CATEGORY ID'S / NAMES AREN'T GOING TO WORK SOO...
    jQuery('.frank-content-sections').each(function(){
		
		if(jQuery(this).find(".option-display-type option:selected").val()=="default_loop") {
			jQuery(this).find('.display-categories').hide();
			jQuery(this).find('.display-posts').hide();
		} else {
			jQuery(this).find('.display-categories').show();
			jQuery(this).find('.display-posts').show();
		}
		
		
        if(jQuery(this).attr('id') != 'default' && !jQuery(this).hasClass('frank-content-section-default')) {

            frankhash = jQuery(this).attr('id').replace('frank-street-section-','');

            jQuery(this).find('.categorychecklist input').each(function(){

                frankcat = jQuery(this);
                frankcat.attr('name','post_category-' + frankhash + '[]');
                frankcat.attr('id',frankcat.attr('id') + '-' + frankhash);

            });

        }

    });

    // ACTIVATE HELPER TEXT & JQUERY SORTABLE IF THERE IS MORE THAN ONE CONTENT SECTION
    if(jQuery('.frank-content-sections').length > 1) {

    	jQuery('.frank-handle:first').after('<p class="dragdrop">' + admin_strings.drag_section_instruction + '</p>');

	    jQuery(function() {
		   jQuery('#frank-content-sections').sortable({
	            axis: 'y',
	            containment: 'parent',
	            forceHelperSize: true,
	            helper: 'clone',
	            opacity: 0.6
	        });

	        jQuery('#frank-content-sections').disableSelection();

	    });

    } else {

        jQuery('.frank-handle').hide();

    }

});