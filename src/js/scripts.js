/*
* Basic JS file to handle loading of site
*/

// Document Ready
jQuery(document).ready(function($){

});

// Loading page event
jQuery(window).load(function() {
    
    jQuery(".loading-content").fadeOut(300, function(){ 
		jQuery("body").addClass("page-loaded");
		jQuery(".photos-wrap").fadeIn(300);
    });

});