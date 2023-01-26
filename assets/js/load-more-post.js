(function($){
    'use strict';
    jQuery( document ).ready(function() {        
        var posts_per_page = loadmorepost.posts_per_page
        var data_clear = loadmorepost.posts_per_page
        jQuery(".single-pagination .loading").hide();
        var pageNumber = 2;
        var max_num_pages = loadmorepost.max_num_pages;
        jQuery(".single-pagination .load-more").live("click",function(event){
            event.preventDefault();
            var post_type = 'post';
            var end_message = loadmorepost.end_message;
            jQuery.ajax({
                url : loadmorepost.ajax_url,
                type : 'post',
                data : {
                    action : 'top_news_load_post',
                    page: pageNumber,
                    post_type: post_type,                
                    posts_per_page: posts_per_page,
                    blog_column: loadmorepost.blog_column,
                    post_style: loadmorepost.post_style,
                    is_excerpt: loadmorepost.is_excerpt,
                    excerpt_limit: loadmorepost.excerpt_limit,
                    is_readmore: loadmorepost.is_readmore,
                    max_num_pages: loadmorepost.max_num_pages,
                    data_clear: data_clear,
                },
                beforeSend: function() {
                    jQuery('.single-pagination .load-more').hide();
                    jQuery('.single-pagination .loading').show();
                },
                success : function( html ) {
                    jQuery('.single-pagination .loading').hide();
                    jQuery('.blog-post-area').append( html );
                    if(max_num_pages > pageNumber){
                        jQuery('.single-pagination .load-more').show();
                    } else {
                        jQuery('.single-pagination').append('<p class="load-more">'+end_message+'</p>');                    
                    }                
                    pageNumber++;
                    data_clear = +data_clear + +posts_per_page;
                }
            });
        });        
    });
}(jQuery));


