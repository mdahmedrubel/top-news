jQuery(document).ready(function($) {
    // USE STRICT
    "use strict";
    
    // Hide post format sections
    function hide_statuses() {
        $('#_format-audio,#_format-aside,#_format-chat,#_format-gallery,#_format-image,#_format-link,#_format-quote,#_format-status,#_format-video').hide();
    }

    // Post Formats
    if($("#post-formats-select").length) {
        // Hide post format sections
        hide_statuses();

        // Supported post formats
        var post_formats = ['audio','aside','chat','gallery','image','link','quote','status','video'];

        // Get selected post format
        var selected_post_format = $("input[name='post_format']:checked").val();

        // Show post format meta box
        if(jQuery.inArray(selected_post_format,post_formats) != '-1') {
            $('#_format-'+selected_post_format).stop(true,true).fadeIn(600);
        }

        // Hide/show post format meta box when option changed
        $("input[name='post_format']:radio").change(function() {
            // Hide post format sections
            hide_statuses();
            // Shoe selected section
            if(jQuery.inArray($(this).val(),post_formats) != '-1') {
                $('#_format-'+$(this).val()).stop(true,true).fadeIn(600);
            }
        });
    }

});