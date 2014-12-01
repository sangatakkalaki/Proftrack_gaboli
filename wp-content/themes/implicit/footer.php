<?php
#determine which columns to display
$col1 = __('Footer Column 1',IT_TEXTDOMAIN);
$col2 = __('Footer Column 2',IT_TEXTDOMAIN);
$col3 = __('Footer Column 3',IT_TEXTDOMAIN);
$class = 'widgets';
?>

					<?php if(it_get_setting('ad_footer')!='') { #footer adf ?>
                        
                        <div class="row it-ad" id="it-ad-footer">
                            
                            <div class="col-md-12">
                            
                                <?php echo do_shortcode(it_get_setting('ad_footer')); ?>  
                                
                            </div>                    
                              
                        </div>
                    
                    <?php } ?>

					<?php if(!it_get_setting('footer_disable')) { ?>
                        
                        <div class="container-fluid" id="footer">
                            
                            <div class="row no-margin">
                            
                                <div class="widget-panel left col-sm-4">
        
									<?php echo it_widget_panel($col1, $class); ?>
                                    
                                </div>
                            
                                <div class="widget-panel mid col-sm-4">
                                
                                    <?php echo it_widget_panel($col2, $class); ?>
                                    
                                </div>
                            
                                <div class="widget-panel right col-sm-4">
                                
                                    <?php echo it_widget_panel($col3, $class); ?>
                                    
                                </div> 
                                
                            </div> 
                            
                        </div>                            
                        
                    <?php } ?>
                    
                    <?php if(!it_get_setting('subfooter_disable')) { ?>
                        
                        <div class="container-fluid" id="subfooter">
                    
                            <div class="row no-margin">
                                
                                <div class="col-sm-6 copyright">
                                
                                    <?php if(it_get_setting('copyright_text')!='') { ?>
                                    
                                        <?php echo it_get_setting('copyright_text'); ?>
                                        
                                    <?php } else { ?>
                                    
                                        <?php _e( 'Copyright', IT_TEXTDOMAIN ); ?> &copy; <?php echo date("Y").' '.get_bloginfo('name'); ?>,&nbsp;<?php _e( 'All Rights Reserved.', IT_TEXTDOMAIN ); ?>
                                    
                                    <?php } ?>  
                                    
                                </div>
                                
                                <div class="col-sm-6 credits">
                                
                                    <?php if(it_get_setting('credits_text')!='') { ?>
                                    
                                        <?php echo it_get_setting('credits_text'); ?>
                                        
                                    <?php } else { ?>
                                    
                                        <?php _e( 'Fonts by', IT_TEXTDOMAIN); ?> <a href="http://www.google.com/fonts/"><?php _e( 'Google Fonts', IT_TEXTDOMAIN); ?></a>. <?php _e( 'Icons by', IT_TEXTDOMAIN); ?> <a href="http://fontello.com/"><?php _e( 'Fontello', IT_TEXTDOMAIN); ?></a>. <?php _e( 'Full Credits', IT_TEXTDOMAIN); ?> <a href="<?php echo CREDITS_URL; ?>"><?php _e( 'here &raquo;', IT_TEXTDOMAIN); ?></a>
                                    
                                    <?php } ?>                         
                                
                                </div>
                            
                            </div>
                            
                        </div>
                        
                    <?php } ?>
                    
				</div> <!--/after-nav-->
                
            </div> <!--/col-md-12-->
            
        </div> <!--/row-->
        
    </div> <!--/container-fluid-->

</div> <!--/after-header-->
<script>
jQuery('#location').on('change', function() {
  jQuery('.loading').css({'display':'block'});
});
jQuery('#eventdp').on('change', function() {
  jQuery('.loading').css({'display':'block'});
});
jQuery('#price').on('change', function() {
  jQuery('.loading').css({'display':'block'});
});
jQuery('#duration').on('change', function() {
  jQuery('.loading').css({'display':'block'});
  //jQuery('.filter .loading').show();
});

</script>

<script>
/*
var comVlue;
jQuery("#custsubmit").click(function()
{
var comVlue=jQuery("textarea#comment").val();
alert (comVlue);
jQuery('#comm').val(comVlue);

});

jQuery("#lwa_wp-submit,#wp-submit").click(function()
{
alert("hello");
jQuery('#final').click();
	


});
jQuery(document).ready(function() {
var lav=jQuery('#comm').val();
jQuery("textarea#comment").val(lav);
//jQuery("#submit").click();
});
*/

</script>

<script>
/*jQuery(document).ready(function() {
	jQuery('#wp-submit').on("click",function(){
    setTimeout(function(){
   window.location.reload();
}, 5000);
});
});*/
</script> 
	
<?php do_action('it_body_end'); ?>
<?php wp_footer(); ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
</body>

</html>
