<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<?php _e( 'This post is password protected. Enter the password to view comments.', IT_TEXTDOMAIN ); ?>
	<?php
		return;
	}
?> 

<?php 
$type = 'comment'; //all
if(have_comments()) {
	$label = get_comments_number() . __(' Comments', IT_TEXTDOMAIN);
} else {
	$label = __('Comments', IT_TEXTDOMAIN);	
}
?>  

<script>
			jQuery(document).ready(function() {
			jQuery('#location_load').click();
			//$.noConflict();
			jQuery('.fancybox').fancybox();	
			});	
		
		</script>
<?php if ( is_user_logged_in() ):?>
			<script>
			
				jQuery(document).ready(function() {
					jQuery( "#submit" ).show();
					jQuery( "#custsubmit" ).hide();
					
				});
			
			</script>
			<?php
			
			else:?>
			<script>
			
			jQuery(document).ready(function() {
				jQuery( "#custsubmit" ).show();
					/*jQuery( "#submit" ).hide();*/
					
				});
				</script>
			<?php endif;
			?>
<?php
if(!is_user_logged_in()){
?>
<script>
    jQuery(document).ready(function($) { //noconflict wrapper
        $('#commentform input#submit').click(function(event){
		event.preventDefault();
            var left = (screen.width/2)-(600/2);
            var top = (screen.height/2)-(650/2);
            window.open("<?php echo get_site_url(); ?>/popup-login","pplogin","height=650,width=600,top=" + top + ", left=" + left + ",toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no");

		});
	
    });//end noconflict
    
    
    window.sucesslogin = function(){
		$('<div>', {id : 'overlay'}).appendTo('body');
        $('#commentform input#submit').attr('disabled','disabled');
         $.ajax({
            url: "<?php echo get_site_url(); ?>/wp-comments-post.php",
            type: "post",
            data: $('#commentform').serialize(),
            success: function(d) {
                //alert(d);
                //var bdy = $(d).find('body');
                //$("html").html($(d).find("head"));
                //$("html").html($(d).find("body"));
                //location.reload();
                //alert(window.location.href);
                window.location.href = window.location.href;
            }
        });
    }
    </script>
<?php
       
}
?>			
		

<div id="comments">

	<div class="bar-header full-width clearfix">
    	
        <div class="comment-header">
            <span class="theme-icon-commented"></span>
            <?php echo $label; ?>
        </div>
               
        <!--<a class="reply-link" href="http://www.proftrack.com/beta/wp-login.php?action=register"><?php //_e('Leave a Review ',IT_TEXTDOMAIN); ?></a>-->
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<a class="reply-link fancybox" id="location_load" href="#click"><?php _e('Leave a Review',IT_TEXTDOMAIN); ?></a>
		 <?php endif; ?>
		
        <?php if(get_comment_pages_count() > 1) { ?>
        
            <div class="pagination clearfix" data-number="<?php echo get_option('comments_per_page'); ?>" data-type="<?php echo $type; ?>">
            
                <?php $args = array(
                    'prev_text'    => '<span class="theme-icon-previous"></span>',
                    'next_text'    => '<span class="theme-icon-next"></span>',
                    'mid_size'     => '3',
                    'prev_next'	=> true );
                ?> 
                <?php paginate_comments_links($args); ?>
               
            </div>
            
        <?php } ?>
     
     </div>
    
     <ul class="comment-list">            
        <?php wp_list_comments('type='.$type.'&callback=it_comment&max_depth='.get_option('thread_comments_depth')); ?> 
     </ul>   
    
</div>



<?php if ( comments_open() ) : ?>

	<div id="reply-form" class="clearfix">

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        
            <p><?php _e('You must',IT_TEXTDOMAIN); ?>&nbsp;<a href="<?php echo wp_login_url(); ?>" title="<?php _e('log in',IT_TEXTDOMAIN); ?>"><?php _e('log in',IT_TEXTDOMAIN); ?></a>&nbsp;<?php _e('to post a comment',IT_TEXTDOMAIN); ?> </p>
            
		<div style="display:none;">
			<div id = "click">
						<?php login_with_ajax(); ?>
					</div>
				
			</div>
		
		
		<div style="display:none;">
			<div id = 'registration'>				
				<div id = "social">
					<p id = "sign_up">Sign Up</p>
					<?php do_action( 'wordpress_social_login'); ?>
					
				</div>
			
				<div id = 'registration_f' >
					<p id = "sign_up">OR SIGNUP WITH EMAIL:</p>
					<?php echo do_shortcode('[pie_register_form]'); ?>

				</div>
				<div id = 'terms'>
					<p class = 'terms_o'>We are committed to protecting your privacy.</p>
					<p class = 'terms_c'>By proceeding you agree to abide by our <a href = '#'>Privacy Statement</a> and our <a href = '#' >Terms and conditions </a>.</p>
				</div>

				
			</div>

		</div>


        
		<?php else : ?>
        
            <?php //dislay comment form		
			if(!it_get_setting('review_user_rating_disable') && it_get_setting('review_allow_blank_comments')) {
				$comment_placeholder = __('Additional Comments (optional)',IT_TEXTDOMAIN);
			} else {
				$comment_placeholder = __('Comment',IT_TEXTDOMAIN);
			}
			$fields = array();
			//$fields['author'] = '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="'.__('Name',IT_TEXTDOMAIN).'" />';
			//$fields['email'] = '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="'.__('E-mail',IT_TEXTDOMAIN).'" />';
			//$fields['website'] = '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.__('Website (optional)',IT_TEXTDOMAIN).'" />';
			$comment_field = '<textarea id="comment" class="form-control" name="comment" aria-required="true" rows="8" placeholder="'.$comment_placeholder.'"></textarea>';
			$title_reply = '<span class="theme-icon-pencil"></span>'.__( 'Leave a Review',IT_TEXTDOMAIN ).'';	
			$title_reply_to = '<span class="theme-icon-pencil"></span>'.__( 'Leave a Reply to %s',IT_TEXTDOMAIN ).'';	
            $commentargs = array(
                'comment_notes_before' => '',
                'comment_notes_after'  => '',
				'fields'               => $fields,
                'comment_field' 	   => $comment_field,
                'title_reply'          => $title_reply,
                'title_reply_to'       => $title_reply_to,
				'label_submit'         => __('Post',IT_TEXTDOMAIN),
            );
            ?>
        
            <?php comment_form($commentargs); ?> 
    
        <?php endif; // If registration required and not logged in ?>
    
    </div>
	
		
<?php endif; ?>
