<?php
/* Adding Theme Option Variables
/* ----------------------------------------------*/	
global $themename, $shortname, $announcement, $logo_path;

$demo_url = 'http://themetation.com/themes/mywordpress/wp-content/themes/my/inc/core';
$download_url = 'http://themeforest.net/item/my-wordpress/39678';
$support_url = 'http://themeforest.net/item/my-wordpress/discussion/39678';
$log_url = $demo_url.'/mywordpress_version.php';
$changed_url = $demo_url.'/change_log.html';

$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
$themeversion = $theme_data['Version'];	
$themename = __('My WordPress', 'my');
$shortname = __('mywp', 'my');
$announcement = '<div id="myarea" class="clearfix"><h2>'.$themename.' '.$themeversion.'</h2>
									<p>This is the custom theme option page for <strong>'.$themename.'</strong>, read each description to make sure it is setup correctly. 
									If you have any questions, please check the documentation file before posting questions on the support forum. Thanks!</p>
									</div>';	
//Access the WordPress Categories via an Array
$themetation_categories = array();  
$themetation_categories_obj = get_categories('hide_empty=1');
foreach ($themetation_categories_obj as $themetation_cat) {
    $themetation_categories[$themetation_cat->cat_ID] = $themetation_cat->cat_name;}
$themetation_tmp = array_unshift($themetation_categories, "Select a category:");
       
//Access the WordPress Pages via an Array
$themetation_pages = array();
$themetation_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($themetation_pages_obj as $themetation_page) {
    $themetation_pages[$themetation_page->ID] = $themetation_page->post_name; }   
$themetation_pages_tmp = array_unshift($themetation_pages, "Select a page:"); 

//Related Post Type
$layout = array("right_sidebar" => "Right Sidebar", "left_sidebar" => "Left Sidebar");
$related_type = array("tags_based" => "Based on tags", "cats_based" => "Based on categories");
$single_layout = 
	array(
	"normal-single-layout" => "Normal", 
	"author-bottom-with-excerpt" => "Last with author Box",
	"without-author-box-and-excerpt" => "No author box and excerpt",
	"without-thumbnail-excerpt-and-author-box" => "Basic, only content",
	"without-thumbnail-and-excerpt" => "No thumbnail and excerpt"
	);

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles';
$alt_stylesheets = array();

$logo_path = get_bloginfo('template_directory').'/styles/images/logo.png';

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//Number Options
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");

