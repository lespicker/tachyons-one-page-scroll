<?php

function woo_options(){

// VARIABLES
$themename = "Irresistible";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/irresistible/';
$shortname = "woo";

$GLOBALS['template_path'] = get_bloginfo('template_directory');

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       


//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$all_uploads_path = get_bloginfo('home') . '/wp-content/uploads/';
$all_uploads = get_option('woo_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// THIS IS THE DIFFERENT FIELDS
$options = array();   

$options[] = array(	"name" => "General Settings",
					"type" => "heading");
						
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feedburner_url",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");		

$options[] = array(	"name" => "Customized Homepage",
					"type" => "heading");	

$options[] = array(	"name" => "Enable homepage",
					"desc" => "Check this to use the customized homepage (located in custom-home.php). You must setup the settings underneath also.",
					"id" => $shortname."_home",
					"std" => "false",
					"type" => "checkbox");	

$options[] = array(	"name" => "Number of posts",
					"desc" => "Enter the number of posts you want to display under MyWritings.",
					"id" => $shortname."_home_posts",
					"std" => "",
					"type" => "text");			

$options[] = array(	"name" => "Lifestream posts",
					"desc" => "Enter the number of posts you want to display under MyLifestream. You must have the <a href=\"http://wordpress.org/extend/plugins/lifestream/\">Lifestream</a> plugin installed",
					"id" => $shortname."_home_lifestream",
					"std" => "",
					"type" => "text");			

$options[] = array(	"name" => "Flickr ID",
					"desc" => "Enter your Flickr ID here. Use <a href=\"http://www.idgettr.com\">IDGettr</a> to find it.",
					"id" => $shortname."_home_flickr_user",
					"std" => "",
					"type" => "text");			

$options[] = array(	"name" => "Flickr count",
					"desc" => "Enter how many flickr photos you want to display. Max 10.",
					"id" => $shortname."_home_flickr_count",
					"std" => "",
					"type" => "text");			

$options[] = array(	"name" => "Flickr URl",
					"desc" => "Enter the URl to your flickr account here.",
					"id" => $shortname."_home_flickr_url",
					"std" => "",
					"type" => "text");			

$options[] = array(	"name" => "Archives URl",
					"desc" => "Enter the URl to archive page template e.g. http://mysite.com/archives/. To make an archive page: Add new page with page template 'Archive Page'.",
					"id" => $shortname."_home_archives",
					"std" => "",
					"type" => "text");			

$options[] = array(	"name" => "Blog Layout Options",
					"type" => "heading");	

$options[] = array(	"name" => "Left Sidebar",
					"desc" => "Check this to show the sidebar on the left side instead of right.",
					"id" => $shortname."_mainright",
					"std" => "false",
					"type" => "checkbox");	

$options[] = array(	"name" => "Category Navigation?",
					"desc" => "Check this to show categories instead of pages in the top navigation.",
					"id" => $shortname."_nav",
					"std" => "false",
					"type" => "checkbox");	

$options[] = array(	"name" => "Disable Tabs?",
					"desc" => "Check this to disable the sidebar tabs.",
					"id" => $shortname."_tabs",
					"std" => "false",
					"type" => "checkbox");	

$options[] = array(	"name" => "Disable Video?",
					"desc" => "Check this to disable the sidebar video widget.",
					"id" => $shortname."_video",
					"std" => "false",
					"type" => "checkbox");	

$options[] = array(	"name" => "About You",
					"type" => "heading");	

$options[] = array(	"name" => "About You Snippet",
					"desc" => "Include a little snippet about yourself that is displayed in the header.",
					"id" => $shortname."_about",
					"std" => "",
					"type" => "textarea");	

$options[] = array(	"name" => "About You Read More Link",
					"desc" => "URL of the read more link e.g. http://www.yoursite.com/about",
					"id" => $shortname."_aboutlink",
					"std" => "#",
					"type" => "text");	

$options[] = array(	"name" => "Banner Ads Sidebar - Widget (125x125)",
					"type" => "heading");

$options[] = array(	"name" => "Rotate banners?",
					"desc" => "Check this to randomly rotate the banner ads.",
					"id" => $shortname."_ads_rotate",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Banner Ad #1 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_1",
					"std" => "http://www.woothemes.com/ads/woothemes-125x125-1.gif",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #1 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_1",
					"std" => "http://www.woothemes.com",
					"type" => "text");						

$options[] = array(	"name" => "Banner Ad #2 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_2",
					"std" => "http://www.woothemes.com/ads/woothemes-125x125-2.gif",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #2 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_2",
					"std" => "http://www.woothemes.com",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #3 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_3",
					"std" => "http://www.woothemes.com/ads/woothemes-125x125-3.gif",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #3 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_3",
					"std" => "http://www.woothemes.com",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #4 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_4",
					"std" => "http://www.woothemes.com/ads/woothemes-125x125-4.gif",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #4 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_4",
					"std" => "http://www.woothemes.com",
					"type" => "text");                                             

update_option('woo_template',$options);      
update_option('woo_themename',$themename);   
update_option('woo_shortname',$shortname);
update_option('woo_manual',$manualurl);

                                     
// Woo Metabox Options
                    

$woo_metaboxes = array(

        "embed" => array (
            "name"  => "embed",
            "std"  => "",
            "label" => "Embed Code",
            "type" => "textarea",
            "desc" => "Enter the video embed code for your video. Add <strong>video</strong> as a tag in your post to make your video appear in the sidebar video widget."
        )

    );
    
update_option('woo_custom_template',$woo_metaboxes);      

/*
function woo_update_options(){
        $options = get_option('woo_template',$options);  
        foreach ($options as $option){
            update_option($option['id'],$option['std']);
        }   
}

function woo_add_options(){
        $options = get_option('woo_template',$options);  
        foreach ($options as $option){
            update_option($option['id'],$option['std']);
        }   
}


//add_action('switch_theme', 'woo_update_options'); 
if(get_option('template') == 'wooframework'){       
    woo_add_options();
} // end function 
*/


}

add_action('init','woo_options');  

?>