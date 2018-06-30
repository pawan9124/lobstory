<?php get_header();
	if( is_shop() ){
	    get_template_part('woo', 'shop');
	} else if( is_product() ){
		get_template_part('woo', 'single');
	} else {
		get_template_part('woo', 'pages');
	}
get_footer();