<?php get_header(); # show header ?>

<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url=$_SERVER[REQUEST_URI];
$url_sub = explode("?",$url);
//print_r($url_sub);
$url_sub_part=explode("=",$url_sub[1]);
$url_sub_part1=explode(",",$url_sub[1]);
//print_r($url_sub_part1);
$durpr=explode("=",$url_sub_part1[1]);
//print_r($durpr);
$pricef=explode("&",$durpr[1]);
//print_r($pricef);
 $price_final=$pricef[0];
 $pricef=str_replace("%20"," ",$price_final) ;
 
  
$final_dur=$durpr[2];
$durf=str_replace("%20"," ",$final_dur) ;

$after_com=explode(",",$url_sub_part[1]);
//echo 'aftercom';print_r($after_com);
$aftercom_city=explode("&",$after_com[1]);
//print_r($aftercom_city);

 $aftercom_city=$aftercom_city[0];
 $beforecom_type=$after_com[0];

/*$pricedate=explode("&",$after_com[1]);
echo '&p';print_r($pricedate);
$before_com=explode(",",$url_sub_part[1]);

$type_f = $before_com[0];
*/

$actual_linkarray = explode('?',$actual_link);
//$actual_linkarray[0];
//global $a;
$a = explode("?",$getUrl);
$typeval=$_POST['event-dropdown'];

$cityval=$_POST['other-dropdown'];
//print_r($a);
$page = $_SERVER['REQUEST_URI'];
//print_r($page);
//$f_new_vis = true;
$new_vis = explode('/',$page);
//print_r($new_vis);
$arr_length=count($new_vis);
$get_index=$arr_length-1;
$search_keyword=$new_vis[$get_index];
//echo $search_keyword;

?>

<script>
   
var php_var = "<?php echo $search_keyword;?>";
  
jQuery(document).ready(function(){
	var cityval= "<?php echo $_POST['other-dropdown']; ?>";
	jQuery("#city").val(cityval);

	var typeval2= "<?php echo $_POST['event-dropdown']; ?>";
	jQuery("#eventdp").val(typeval2);
	
	var priceval= "<?php echo $_POST['price-dropdown']; ?>";
	jQuery("#price").val(priceval);
	
	var durationval= "<?php echo $_POST['duration-dropdown']; ?>";
	jQuery("#duration").val(durationval);

	
	jQuery('#uwpqsf_id_key').val(php_var);
	
	
	var queryUrl = "";
	var landingUrl = "";
	var priceUrl = "";
	var  durationUrl = "";
	  //For showing default url  
	  //MakeUrl();
		
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
	  
	  
		  if(jQuery(this).val() == 0) {
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
		
	   jQuery('#city').on('change', function () {
	   
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
	   
		  if(jQuery(this).val() == 0) {
			 landingUrl = "";
		  } else {
			 landingUrl = jQuery(this).val();
			 
		  }
		  var cityurl = MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,'city');
		 
		  jQuery(location).attr('href', cityurl);
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
	  
	   
		  if(jQuery(this).val() == 0) {
			 priceUrl = "";
			 
		  } else {
			 priceUrl = jQuery(this).val();
		  }
		 var priceurl = MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,'price');
		  
		  jQuery(location).attr('href', priceurl);
		  return false;
	  });
	   jQuery('#duration').on('change', function () {
	   
	   
	   var  queryUrl= jQuery('#eventdp').val();
	  var priceUrl = jQuery('#price').val();
	  var  landingUrl= jQuery('#city').val();
	  
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
	

});


</script>
<script>

	
	//var SourceUrl = "<?php echo $_SERVER["REQUEST_URI"] ;?>";
	

	function MakeUrl(queryUrl,landingUrl,durationUrl,priceUrl,event) {
	
		var SourceUrl = "<?php echo $_SERVER["REQUEST_URI"] ;?>";
		var cat = "?cat=";
		
	
		if(SourceUrl.indexOf(cat) != -1)
		{ 
		
		
		var price = <?php echo json_encode($price_final); ?>;
			var durf = <?php echo json_encode($final_dur); ?>;
			var afterc = <?php echo json_encode($aftercom_city); ?>;
			var typeb = <?php echo json_encode($beforecom_type); ?>;
			
			 
	
		
		if(queryUrl != typeb)
		{		
			if(event != 'type')
				queryUrl = typeb;			
		}
		
		if(landingUrl != afterc){
			
			if(event != 'city')
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
		
			var t= '?cat'+'='+ queryUrl + ',' + landingUrl+ '&price='+ priceUrl + '&duration='+durationUrl;
			var newsplidvalue= '<?php echo $a[1] ;?>';
			var st =SourceUrl.replace(newsplidvalue,t);
			
			var home = <?php echo json_encode($actual_linkarray[0]); ?>;
			var finalurLs=home+t;
			
			return(finalurLs);
			//jQuery('#MyLink').attr('action', t);
			
			
			return t;
		}
		else
		{
		
		
			
			
				var finalUrl = SourceUrl + cat + queryUrl + ',' + landingUrl + '&price='+ priceUrl + '&duration='+durationUrl;
				var finalUrL = cat + queryUrl + ',' + landingUrl + '&price='+ priceUrl + '&duration='+durationUrl;
				var newUrl=cat+queryUrl+','+landingUrl;
				jQuery('#urlBox').val(finalUrl);
				jQuery('#MyLink').attr('action', finalUrl);
				
				
				
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


			var price = <?php echo json_encode($price_final); ?>;
			var durf = <?php echo json_encode($final_dur); ?>;
			var afterc = <?php echo json_encode($aftercom_city); ?>;
			var typeb = <?php echo json_encode($beforecom_type); ?>;
			
			var pricef = <?php echo json_encode($pricef); ?>;
			var durff = <?php echo json_encode($durf); ?>;
						
							jQuery("#city").val(afterc);
							jQuery("#eventdp").val(typeb);
							jQuery("#price").val(pricef);
							jQuery("#duration").val(durff);
			}
	
</script>
<?php

#loop through builder panels
$builders = it_get_setting('search_builder');
if(!empty($builders) && count($builders) > 2) {
	foreach($builders as $builder) {
		it_shortcode($builder);			
	}
} else {
	echo do_shortcode('[blog title="Blog" icon="magazine"]');

} 
?>
<div id= 'search_result'></div>

<?php get_footer(); # show footer ?>