<?php
#Template Name: Popup Login
?>
<?php //get_header(); # show header ?>

<!DOCTYPE HTML>
<?php $searcharea = __('Search area',IT_TEXTDOMAIN);?>
<html <?php language_attributes(); ?>>

<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />    
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">   
	
	
	<link rel="styesheet" href="<?php bloginfo('template_url'); ?>/popup.css">
	
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title><?php wp_title( '|', true, 'right' );?></title>
    
    <?php do_action('it_head'); ?>    
    	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    
    <?php echo it_get_setting('analytics_code'); #google analytics code ?> 
    
	<?php wp_head(); ?>
	
	
	
	<script>
        var doc = window.opener.document;
        theForm = doc.getElementById("commentform");
	jQuery(document).ready(function(){
	// jQuery(".lwa-username-input input").attr("placeholder", "Username");
		// jQuery(".lwa-password-input password").attr("placeholder", "Password");
		jQuery("#search-2 #searchsubmit").prop('value', '');
		jQuery("#searchsubmit").click(function () {
				var get=jQuery("#s").val();
		});

    });
    
    jQuery( document ).ajaxComplete(function() {
           if ( jQuery(".lwa-status").hasClass("lwa-status-confirm") ) {
                   //location.reload();
                   
                   
                   //var comment = doc.getElementById("comment");
                   //theForm.method = "post";
                   //theForm.action = "http://vincent.proftrac.com/wp-comments-post.php";
                   //theForm.submit();
                   window.close();
                   opener.sucesslogin();
                   
                   
           }
   });

jQuery("#location_load" ).click(function() {
	jQuery(".lwa-register").hide();
});
/*
window.onunload = function (e) {
    opener.sucesslogin();
};
*/
function checkOpener(){
	if(window.opener){
		<?php
		$http_referer = $_SERVER["HTTP_REFERER"];
		$http_referer = explode('?', $http_referer);
		$action = "";
		$redirect_to = "";
		$redirect_to_provider = "";
		if(isset($http_referer[1])){
			$http_referer_arr = explode('&', $http_referer[1]);
			if(isset($http_referer_arr[0])){$action = $http_referer_arr[0];}
			if(isset($http_referer_arr[2])){$redirect_to = $http_referer_arr[2];}
			if(isset($http_referer_arr[3])){$redirect_to_provider = $http_referer_arr[3];}
			
		}
	
		if($action == 'action=wordpress_social_authenticate' && strpos('popup-login',$redirect_to) !== 0 && $redirect_to_provider == 'redirect_to_provider=true') {
		?>
			window.close();
            opener.sucesslogin();
		<?php
		}
		?>
		
	}
}
checkOpener();
</script>
<style>
    a.fancybox-close{display: none;}
    a.lwa-modal-close{display: none;}
</style>
</head>

<?php $body_class = 'it-background woocommerce bp-page'; 
$category_id = it_page_in_category($post->ID);
if($category_id) $body_class .= ' category-' . $category_id;
?>

<body <?php body_class($body_class); ?>>

    <div style="display:none;">
    <div id = "click">
                            <?php login_with_ajax(); ?>
    </div>

    </div>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script>
jQuery(document).ready(function($) { //noconflict wrapper
        $.fancybox.open('#click');
    });//end noconflict
    

</script>
</body>

</html>