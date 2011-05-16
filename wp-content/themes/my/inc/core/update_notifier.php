<?php
/**
 * Provides a notification everytime the theme is updated
 * Original code courtesy of João Araújo of Unisphere Design - http://themeforest.net/user/unisphere
 */
function update_notifier_menu() {  
	global $log_url, $themename, $changed_url, $new_ver;
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); // Get theme data from style.css (current version is what we want)
	
	function get_data($log_url){
  $crl = curl_init();
  $timeout = 5;
  curl_setopt ($crl, CURLOPT_URL,$log_url);
  curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
  $ret = curl_exec($crl);
  curl_close($crl);
  return $ret;
	}
	
	if( get_data($log_url) > $theme_data['Version']) { // Test current version against the new version, if there's a new one display a new Dashboard sub-menu item
		add_dashboard_page( $theme_data['Name'] . 'Theme Updates', 'Theme Updates <span class="update-plugins count-1"><span class="update-count">New</span></span>', 'administrator', '', update_notifier);
	}
	$new_ver = get_data($log_url);
}  

add_action('admin_menu', 'update_notifier_menu');

function update_notifier() { 
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); // Get theme data from style.css (current version is what we want)
	global $changed_url, $new_ver; ?>
	<div class="wrap">
		
		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>
	   
	  <div id="message" class="updated below-h2">
	  	<p><strong>There is a new version of the <?php echo $theme_data['Name']; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Update to version <strong><?php echo $new_ver; ?></strong>.
	  	</p>
	  </div>
 
    <div id="instructions" style="padding-bottom: 5px; border-bottom: 1px solid #ccc; position: relative;width:420px;padding-left:320px;">
    	<img style="position:absolute;top:0;left:0;" src="<?php echo get_bloginfo( 'template_url' ) . '/screenshot.png'; ?>" />
    	
      <h3>Update Download and Instructions</h3>
      <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo strtolower($theme_data['Name']); ?>/</strong></p>
      <p>To update the Theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>downloads</strong> section and re-download the theme like you did when you bought it.</p>
      <p>Extract the zip's contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo strtolower($theme_data['Name']); ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
      <p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.</p>
    </div>
	  
	  <iframe frameborder="0" scrolling="yes" src="<?php echo $changed_url; ?>" width="800px" height="700px"></iframe>

	</div>
    
<?php } ?>