jQuery(function() {
    jQuery(window).scroll(function(){
        var scrollTop = jQuery(window).scrollTop();
        if(scrollTop >= 50){
            jQuery('#flotar').addClass("flotarr");
        }
        else{
            jQuery('#flotar').removeClass("flotarr");
        }
    });
	jQuery('#showall').click(function(){
		jQuery('.showall').show();
	});
	jQuery('#hideall').click(function(){
		jQuery('.showall').hide();
	});
	jQuery('.showSingle').click(function(){
		jQuery('#div'+$(this).attr('target')).show();
	});
	jQuery('.showSingle').dblclick(function(){
		jQuery('#div'+$(this).attr('target')).hide();
	});
});