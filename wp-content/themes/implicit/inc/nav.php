<?php
$postid = isset($post) ? $post->ID : '';
#setup sticky bar css
$sticky_disable=it_get_setting('sticky_disable_global');#is the sticky bar visible
$nav_disable=it_get_setting('nav_disable');#is the nav bar visible
$nav_hidden=it_get_setting('nav_hidden');#should the nav require toggle to display
$cssnav = $nav_hidden ? ' nav-hidden' : '';
$csssticky = $sticky_disable ? ' no-sticky' : '';
$cssadmin = is_admin_bar_showing() ? ' admin-bar' : '';
#new articles setup
$disable_new_articles = it_get_setting('new_articles_disable');
$timeperiod = it_get_setting('new_timeperiod');
if(empty($timeperiod)) $timeperiod = 'Today'; 
$prefix = it_get_setting('new_prefix');
if(!empty($prefix)) $prefix .= ' ';
$timeperiod_label = $prefix . it_timeperiod_label($timeperiod);
$number = it_get_setting('new_number');
if(empty($number)) $number = 16;
$label_override = it_get_setting('new_label_override');
if(!empty($label_override)) $timeperiod_label = $label_override;
#setup wp_query args
$args = array('posts_per_page' => $number);
#setup loop format
$format = array('loop' => 'menu', 'size' => 'menu');
#add time period to args
$day = date('j');
$week = date('W');
$month = date('n');
$year = date('Y');
switch($timeperiod) {
	case 'Today':
		$args['day'] = $day;
		$args['monthnum'] = $month;
		$args['year'] = $year;
		$timeperiod='';
	break;
	case 'This Week':
		$args['year'] = $year;
		$args['w'] = $week;
		$timeperiod='';
	break;	
	case 'This Month':
		$args['monthnum'] = $month;
		$args['year'] = $year;
		$timeperiod='';
	break;
	case 'This Year':
		$args['year'] = $year;
		$timeperiod='';
	break;
	case 'all':
		$timeperiod='';
	break;			
}
#perform the loop function to retrieve post count
$loop = it_loop($args, $format, $timeperiod);
$post_count = $loop['posts'];
if($post_count == 0) $disable_new_articles = true;  
#nav setup 
$section_menu_type = it_get_setting('section_menu_type');
$disable_section_menu_label = it_get_setting('section_menu_label_disable');
$section_menu_label = it_get_setting('section_menu_label');
$section_menu_label = !empty($section_menu_label) ? $section_menu_label : __('Our Sections',IT_TEXTDOMAIN);
$secondary_menu_position = it_get_setting('secondary_menu_position');
$disable_secondary_menu_label = it_get_setting('secondary_menu_label_disable');
$secondary_menu_label = it_get_setting('secondary_menu_label');
$secondary_menu_label = !empty($secondary_menu_label) ? $secondary_menu_label : __('Navigation',IT_TEXTDOMAIN);
$nav_widgets_label = it_get_setting('nav_widgets_label');
$nav_widgets_label = !empty($nav_widgets_label) ? $nav_widgets_label : __('Get In Touch',IT_TEXTDOMAIN);
$disable_nav_widgets = it_get_setting('nav_widgets_disable');
$disable_nav_widgets_label = it_get_setting('nav_widgets_label_disable');
?>

<?php if (!$nav_disable) { ?>
   
    <div id="sticky-nav" class="<?php echo $csssticky . $cssnav . $cssadmin; ?>"> 
    
    	<div id="sticky-nav-inner" class="sticky-nav-loop"> 
        
        	<div class="nav-toggle add-active"><span class="theme-icon-list"></span></div>                      
        
			<?php if(!$disable_new_articles) { ?>
                
                <div class="new-articles selector clearfix">
                
                    <div class="label-wrapper" title="<?php echo $timeperiod_label; ?>">
                    
                        <div class="new-number"><?php echo $post_count; ?></div>
                        
                        <div class="new-label"><?php _e('new',IT_TEXTDOMAIN); ?></div> 
                        
                        <div class="new-arrow"><span class="theme-icon-right-fat"></span></div> 
                        
                    </div>
                    
                </div>
                
            <?php } else { ?>
            
            	<div class="new-articles-placeholder"></div>
            
            <?php } ?>
            
            <?php if(!it_get_setting('search_disable')) { ?>
                    
                <div id="nav-search" class="info-right" title="<?php _e('Type and hit Enter',IT_TEXTDOMAIN); ?>">
                
                    <span class="theme-icon-search"></span>
                
                    <form method="get" id="searchformnav" action="<?php echo home_url(); ?>/">                             
                        <input type="text" placeholder="<?php _e( 'search', IT_TEXTDOMAIN ); ?>" name="s" id="s-nav" />          
                    </form>
                    
                </div>
                
            <?php } ?>
            
            <div id="section-menu" class="nav-menu">
            
                <?php 
                #get the secondary menu, stripping out title attributes
                $secondary_menu = preg_replace('/title=\"(.*?)\"/','',wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => false, 'fallback_cb' => '', 'echo' => false ) ) );
                
                #add wrapper
                $secondary_menu = '<div class="standard-menu">' . $secondary_menu . '</div>';
                
                #add nav label
                if(!$disable_secondary_menu_label) $secondary_menu = '<div class="nav-header">' . $secondary_menu_label . '</div>' . $secondary_menu;
                
                #Secondary Menu (if before Section menu)
                if($secondary_menu_position=='before') echo $secondary_menu;
                
                if($section_menu_type!='none') {
                
                    if(!$disable_section_menu_label) { ?><div class="nav-header"><?php echo $section_menu_label; ?></div><?php }
                                    
                    #Section Menu
                    switch($section_menu_type) {
                        case 'standard':
                            #get the section menu, stripping out title attributes
                            $section_menu = preg_replace('/title=\"(.*?)\"/','',wp_nav_menu( array( 'theme_location' => 'section-menu', 'container' => false, 'fallback_cb' => 'fallback_categories', 'echo' => false ) ) );
                            echo '<div class="standard-menu sticky-nav-menu">' . $section_menu . '</div>';
                        break;
                        case 'mega':  
                            #get the mega menu
                            $mega_menu = it_section_menu();                                      
                            echo '<div class="mega-menu sticky-nav-menu">' . $mega_menu . '</div>';
                        break;
                    }
                } 
                 
                #Secondary Menu (if after Section menu)
