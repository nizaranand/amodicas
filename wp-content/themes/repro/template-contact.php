<?php
/*
Template Name: Contact
*/
?>

<?php 
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Please enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = 'Please enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$commentError = 'Please enter a message.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = get_option('tz_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>
<?php get_header(); ?>

<div id="the_body">
    
    <div class="container_12">
        
        <div class="grid_8" id="archive">
            
            <?php if (have_posts()) : while (have_posts()) : the_post();?>
            
            <div class="grid_8 alpha omega">
            
                <?php if ( function_exists('yoast_breadcrumb') ) : ?> <div class="breadcrumb"><?php yoast_breadcrumb(); ?></div><!--breadcrumb--><?php endif; ?>
                
                <div class="description">
                
                    <h1><?php the_title(); ?></h1>
                     
                </div><!--description-->
               
                <div class="clear"></div>
                
            </div><!--grid_8 alpha omeg-->
            
            <div class="grid_8 alpha omega">
            
                <div id="content">

                    <?php the_content(); ?>
                    
                    <?php if(isset($emailSent) && $emailSent == true) { ?>

					<div class="thanks">
						<p><?php _e('Thanks, your email was sent successfully.', 'framework') ?></p>
					</div>

					<?php } else { ?>
		
					<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p class="error"><?php _e('Sorry, an error occured.', 'framework') ?><p>
					<?php } ?>
	
					<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
						
						<p>
						<label for="contactName"><?php _e('Name', 'framework') ?></label>
						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
                        </p>
								<?php if($nameError != '') { ?>
									<span class="error"><?=$nameError;?></span> 
								<?php } ?>
				
						<p>
						<label for="email"><?php _e('Email', 'framework') ?></label>
						<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
                        </p>
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
				
						<p>
						<label for="comments"><?php _e('Message', 'framework') ?></label>
						<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea></p>
								<?php if($commentError != '') { ?>
									<span class="error"><?=$commentError;?></span> 
								<?php } ?>

				

						<p><input type="hidden" name="submitted" id="submitted" value="true" />
						<button class="btn" type="submit"><?php _e('Send Email', 'framework') ?></button></p>

					</form>
                    
				<?php } ?>
                    
                    <div class="clear"></div>
                
                </div><!--content-->

            </div><!--grid_8 alpha omega-->
            
            <?php endwhile; else: ?>
            
            <?php wp_reset_query(); ?>
            
            <?php endif; ?>

        </div><!--grid_8-->
        
        <div class="grid_4">
        
            <?php get_sidebar(); ?>
          
        </div><!--grid_4-->

        <div class="clear"></div>
        
    </div><!--container_12-->

</div><!--the_body-->

<?php get_footer(); ?>