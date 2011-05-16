<?php 
if(get_option('mywp_small_ad') <> null) { 

	echo '<div class="small-ad">';
  
  if(get_option('mywp_small_ad1') <> null) { echo stripslashes(get_option('mywp_small_ad1')); }
  if(get_option('mywp_small_ad2') <> null) { echo stripslashes(get_option('mywp_small_ad2')); }
  if(get_option('mywp_small_ad3') <> null) { echo stripslashes(get_option('mywp_small_ad3')); }
  if(get_option('mywp_small_ad4') <> null) { echo stripslashes(get_option('mywp_small_ad4')); }
  if(get_option('mywp_small_ad5') <> null) { echo stripslashes(get_option('mywp_small_ad5')); }
  if(get_option('mywp_small_ad6') <> null) { echo stripslashes(get_option('mywp_small_ad6')); }
  echo '</div>';
} ?>