if(!is_search()){
                if($secondary_menu_position=='after') echo $secondary_menu;
               }
?>

<?php
if(is_search()){
echo '</br>';
//echo do_shortcode('[ULWPQSF id=846]'); 	$getUrl=$_SERVER['REQUEST_URI'];global $a;$a = explode("?",$getUrl);?><form method="Post" action="" id="MyLink" name="myform"><br/><div class="selectdiv">	<select name="other-dropdown" onchange="highlight_options(this)" id="city"> 	 <option value=""><?php echo esc_attr(__(strtoupper ('City'))); ?></option> 	 <?php 	  $categories = get_categories('child_of=68'); 	  foreach ($categories as $category) {		$option = '<option id="'.$category->cat_ID.'" value="'.$category->cat_ID.'">';		$option .= strtoupper ($category->cat_name);		$option .= '</option>';		echo $option;	  }	 ?>	</select>	<br/>	<select name="event-dropdown" id="eventdp"> 	 <option id="tp" value=""><?php echo esc_attr(__(strtoupper ('Type'))); ?></option> 	 <?php 	  $categoriestype = get_categories('child_of=65'); 	  foreach ($categoriestype as $categorytype) {		$option = '<option id="'.$category->cat_ID.'" value="'.$categorytype->cat_ID.'">';		$option .= strtoupper ($categorytype->cat_name);		$option .= '</option>';		echo $option;	  }	 ?>	</select>	<br/>	<select name="price-dropdown" id="price"> 	<option id="pr" value=""><?php echo esc_attr(__(strtoupper ('Price'))); ?></option> 	 <?php 	   $priceTerms =  get_terms("price",array('orderby'    => 'ID'));	  foreach ($priceTerms as $priceTerm) {	  		$option = '<option id="'.$priceTerm->id.'" value="'.$priceTerm->name.'">';		$option .= strtoupper ($priceTerm->name);		$option .= '</option>';		echo $option;	  }	 ?>	</select>	<br/>	<select name="duration-dropdown" id="duration"> 	<option id="du" value=""><?php echo esc_attr(__(strtoupper ('Duration'))); ?></option> 	 <?php 	   $durationTerms =  get_terms("duration",array('orderby'    => 'ID'));	  foreach ($durationTerms as $durationTerm) {	  		$option = '<option id="'.$durationTerm->id.'" value="'.$durationTerm->name.'">';		$option .= strtoupper ($durationTerm->name);		$option .= '</option>';		echo $option;	  }	 ?>	</select></div><div class="submitdiv"><!--<input type="Submit" value="Filter" id="submitval" />--></div></form>
<?php } ?>
<?php
if(is_page('search-2'))
{
echo do_shortcode('[ULWPQSF id=846]');
}
?>

            
            </div>
            
            <?php if(!$disable_nav_widgets) { ?>
            
            	<div id="nav-widgets">
            
            		<?php if(!$disable_nav_widgets_label) echo '<div class="nav-header">' . $nav_widgets_label . '</div>'; ?>
                    
                    <?php if(!it_get_setting('nav_widgets_email_disable')) { ?>
                        
						<?php echo it_email_form(); ?>
                        
                    <?php } ?>
                    
                    <?php if(!it_get_setting('nav_widgets_counts_disable')) { ?>
                    
                    	<?php 
						$disabled = ( is_array( it_get_setting("social_counts_disable") ) ) ? it_get_setting("social_counts_disable") : array();
						
						$twitter = !in_array('twitter', $disabled) ? true : false;
						$facebook = !in_array('facebook', $disabled) ? true : false;
						$gplus = !in_array('gplus', $disabled) ? true : false;
						$youtube = !in_array('youtube', $disabled) ? true : false;
						#$pinterest = !in_array('pinterest', $disabled) ? true : false;
						$pinterest = false;
						
						$args = array('twitter' => $twitter, 'facebook' => $facebook, 'gplus' => $gplus, 'youtube' => $youtube, 'pinterest' => $pinterest);
						echo it_get_social_counts($args);
						?>
                    
                    <?php } ?>
                    
                </div>
            
            <?php } ?>
            
            <?php if(!$disable_new_articles) { ?>
            
            	<div class="new-articles post-container">
                                    
                    <?php echo $loop['content']; wp_reset_query(); ?>
                    
                </div>
                
            <?php } ?>
            
        </div>
        
    </div>

<?php } wp_reset_query();?>