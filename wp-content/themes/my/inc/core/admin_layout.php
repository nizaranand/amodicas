<?php
	function themetation_options(){
		global $shortname, $themename;
		add_theme_page($themename, 'Theme Settings', 'administrator', $shortname, 'themetation_admin');  // Add Theme Option Menu.
	} 

function themetation_admin() {
	global $options, $themename, $shortname, $themeversion, $announcement, $support_url, $changed_url;
	echo '<div class="wrap clearfix">';		
	
	if (isset($_POST['save_all'])) :
  	foreach ($options as $value) {     
			update_option($value['id'], $_POST[$value['id']]);
			}
			echo '<div id="message" class="updated fade"><p><strong>Update Sucess</strong></p></div>'; //echo success message
  endif;
  
  if(isset($_POST['reset_all'])) :
  	foreach ($options as $value) {
		delete_option( $value['id'], $_POST[$value['id']]); 
		}echo '<div id="message" class="updated fade"><p><strong>Data Reset</strong></p></div>'; //echo reset message
	endif;
	
	echo $announcement; //theme announcement - refer theme_options.php line 9
?>
	<form id="options_form" method="post" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'template_directory' ); ?>/inc/core/style.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/inc/core/tt_admin.js"></script>
	
	<p class="t_r clearfix">
		
		<a href="<?php echo $changed_url; ?>" target="_blank"><span class="logs"><br /></span>Changed Logs</a>
		<a href="<?php echo $support_url; ?>" target="_blank"><span class="support"><br /></span>Support</a>
		
		<input name="reset_all" type="submit" value="Reset to default values" class="button" />
		<input name="save_all" type="submit" value="Save changes" class="button-primary autowidth" />
	
	</p>
	
	<div id="tabs" class="clearfix">
	<ul>

	<?php // Navigation
		$i = 1;
		foreach ($options as $value) {
		
			if($value['type']=='open'){?>
			<li><a href="#a-<?php echo($i); ?>"><?php echo $value['name']; ?></a></li>
			<?php
			$i++;
			}
		}
	?>
	</ul>
	
	<div class="tabcontent">
	<?php // Start Theme Option Interface
	$i = 0;
	foreach ($options as $value) { 

	switch ( $value['type'] ) {

    ###########################
		# OPEN
		###########################
		case 'open':
			
			$i++;
			echo '<div id="a-'.$i.'">';
			
		break;
		###########################
		# CLOSE
		###########################
		case 'close':
			echo '</div>';
			
		break;
		###########################
		# TITLE
		###########################
		case 'title':
			echo '<h1>'.$value['name'].'</h1>';
			
		break;
		###########################
		# SECTION
		###########################
		case 'section':
			echo '<div class="myrow section">';
			echo '<h3>'.$value['name'].'</h3>';
			echo '<p>'.$value['description'].'</p></div>';	
			
		break;
		###########################
		# TEXT
		###########################
			case 'text':
			echo '<div class="myrow">';
			echo '<div class="mydesc"><h3>'.$value['name'].'</h3>'.$value['description'].'</div>';
			echo '<div class="myinput"><input type="'.$value['type'].'" size="'.$value['size'].'" value="';
			
			if ( get_option( $value['id'] ) != '') { 
				echo htmlentities(stripslashes( get_option( $value['id'] ))); } 
					else { echo stripslashes( $value['std'] ); 
					}
			echo '" id="'.$value['id'].'" name="'.$value['id'].'"/>';

			echo '</div></div>';   
		            								
    break;
		###########################
		# SELECT
		###########################
			case 'select';
			echo '<div class="myrow">';
			echo '<div class="mydesc"><h3>'.$value['name'].'</h3>'.$value['description'].'</div>';
			echo '<div class="myinput"><select class="mee-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option) {
				
				$selected = '';
				
				 if($select_value != '') {
						if ( $select_value == $option) { $selected = ' selected="selected"';} 
				   } else {
					if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				   }
				  
				 echo '<option'. $selected .'>';
				 echo $option;
				 echo '</option>';
			 
			 } 
			 echo'</select>';
  		echo '</div></div>';
  		
		break;
		###########################
		# RADIO
		###########################
			case 'radio';
			echo '<div class="myrow">';
			echo '<div class="mydesc"><h3>'.$value['name'].'</h3>'.$value['description'].'</div>';
			echo '<div class="myinput radio">';
			$select_value = get_option( $value['id']);
				   
			 foreach ($value['options'] as $key => $option) 
			 { 

				 $checked = '';
				 
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				echo '<p><label for="'. $key .'">' . $option . '</label><input class="kradio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' id="'. $key .'" /></p>';
			
			}
			echo '</div></div>';
		break;
		###########################
		# CHECKBOX
		###########################
    	case 'checkbox':
			if(get_option($value['id'])){ $checked = "checked=\"checked\""; } else { $checked = ""; }
			echo '<div class="myrow">';
			echo '<div class="mydesc">';
			echo '<h3>'.$value['name'].'</h3><label for="'.$value['id'].'">'.$value['description'].'</label></div>';
			echo '<div class="myinput check"><input class="kcheck" type="checkbox" name="'.$value['id'].'" id="'.$value['id'].'" value="true"  '.$checked.' />';
			echo '</div></div>';
    
    break;
		###########################
		# IMAGE
		###########################
    	case 'image':
			echo '<div class="myrow"><h3>'.$value['name'].'</h3>';
			echo '<img src="';
				if ( get_option( $value['id'] ) != '') { 
					echo stripslashes( get_option( $value['id'] ) ); } 
						else { echo stripslashes( $value['std'] ); }
            echo '"  />';
			echo '<label for="'.$value['id'].'">'.$value['description'].'</label>';
			echo '</div>';
		
		break;
		###########################
		# AD125
		###########################
    	case 'ad125' :
			echo '<div class="myrow full"><textarea name="'.$value['id'].'" rows="'.$value['size'].'" id="'.$value['id'].'">';
				if ( get_option( $value['id'] ) != "") { echo stripslashes( get_option( $value['id'] ) ); } else { echo stripslashes( $value['std'] ); }
			echo '</textarea><br/>';
			echo '</div>';
			
		break;
		###########################
		# TEXTAREA
		###########################
    	case 'textarea' :
			echo '<div class="myrow">';
			echo '<div class="mydesc"><h3>'.$value['name'].'</h3>'.$value['description'].'</div>';
			echo '<div class="myinput"><textarea name="'.$value['id'].'" rows="'.$value['size'].'" id="'.$value['id'].'">';
				if ( get_option( $value['id'] ) != "") { echo stripslashes( get_option( $value['id'] ) ); } else { echo stripslashes( $value['std'] ); }
			echo '</textarea><br/>';
			echo '</div></div>';   
		break;									
    }}
    
	echo '</div></div>';
	echo '<p class="t_r">';
	echo '<input name="save_all" type="submit" value="Save changes" class="button-primary autowidth" /></p>';
  echo '</form></div>';	
  
	}
	add_action('admin_menu','themetation_options'); // add menu
?>