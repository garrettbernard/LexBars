function ajax_form(form,site_url,link_id){
	var req = jQuery.post
	( 
		site_url, 
		jQuery('#' + form).serialize(), 
		function(html){
			var explode = html.split("\n");
			var shown = false;
			var msg = '<b>You have errors in your form. Please check the following fields and try again:</b><br /><br /><ol>';
			for ( var i in explode )
			{
				var explode_again = explode[i].split("|");
				if (explode_again[0]=='error')
				{
					if ( ! shown ) {
						jQuery('#' + link_id).show();
					}
					shown = true;
					add_remove_class('ok','error',explode_again[1]);
					jQuery('#err_' + explode_again[1]).html(explode_again[2]);
					msg += "<li>" + explode_again[1] + "</li>";
				}
				else if (explode_again[0]=='ok') {
					add_remove_class('error','ok',explode_again[1]);
					jQuery('#err_' + explode_again[1]).hide();
				}
			}
			
			if ( ! shown )
			{
				jQuery('#' + link_id).html("Form submitted successfully");
				add_remove_class('error','success',link_id);
				jQuery('#' + link_id).show();
			}
			else {
				add_remove_class('success','error',link_id);
				jQuery('#' + link_id).html(msg + "</ol>");
			}
			
			req = null;
		}
	);
}

function add_remove_class(search,replace,element_id)
{
	if (jQuery('#' + element_id).hasClass(search)){
		jQuery('#' + element_id).removeClass(search);
	}
	jQuery('#' + element_id).addClass(replace);
}