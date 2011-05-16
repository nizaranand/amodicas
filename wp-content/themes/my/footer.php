<div id="footer">
	<div class="wrapper2">
    	<div class="credit">
        	<span><?php if(get_option('mywp_credit') <> null) { echo stripslashes(get_option('mywp_credit')); } else { ?>&copy; <?=date("Y");?> <?php bloginfo('blogname'); }?>. </span>
					<em><?php _e('Designed by','my') ?> <a href="http://themetation.com">Themetation</a></em>
        </div>
    </div>
    <div class="clear"></div>
</div>	

<?php wp_footer(); ?>
<?php if(get_option('analytics_code') <> null) { themetation_google_analytics(); }?>

</body>
</html>
