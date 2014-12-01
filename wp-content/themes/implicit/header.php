
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
	jQuery(document).ready(function(){
	// jQuery(".lwa-username-input input").attr("placeholder", "Username");
		// jQuery(".lwa-password-input password").attr("placeholder", "Password");
		jQuery("#search-2 #searchsubmit").prop('value', '');
		jQuery("#searchsubmit").click(function () {
				var get=jQuery("#s").val();
		});
 // jQuery("#location_load" ).click(function() {
 // jQuery(".lwa-modal,.lwa-modal-bg").addClass('hide');
 // });
    });

jQuery( document ).ajaxComplete(function() {
	if ( jQuery(".lwa-status").hasClass("lwa-status-confirm") ) {
		location.reload(); 
	}
});
// jQuery("#location_load" ).click(function() {
	// jQuery(".lwa-register").hide();
// });

/*jQuery(".reply-link" ).click(function() {
jQuery(".lwa-modal,.lwa-modal-bg").addClass('hide');
});*/
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
#overlay{
  background-image: url("<?php bloginfo('template_url'); ?>/colorbox/loading.gif") center center no-repeat;
  position: fixed;
  top: 0%;
  left: 0%;
  width: 100%;
  height: 100%;
  background-color: black;
  opacity:.80;
  z-index:1001;
}
</style>
</head>

<?php $body_class = 'it-background woocommerce bp-page'; 
$category_id = it_page_in_category($post->ID);
if($category_id) $body_class .= ' category-' . $category_id;
?>

<body <?php body_class($body_class); ?>>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1722934004599404',
      xfbml      : true,
      version    : 'v2.1'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

    <div id="ajax-error"></div>
    
    <div id="fb-root"></div>
    
    <?php it_get_template_part('sticky'); #sticky bar ?>
    
    <?php #determine how far down and left to push main site content
    $sticky_disable = it_get_setting('sticky_disable_global');
    $csssticky = $sticky_disable ? ' no-sticky' : '';
	$nav_hidden = it_get_setting('nav_hidden');
	$nav_disable = it_get_setting('nav_disable');
	$cssnav = $nav_hidden || $nav_disable ? ' nav-hidden' : '';
    ?>
    
    <div class="after-header<?php echo $csssticky; ?>">
    
    	<div class="container-fluid no-padding">
        
        	<div class="row no-margin">
            
            	<div class="col-md-12 no-padding"> 
    


					<?php it_get_template_part('nav'); #sticky nav ?>




                    
                    	<div class="after-nav<?php echo $cssnav; ?>">
                        
                        	<?php if(it_get_setting('ad_header')!='') { #header ad ?>
                        
                                <div class="row it-ad" id="it-ad-header">
                                    
                                    <div class="col-md-12">
                                    
                                        <?php echo do_shortcode(it_get_setting('ad_header')); ?>  
                                        
                                    </div>                    
                                      
                                </div>
								
                            
                            <?php }
                            
  /*                          
if (isset($_POST['submit'])) {
    $_SESSION['test'] = $_POST['test'];
}*/
?>    
<!--<form method="post" action="" id="comform">
    <input type="hidden" value="<?php //echo isset($_SESSION['test']) ? $_SESSION['test'] : ''; ?>" name="test" id="comm" />
 <input type="submit" value="submit" name="submit" id="final" />