/* Start Options
/* ----------------------------------------------*/
$options = array (
	array(    
		"name" => "General Settings",
		"type" => "open"),
	array(    
		"name" => "Pick a Layout",
		"description" => "Choose the layout you like.",
		"id" => $shortname."_layout",
		"type" => "radio",
		"std" => "right_sidebar",
		"options" => $layout),	
	array(    
		"name" => "Pick a Color",
		"description" => "Choose which color scheme you want your website to have.",
		"id" => $shortname."_alt_stylesheet",
		"type" => "select",
		"std" => "black.css",
		"options" => $alt_stylesheets),
	array(
		"name" => "Enable Post Thumbnail",
		"id" => "index_layout",
		"type" => "checkbox",
		"description" => "Check to enable post thumbnail on every pages."),	
	array(
		"name" => "Enable Timthumb",
		"id" => "myscript",
		"type" => "checkbox",
		"description" => "Check to enable Timthumb script, a image auto-resized php script. Make sure your serive provide support the GD Lirary."),	
	array(
		"name" => "Logo Image",
		"id" => "mylogo",
		"type" => "text",
		"std" => $logo_path,
		"description" => "Image file name, with extension. Put your logo into the floder name LOGO."),
	array(
		"name" => "Image Preview",
		"id" => "mylogo",
		"type" => "image",
		"std" => $logo_path),
	array(  
		"name" => "Enable Breadcrumb",
		"id" => "bread",
    "type" => "checkbox",
    "std" => "false",
		"description" => "Check to display breadcrumb"),
	array(  
		"name" => "Feedburner Username",
		"id" => "rss",
    "type" => "text",
		"description" => "Feedburner username."),
	array(
		"name" => "Bottom Section",
		"type" => "section",
		"description" => "Logo in footer area, if it leave empty, the main logo will be re-used. If you have a bigger logo, you may need to upload a smaller logo here."),
	array(
		"name" => "Logo Image",
		"id" => $shortname."_bottom_logo",
		"type" => "text",
		"std" => $logo_path,
		"description" => "Image file name, with extension. Put your logo into the floder name LOGO."),
	array(
		"name" => "Image Preview",
		"id" => $shortname."_bottom_logo",
		"type" => "image",
		"std" => $logo_path),
	array(  
		"name" => "Quote",
		"id" => $shortname."_quote",
    "type" => "textarea",
		"description" => "Quote of the day. HTML allow Hello, I am &lt;a href=&quot;&quot;&gt;kailoon&lt;/a&gt;",
		"std" => "Hi! You can put anything here, be sure not exceed the limit."),
	array(
		"name" => "Custom Excerpt Length",
		"id" => "ex_length",
		"type" => "text",
		"std" => "50",
		"description" => "The length for the exceprt. This custom excerpt will disabled all formatting (including image) to be appeared in excerpt."),
	array(
		"name" => "Google Analytics",
		"id" => "analytics_code",
		"type" => "text",
		"description" => "Find the Account ID, starting with UA- in your account overview"),
	array(
		"name" => "Copyrights",
		"id" => $shortname."_credit",
		"type" => "textarea",
		"description" => "HTML allowed, by default. <br />It shows -  &copy; YEAR SITENAME."),
	array(
		"type" => "close"),
		
	array(
		"name" => "Categories",
		"type" => "open"),	
	array(
		"name" => "Tab Category 1",
		"id" => "cat1",
		"type" => "select",
		"options" => $themetation_categories,
		"description" => "First category at the bottom."),	
	array(
		"name" => "Tab Category 2",
		"id" => "cat2",
		"type" => "select",
		"options" => $themetation_categories,
		"description" => "Second category at the bottom."),
	array(
		"name" => "Mode",
		"id" => $shortname."_mode",
		"type" => "select",
		"std" => "date",
		"options" => array("rand","date"),
		"description" => "The order of the post, rand = random, date = latest to old."),		
	array(
		"type" => "close"),
		
	array(    
		"name" => "Singe Post Page",
		"type" => "open"),
	array(    
		"name" => "Layout",
		"type" => "radio",
		"std" => "normal-single-layout",
		"id" => "single_layout",
		"options" => $single_layout,
		"description" =>"Choose the layout option you like for the single post page."),
	array(    
		"name" => "Related Posts",
		"type" => "radio",
		"id" => "related_type",
		"std" => "tags_based",
		"options" => $related_type,
		"description" =>"Select the Related Posts Type."),
	array(
		"type" => "close"),	
		
	array(
		"name" => "Set Your Number",
		"type" => "open"),		
	array(
		"name" => "Recent Comment",
		"id" => "rpn",
		"type" => "text",
		"std" => "5",
		"description" => "Number of recent posts to be displayed in sidebar."),
	array(
		"name" => "Popular Post",
		"id" => "mc2",
		"type" => "text",
		"std" => "5",
		"description" => "Number of popular posts to be displayed after post."),
	array(
		"name" => "User Link Feed",
		"id" => "id8",
		"type" => "text",
		"description" => "Page ID for user link feed. Leave it blank if you want to disable this function."),
	array(
		"name" => "Number of User Link Feed in Sidebar",
		"id" => "wdn_count",
		"type" => "text",
		"std" => "5",
		"description" => "Insert the number of user link feed you want to display in the sidebar."),
	array(
		"type" => "close"),
	
	array(
		"name" => "Ad Management",
		"type" => "open"),
	array(
		"name" => "Leaderboard",
		"id" => $shortname."_leaderboard",
		"type" => "textarea",
		"description" => "Ad code for the leaderboard area, max width = 960px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"name" => "Sidebar Top Rectangle",
		"id" => $shortname."_top_ad",
		"type" => "textarea",
		"description" => "Ad code for the top rectangle ad in sidebar, max width = 300px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"name" => "Sidebar Bottom Rectangle",
		"id" => $shortname."_bottom_ad",
		"type" => "textarea",
		"description" => "Ad code for the bottom rectangle ad in sidebar, max width = 300px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),	
	array(
		"name" => "125 ads",
		"type" => "section",
		"description" => "Sections for ad banner iwth 125px width."),
	array(
		"name" => "Enable 125 ads section",
		"id" => $shortname."_small_ad",
		"type" => "checkbox",
		"description" => "Check to enable sidebar 125 ads. "),	
	array(
		"name" => "Sidebar 125 ads (1)",
		"id" => $shortname."_small_ad1",
		"type" => "textarea",
		"description" => "Ad code for the small ad, max width = 125px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"name" => "Sidebar 125 ads (2)",
		"id" => $shortname."_small_ad2",
		"type" => "textarea",
		"description" => "Ad code for the small ad, max width = 125px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"name" => "Sidebar 125 ads (3)",
		"id" => $shortname."_small_ad3",
		"type" => "textarea",
		"description" => "Ad code for the small ad, max width = 125px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"name" => "Sidebar 125 ads (4)",
		"id" => $shortname."_small_ad4",
		"type" => "textarea",
		"description" => "Ad code for the small ad, max width = 125px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"name" => "Sidebar 125 ads (5)",
		"id" => $shortname."_small_ad5",
		"type" => "textarea",
		"description" => "Ad code for the small ad, max width = 125px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"name" => "Sidebar 125 ads (6)",
		"id" => $shortname."_small_ad6",
		"type" => "textarea",
		"description" => "Ad code for the small ad, max width = 125px. HTML allow &lt;a href=&quot;&quot;&gt;&lt;img src=&quot;&quot; alt=&quot;&quot; /&gt;&lt;/a&gt;"),
	array(
		"type" => "close")
	);
?>