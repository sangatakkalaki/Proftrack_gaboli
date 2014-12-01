<?php get_header(); # show header

#get theme option
$builders = it_get_setting('page_builder');

#loop through builder panels
if(!empty($builders) && count($builders) > 2) {
	foreach($builders as $builder) {
		it_shortcode($builder);			
	}
} else {
	it_get_template_part('page-content');
} 
if(is_page(969)){
echo "hello";
echo do_shortcode('[ajax_register]'); 
}
get_footer(); # show footer ?>