</form>-->
                            
                          
							<?php if(is_home()){ ?>
							<div class="search-area">

									<?php echo it_widget_panel($searcharea, $class); ?>

								</div>
								
								<?php } ?>
								<?php if((is_category()) || (is_tag()) || (is_search()))
								{
								
/*MULTI FILTER*/
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(is_search())
{
$exp_before_cat = explode("?",$actual_link);
//print_r($exp_before_cat);
$and_split = explode("&",$exp_before_cat[1]);
//print_r($and_split);

$final_type = explode("=",$and_split[0]);
$final_type = $final_type[1];
//print_r($final_type);

$final_loc = explode("=",$and_split[1]);
$final_loc = $final_loc[1];
$final_price = explode("=",$and_split[2]);
$final_price = $final_price[1];
$final_duration = explode("=",$and_split[3]);
$final_duration = $final_duration[1];
}

else if(((is_category()) || (is_tag())))
{

$exp_before_cat = explode("?",$actual_link);
$and_split = explode("&",$exp_before_cat[1]);
//$final_type = explode("=",$and_split[0]);
//print_r($exp_before_cat);

$pos = strpos($exp_before_cat[1],'cat=');

if($pos === false) {
$final_type="";
}
else
{
	$final_type = explode("=",$and_split[0]);
	
	}


if(empty($final_type))
{
//echo'type empty';
$final_type="";
$final_loc = explode("=",$and_split[0]);
//print_r($final_loc);
$final_loc = $final_loc[1];
//print_r($final_type);
$final_price = explode("=",$and_split[1]);
$final_price = $final_price[1];
$final_duration = explode("=",$and_split[2]);
$final_duration = $final_duration[1];
}
else
{
//echo 'type not empty';
$final_type = explode("=",$and_split[0]);
$final_type = $final_type[1];
//print_r($final_type);

$final_loc = explode("=",$and_split[1]);
$final_loc = $final_loc[1];
$final_price = explode("=",$and_split[2]);
$final_price = $final_price[1];
$final_duration = explode("=",$and_split[3]);
$final_duration = $final_duration[1];
}

}
/*ENDED*/ 
?>
<script>

 jQuery('#eventdp').on('change', function () {
  
	  var  landingUrl= jQuery('#city').val();
	  var priceUrl = jQuery('#price').val();
	  var  durationUrl= jQuery('#duration').val();
	  
	  if (landingUrl==null)
	  {
	  landingUrl="";
	  }
	  else if (priceUrl==null)
	  {
	  priceUrl="";
	  }
	  else if (durationUrl==null)
	  {
	  durationUrl="";
	  }
	  if(jQuery(this).val() == 0) 
	  {
	  queryUrl = "";
	  }
	  else
	  {
	  queryUrl = jQuery(this).val();
	  }  
	  var typeurl = MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,'type');
	  jQuery(location).attr('href', typeurl);
	  return false;
	  });
	 
	   jQuery('#location').on('change', function () {
	
	   var  queryUrl= jQuery('#eventdp').val();
	   var priceUrl = jQuery('#price').val();
	   var  durationUrl= jQuery('#duration').val();
	   

	   if (queryUrl==null)
	   {
	   queryUrl="";
	   }
	   else if (priceUrl==null)
	   {
	   priceUrl="";
	   }
	   else if (durationUrl==null)
	   {
	   durationUrl="";
	   }
	   
	   if(jQuery(this).val() == 0) 
	   {
	   landingUrl = "";
	   }
	   else
	   {
	   landingUrl = jQuery(this).val();
	   }
	   
	   var locationurl = MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,'location');
	   
		 jQuery(location).attr('href', locationurl);
		  return false;
	  });
	  
	   jQuery('#price').on('change', function () {
	   var  queryUrl= jQuery('#eventdp').val();
	   var  landingUrl= jQuery('#city').val();
	   var  durationUrl= jQuery('#duration').val();
	  
	  if (queryUrl==null)
	  {
	  queryUrl="";
	  }
	  else if (landingUrl==null)
	  {
	  landingUrl="";
	  }
	  else if (durationUrl==null)
	  {
	  durationUrl="";
	  }
	  if(jQuery(this).val() == 0)
	  {
	  priceUrl = "";
	  }
	  else
	  {
		priceUrl = jQuery(this).val();
	  }
		 var priceurl = MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,'price');
		  
		  jQuery(location).attr('href', priceurl);
		  return false;
	  });
	   jQuery('#duration').on('change', function () {
	   
	   
	   var  queryUrl= jQuery('#eventdp').val();
	   var priceUrl = jQuery('#price').val();
	   var  landingUrl= jQuery('#location').val();
	  
	  if (queryUrl==null)
	  {
	  queryUrl="";
	  }
	  else if (priceUrl==null)
	  {
	  priceUrl="";
	  }
	  else if (landingUrl==null)
	  {
	  durationUrl="";
	  }
		  if(jQuery(this).val() == 0) {
			 durationUrl = "";
		  } else {
			 durationUrl = jQuery(this).val();
		  }
		 var dururl = MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,'duration');
		 
		 jQuery(location).attr('href', dururl);
		 return false;
		 
	  });
</script>
<script>

	
	//var SourceUrl = "<?php echo $_SERVER["REQUEST_URI"] ;?>";
	

	function MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,event) {
	
		var SourceUrl = "<?php echo $_SERVER["REQUEST_URI"] ;?>";
		var cat = "?cat=";
		
	
		if(SourceUrl.indexOf('?') != -1)
		{ 
			var price = <?php echo json_encode($final_price); ?>;
			var durf = <?php echo json_encode($final_duration); ?>;
			var afterc = <?php echo json_encode($final_loc); ?>;
			var typeb = <?php echo json_encode($final_type); ?>;
		
		if(queryUrl != typeb)
		{		
			if(event != 'type')
			queryUrl = typeb;			
		}
		
		if(landingUrl != afterc){
			
			if(event != 'location')
			landingUrl = afterc;	
		}
		
		
		if(durationUrl != durf)
		{
		if(event != 'duration')
		durationUrl = durf;
		}
		if(priceUrl != price)
		{
		if(event != 'price')
			priceUrl = price;
		
		}
		
			var t= '?cat'+'='+ queryUrl + '&location='+ landingUrl+ '&price='+ priceUrl + '&duration='+durationUrl;
			var home = <?php echo json_encode($exp_before_cat[0]); ?>;
			var finalurLs=home+t;
			
			return(finalurLs);
			//return t;
		}
		else
		{
		var price = <?php echo json_encode($final_price); ?>;
			var durf = <?php echo json_encode($final_duration); ?>;
			var afterc = <?php echo json_encode($final_loc); ?>;
			var typeb = <?php echo json_encode($final_type); ?>;
				var finalUrL = cat + queryUrl + '&location='+ landingUrl+ '&price='+ priceUrl + '&duration='+durationUrl;
			    var currUrl=document.URL;
				var finalurLs=currUrl+finalUrL;
				
				return finalurLs;
				
		}
		
	
	   
	}
	
function highlight_options(field){
  var i,c;
  for(i in field.options){
    (c=field.options[i]).className=c.selected?'selected':'';
  }
}

jQuery( document ).ready( setvalue );

function setvalue(){
			var price = <?php echo json_encode($final_price); ?>;
			var durf = <?php echo json_encode($final_duration); ?>;
			var afterc = <?php echo json_encode($final_loc); ?>;
			var typeb = <?php echo json_encode($final_type); ?>;
						
							jQuery("#location").val(afterc);
							jQuery("#eventdp").val(typeb);
							jQuery("#price").val(price);
							jQuery("#duration").val(durf);
			}
	
</script>
<?php 
}
?>