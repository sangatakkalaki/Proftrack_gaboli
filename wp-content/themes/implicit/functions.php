<?php
/*
* Sets up the theme by loading the IndustrialThemes class & initializing the framework
* which activates all classes and functions needed for theme's operation.
*/

# load the IndustrialThemes class
if ( file_exists( get_stylesheet_directory() . '/framework.php' ) )
	require_once( get_stylesheet_directory() . '/framework.php' );
else if ( file_exists( get_template_directory() . '/framework.php' ) )
	require_once( get_template_directory() . '/framework.php' );

# get theme data
$theme_data = wp_get_theme();
# initialize the IndustrialThemes framework
IndustrialThemes::init(array(
	'theme_name' => $theme_data->name,
	'theme_version' => $theme_data->version
));

function fb_change_search_url_rewrite() {
if ( is_search() && ! empty( $_GET['s'] ) ) {
wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
exit();
}	
}
add_action( 'template_redirect', 'fb_change_search_url_rewrite' );


add_filter( 'posts_search', 'my_search_is_perfect', 20, 2 );
function my_search_is_perfect( $search, $wp_query ) {
    global $wpdb;

    if ( empty( $search ) )
        return $search;

    $q = $wp_query->query_vars;
    $n = !empty( $q['exact'] ) ? '' : '%';

    $search = $searchand = '';
	
    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
		$search .= "{$searchand}($wpdb->posts.post_title REGEXP '[[:<:]]{$term}[[:>:]]') OR ($wpdb->posts.post_content REGEXP '[[:<:]]{$term}[[:>:]]') OR (tter.name REGEXP '[[:<:]]{$term}[[:>:]]') OR (u.display_name REGEXP '[[:<:]]{$term}[[:>:]]')";
		$searchand = ' AND ';
			
    }


	
   if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }

    return $search;
}

function price_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Price', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Price', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Price', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'price', array( 'post' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'price_taxonomy', 0 );

function duration_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Duration', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Duration', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Duration', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'duration', array( 'post' ), $args );

}
// Hook into the 'init' action
add_action( 'init', 'duration_taxonomy', 0 );

function location_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Location', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Location', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'location', array( 'post' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'location_taxonomy', 0 );

//added for autologin
function auto_login_new_user( $user_id ) {
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);
            // You can change home_url() to the specific URL,such as 
        //wp_redirect( 'http://www.wpcoke.com' );
        //wp_redirect( home_url() );
		wp_redirect(( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		
        exit;
    }
 //add_action( 'user_register', 'auto_login_new_user' );
	
	



if ( ! isset( $content_width ) ) $content_width = 1200;
?>