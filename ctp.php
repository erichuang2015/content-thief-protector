<?php ob_start();
/**
* Plugin Name: Content Thief Protector
* Plugin URI: https://wordpress.org/plugin/content-thief-protector
* Description: This plugin protect your content from being copied by Content Thief. Protect your content without any hassle!!
* Version: 1.0.0
* Author: MD Masud Sikdar
* Text Domain: ctp_lang
* Domain Path: /languages
* Author URI: https://www.mdmasudsikdar.com/
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//---------------------------------------------------------------------------------------------
//Load plugin textdomain to load translations
//---------------------------------------------------------------------------------------------
function ctp_textdomain_load() {
  load_plugin_textdomain( 'ctp_lang', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

//---------------------------------------------------------------------------------------------
//Report any error during activation
//---------------------------------------------------------------------------------------------
register_activation_hook( __FILE__, 'ctp_main_my_activation_func' ); function ctp_main_my_activation_func() {
    file_put_contents(__DIR__.'/my_loggg.txt', ob_get_contents());
}

//---------------------------------------------------------------------------------------------
//define all variables the needed alot
//---------------------------------------------------------------------------------------------
$ctp_pluginsurl = plugins_url( '', __FILE__ );

include "common-functions.php";
$ctp_main_settings = ctp_main_read_options();
include "controls-functions.php";
include "private-functions.php";
include "js_functions.php";
include "css_functions.php";
include "play_functions.php";

$dw_query = '';

function ctp_main_add_htaccess($insertion) {
    $htaccess_file = ABSPATH.'.htaccess';
	$filename = $htaccess_file;
	if (is_writable($filename)) {
		ctp_main_insert_with_markers_htaccess($htaccess_file, 'ctp_main_image_protection', '');//This will always clear the old watermarking rules
		return ctp_main_insert_with_markers_htaccess($htaccess_file, 'ctp_main_image_protection', (array) $insertion);
	} else {
		echo 'The file is not writable';
	}
}
//---------------------------------------------------------------------------------------------
//Register libraries using new wordpress register_script & enqueue_script functions
//---------------------------------------------------------------------------------------------
function ctp_main_modify_htaccess() {
	
	$ctp_main_settings = ctp_main_read_options();
	$pluginsurl = plugins_url( '', __FILE__ );
	$url = site_url();
	$url = ctp_main_get_domain($url);
	$hotlinking_rule_text = 'RewriteRule ^.*$ - [NC,L]';
	$mysite_rule_text = 'RewriteRule ^.*$ - [NC,L]';
	
	$type = 'dw';
	$dw_position = $ctp_main_settings['dw_position'];
	$dw_text = $ctp_main_settings['dw_text'];
	$dw_r_text = $ctp_main_settings['dw_r_text'];
	$dw_font_color = $ctp_main_settings['dw_font_color'];
	$dw_r_font_color = $ctp_main_settings['dw_r_font_color'];
	$dw_font_size_factor = $ctp_main_settings['dw_font_size_factor'];
	$dw_r_font_size_factor = $ctp_main_settings['dw_r_font_size_factor'];
	$dw_text_transparency = $ctp_main_settings['dw_text_transparency'];
	$dw_rotation = $ctp_main_settings['dw_rotation'];
	$dw_imagefilter = $ctp_main_settings['dw_imagefilter'];
	$dw_signature = $ctp_main_settings['dw_signature'];
	$dw_logo = $ctp_main_settings['dw_logo'];
	$dw_margin_left_factor = $ctp_main_settings['dw_margin_left_factor'];
	$dw_margin_top_factor = $ctp_main_settings['dw_margin_top_factor'];
	$watermark_caching = $ctp_main_settings['watermark_caching'];
	$upload_dir = wp_upload_dir();
	$basedir = $upload_dir['basedir'];  //   /home3/server-folder/sitefoldername.com/wp-content/uploads
	$home_path = get_home_path();
	
	
	$file_content = '<?php' . "\n";
	$file_content .= '$watermark_caching = "' .$watermark_caching. '";' . "\n";
	$file_content .= '$watermark_type = "' .$type. '";' . "\n";
	$file_content .= '$watermark_position = "' .$dw_position. '";' . "\n";
	$file_content .= '$watermark_r_text = "' .$dw_r_text. '";' . "\n";
	$file_content .= '$r_font_size_factor = "' .$dw_r_font_size_factor. '";' . "\n";
	$file_content .= '$watermark_text = "' .$dw_text. '";' . "\n";
	$file_content .= '$font_size_factor = "' .$dw_font_size_factor. '";' . "\n";
	$file_content .= '$pure_watermark_stamp_image = "' .$dw_logo. '";' . "\n";
	
	$file_content .= '$margin_left_factor = "' .$dw_margin_left_factor. '";' . "\n";
	$file_content .= '$margin_top_factor = "' .$dw_margin_top_factor. '";' . "\n";
	$file_content .= '$watermark_color = "' .$dw_font_color. '";' . "\n";
	$file_content .= '$watermark_r_color = "' .$dw_r_font_color. '";' . "\n";
	$file_content .= '$watermark_transparency = "' .$dw_text_transparency. '";' . "\n";
	$file_content .= '$watermark_rotation = "' .$dw_rotation. '";' . "\n";
	$file_content .= '$watermark_imagefilter = "' .$dw_imagefilter. '";' . "\n";
	$file_content .= '$watermark_signature = "' .$dw_signature. '";' . "\n";
	$file_content .= '$home_path = "' .$home_path. '";' . "\n";
	$file_content .= '$upload_dir = "' .$basedir. '";' . "\n";
	$file_content .= '?>';
	
	$plugin_dir_path = plugin_dir_path( __FILE__ );
	$file = $plugin_dir_path . 'watermarking-parameters.php';  // (Can write to this file)
	
	// Write the contents back to the file
	@file_put_contents($file, $file_content);
	
	$dw_query = "type=dw&position=$dw_position&text=$dw_text&font_color=$dw_font_color&r_text=$dw_r_text&r_font_color=$dw_r_font_color&font_size_factor=$dw_font_size_factor&r_font_size_factor=$dw_r_font_size_factor&text_transparency=$dw_text_transparency&rotation=$dw_rotation&imagefilter=$dw_imagefilter&signature=$dw_signature&stamp=$dw_logo&margin_left_factor=$dw_margin_left_factor&margin_top_factor=$dw_margin_top_factor&home_path=$home_path";
	$dw_query = '';
	$hotlinking_rule = $ctp_main_settings['hotlinking_rule'];
	if($hotlinking_rule == "Watermark"){
		$hotlinking_rule_text = 'RewriteRule ^(.*)\.(jpg|png|jpeg)$ ' . $pluginsurl . '/watermark.php?'. $dw_query . '&src=/$1.$2' . '&w=1' . ' [R=301,NC,L]';
	}else if ($hotlinking_rule == "No Action"){
		$hotlinking_rule_text = 'RewriteRule ^.*$ - [NC,L]';
	}
	
	$mysite_rule = $ctp_main_settings['mysite_rule'];
	if($mysite_rule == "Watermark"){
		$mysite_rule_text = 'RewriteRule ^(.*)\.(jpg|png|jpeg)$ ' . $pluginsurl . '/watermark.php?'. $dw_query . '&src=/$1.$2' . '&w=1' . ' [R=301,NC,L]';
	}
	else
	{
		$mysite_rule_text = 'RewriteRule ^.*$ - [NC,L]';
	}
	
	$prevented_agents_rule_text = 'RewriteRule ^.*$ '. $pluginsurl . '/watermark.php [R=301,L]';
	
	$ruls[] = <<<EOT
	<IfModule mod_rewrite.c>
	RewriteEngine on
EOT;
	
	$ruls[] = <<<EOT
	RewriteCond %{HTTP_USER_AGENT} (PrintFriendly.com)
	$prevented_agents_rule_text
	
	RewriteCond %{QUERY_STRING} (ctp_main_watermark_pass) [NC,OR]
	RewriteCond %{REQUEST_URI} (wp-content/plugins) [NC,OR]
	RewriteCond %{REQUEST_URI} (logo|300x|x300|150x150) [NC,OR]
	RewriteCond %{REQUEST_URI} (wp-content/themes) [NC]
	RewriteRule ^.*$ - [NC,L]
	
	# What happen to images on my site
	#RewriteCond %{HTTP_ACCEPT} (image|png) [NC]
	RewriteCond %{HTTP_REFERER} ^http(s)?://(www\.)?$url [NC,OR]
	RewriteCond %{HTTP_REFERER} ^(.*)$url [NC]
	$mysite_rule_text
	
	#Save as or Click on View image after right click or without any referer
	RewriteCond %{REQUEST_URI} (wpcphotclicked) [NC,OR]
	RewriteCond %{REQUEST_URI} (stackpathcdn.com) [NC,OR]
	RewriteCond %{HTTP_USER_AGENT} (stackpathcdn.com) [NC,OR]
	RewriteCond %{HTTP_ACCEPT} (text|html|application|image|png) [NC]
	$hotlinking_rule_text
	
	RewriteCond %{REQUEST_URI} \.(jpg|jpeg|png)$ [NC]
	RewriteCond %{REMOTE_ADDR} !^(127.0.0.1|162.144.5.62)$ [NC]
	RewriteCond %{REMOTE_ADDR} !^66.6.(32|33|36|44|45|46|40). [NC]
	RewriteCond %{HTTP_REFERER} !^http(s)?://(www\.)?(www.$url|$url|pinterest.com|tumblr.com|facebook.com|plus.google|twitter.com|googleapis.com|googleusercontent.com|ytimg.com|gstatic.com) [NC]
	RewriteCond %{HTTP_USER_AGENT} !(linkedin.com|googlebot|msnbot|baiduspider|slurp|webcrawler|teoma|photon|facebookexternalhit|facebookplatform|pinterest|feedfetcher|ggpht) [NC]
	RewriteCond %{HTTP_USER_AGENT} !(photon|smush.it|akamai|cloudfront|netdna|bitgravity|maxcdn|edgecast|limelight|tineye) [NC]
	RewriteCond %{HTTP_USER_AGENT} !(developers|gstatic|googleapis|googleusercontent|google|ytimg) [NC]
	$hotlinking_rule_text
	
</ifModule>
EOT;
//NC (no case, case insensitive, useless in this context) and L (last rule if applied)
	ctp_main_add_htaccess($ruls);
}
register_activation_hook( __FILE__, 'ctp_main_modify_htaccess' );
add_action( 'upgrader_process_complete', 'ctp_main_modify_htaccess',10, 2);

//---------------------------------------------------------------------------------------------
//Create a watermarked images directory within the Uploads Folder when plugin activated
//---------------------------------------------------------------------------------------------
function create_watermarked_images_directory() {
    $can_cache = false;
	$upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/ctp_main_watermarked_images';
    if (! is_dir($upload_dir)) {
       $can_cache = mkdir( $upload_dir, 0755 );
    }
	return $can_cache;
}
register_activation_hook( __FILE__, 'create_watermarked_images_directory' );
//---------------------------------------------------------------------------------------------
//Register libraries using new wordpress register_script & enqueue_script functions
//---------------------------------------------------------------------------------------------
function ctp_main_clear_htaccess()
{
	$htaccess_file = ABSPATH.'.htaccess';
	
	ctp_main_insert_with_markers_htaccess($htaccess_file, 'ctp_main_image_protection', "");
}
register_deactivation_hook( __FILE__, 'ctp_main_clear_htaccess' );

function ctp_main_insert_with_markers_htaccess( $filename, $marker, $insertion ) {
    if (!file_exists( $filename ) || is_writeable( $filename ) ) {
        if (!file_exists( $filename ) ) {
            $markerdata = '';
        } else {
            $markerdata = explode( "\n", implode( '', file( $filename ) ) );
        }
 
        if ( !$f = @fopen( $filename, 'w' ) )
            return false;
 
        $foundit = false;
        if ( $markerdata ) {
            $state = true;
            foreach ( $markerdata as $n => $markerline ) {
                if (strpos($markerline, '# BEGIN ' . $marker) !== false)
                    $state = false;
                if ( $state ) {
                    if ( $n + 1 < count( $markerdata ) )
                        fwrite( $f, "{$markerline}\n" );
                    else
                        fwrite( $f, "{$markerline}" );
                }
                if (strpos($markerline, '# END ' . $marker) !== false) {
                    fwrite( $f, "# BEGIN {$marker}\n" );
                    if ( is_array( $insertion ))
                        foreach ( $insertion as $insertline )
                            fwrite( $f, "{$insertline}\n" );
                    fwrite( $f, "# END {$marker}\n" );
                    $state = true;
                    $foundit = true;
                }
            }
        }
        if (!$foundit) {
            fwrite( $f, "\n# BEGIN {$marker}\n" );
			if ( is_array( $insertion ))
				foreach ( $insertion as $insertline )
					fwrite( $f, "{$insertline}\n" );
            fwrite( $f, "# END {$marker}\n" );
        }
        fclose( $f );
        return true;
    } else {
        return false;
    }
}

//---------------------------------------------------------------------------------------------
//Register libraries using new wordpress register_script & enqueue_script functions
//---------------------------------------------------------------------------------------------
function ctp_main_get_domain($url)
{
	$nowww = preg_replace('/www\./','',$url);
	
	$domain = parse_url($nowww);
	
	preg_match("/[^\.\/]+\.[^\.\/]+$/", $nowww, $matches);
	
	if(count($matches) > 0)
	{
		return $matches[0];
	}
	else
	{
		return FALSE;
	}
}

//---------------------------------------------------------------------------------------------
//Returns true if $search_for is a substring of $search_in
//---------------------------------------------------------------------------------------------
function ctp_main_contains($search_in, $search_for)
{
    return strpos($search_in, $search_for) !== false;
}

function inStr($needle, $haystack)
{
  $needlechars = strlen($needle); //gets the number of characters in our needle
  $i = 0;
  for($i=0; $i < strlen($haystack); $i++) //creates a loop for the number of characters in our haystack
  {
    if(substr($haystack, $i, $needlechars) == $needle) //checks to see if the needle is in this segment of the haystack
    {
      return TRUE; //if it is return true
    }
  }
  return FALSE; //if not, return false
}
//---------------------------------------------------------------------------------------------
//Register Main plugin Actions and Filters
//http://www.mysite.com/mypage.html
//http://www.mysite.com/myfolder/*
//---------------------------------------------------------------------------------------------
$self_url = ctp_main_get_self_url();

$exclude_this_page = 'False';

$tag = '';

$url_exclude_list = $c -> ctp_main_get_setting('url_exclude_list');

// Processes \r\n's first so they aren't converted twice.
$url_exclude_list = str_replace("\\n", "\n", $url_exclude_list);

$self_url = trim($self_url);

$self_url = preg_replace('{/$}', '', $self_url);

$urlParts = parse_url($self_url);

if(isset($urlParts['scheme'])) $urlParts_scheme = $urlParts['scheme'] . '://'; else $urlParts_scheme = '';

if(isset($urlParts['host'])) $urlParts_host = $urlParts['host']; else $urlParts_host = '';

if(isset($urlParts['path'])) $urlParts_path = $urlParts['path']; else $urlParts_path = '';

if(isset($urlParts['query'])) $urlParts_query = '?' . $urlParts['query']; else $urlParts_query = '';

$self_url = $urlParts_scheme . $urlParts_host . $urlParts_path . $urlParts_query;

//echo $self_url;

$url_exclude_list = ctp_main_multiexplode(array("," ," ", "\n", "|"),$url_exclude_list);

if( !empty($url_exclude_list) )
	{
		for ($i=0; $i <= count($url_exclude_list); $i++)
		{
			if (isset($url_exclude_list[$i]))
			{
				$tag = $url_exclude_list[$i];
				
				$tag = trim($tag);
				
				//$tag = rtrim($tag, "/");
				
				//echo '<br>' . $tag;
			}
			else
			{
				$tag = '';
			}
			if (ctp_main_contains($tag, '/*')) //Bulk exclusion
			{
				$tag = str_replace("/*", "", $tag);
				
				if (ctp_main_contains($self_url, $tag))
				{
					$exclude_this_page = 'True';
					
					break;
				}
			}
			else
			{
				if ($self_url == $tag || $self_url. '/' == $tag )
				{
					$exclude_this_page = 'True';
					
					break;
				}
			}
		}
	}

function ctp_main_get_current_user_roles($mm = array()) {
	if ( ! function_exists( 'wp_get_current_user' ) )
	{
		require_once( ABSPATH . 'wp-includes/pluggable.php' );
	}
	if( is_user_logged_in() ) {
	$user = wp_get_current_user();
	$roles = ( array ) $user->roles;
	return $roles; // This returns an array
	} else {
	return array();
	}
}
$allowed_roles = array();

global $ctp_main_settings;

if(!$ctp_main_settings) $ctp_main_settings = ctp_main_read_options();

if (array_key_exists("administrator",$ctp_main_settings))
{
	if ($ctp_main_settings['administrator'] == 'checked') $allowed_roles[0] = 'administrator';
	if ($ctp_main_settings['editor'] == 'checked') $allowed_roles[1] = 'editor';
	if ($ctp_main_settings['author'] == 'checked') $allowed_roles[2] = 'author';
	if ($ctp_main_settings['contributor'] == 'checked') $allowed_roles[3] = 'contributor';
	if ($ctp_main_settings['subscriber'] == 'checked') $allowed_roles[4] = 'subscriber';
}

if(!defined('AUTH_COOKIE'))
	$roles = array();
else
	$roles = ctp_main_get_current_user_roles();
	

if( array_intersect($roles, $allowed_roles) ) {
	$exclude_this_page = 'True';
}

if($exclude_this_page != 'True')
{
	add_action('wp_head','ctp_main_main_settings'); //Located on play_functions.php
	
	add_action('wp_head','ctp_main_disable_hot_keys'); //Located on play_functions.php
	
	add_action('wp_footer','ctp_main_disable_selection_settings_footer'); //Located on play_functions.php
	
	add_action('wp_head','ctp_main_right_click_premium_settings'); //Located on
	
	add_action('wp_head','ctp_main_css_settings'); //Located on
	
	add_action('wp_footer','ctp_main_alert_message'); //Located on common-functions.php
	
	add_action('wp_footer','ctp_main_global_js_scripts'); //Located on common-functions.php
	
	add_filter('body_class','ctp_main_class_names'); //Located on play_functions.php
	
	add_action('wp_footer','ctp_main_images_overlay_settings'); //Located on play_functions.php
	
	add_action('wp_footer','ctp_main_videos_overlay_settings'); //Located on play_functions.php
	
	add_action('wp_head','ctp_main_nojs_inject'); //Located on ctp.php
	
	add_filter( 'the_content', 'ctp_main_find_image_urls'); //Located on common-functions.php
}

add_action( 'admin_footer', 'ctp_main_alert_message' );

function ctp_main_cache_purge_action_js() {
global $post;
if($post->ID) $my_permalink = get_permalink($post->ID);
if($_REQUEST['tag_ID']) $my_permalink = get_category_link($_REQUEST['tag_ID']);
?>
  <script type="text/javascript" >
     jQuery("li#wp-admin-bar-CTPExclude .ab-item").on( "click", function() {
        var data = {
                      'action': 'example_cache_purge',
					  'permalink': '<? echo $my_permalink; ?>',
                    };
		if(jQuery("li#wp-admin-bar-CTPExclude .ab-item").text() !== "Exclusion Done!")
		{
			jQuery("li#wp-admin-bar-CTPExclude .ab-item").text('Loading..');
			/* since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php */
			jQuery.post(ajaxurl, data, function(response) {
			   jQuery("li#wp-admin-bar-CTPExclude .ab-item").text('Exclusion Done!');
			});
		}
       
      });
  </script> <?php
}

/* Here you hook and define ajax handler function */

add_action( 'wp_ajax_example_cache_purge', 'ctp_main_example_cache_purge_callback' );

function ctp_main_example_cache_purge_callback() {
    /* You cache purge logic should go here. */
	$ctp_main_settings = ctp_main_read_options();
	$ctp_main_settings["url_exclude_list"] = $ctp_main_settings["url_exclude_list"] . "\n" . $_REQUEST['permalink'];
	update_blog_option_single_and_multisite( 'ctp_main_settings' , $ctp_main_settings );
    $response = $ctp_main_settings["url_exclude_list"];
    echo ($response);
    wp_die(); /* this is required to terminate immediately and return a proper response */
} 

//---------------------------------------------------------------------------------------------
//Add plugin settings link to Plugins page
//---------------------------------------------------------------------------------------------
function ctp_main_plugin_add_settings_link( $links ) {

	$settings_link = '<a href="options-general.php?page=ctp-main-menu-option">' . __( 'Settings' ) . '</a>';
	
	array_push( $links, $settings_link );
	
	return $links;
}

$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'ctp_main_plugin_add_settings_link' );


//---------------------------------------------------------------------------------------------
//Function to get self url
//---------------------------------------------------------------------------------------------
function ctp_main_get_self_url()
{ 
    return get_site_url().$_SERVER['REQUEST_URI'];
}

function ctp_main_strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

//---------------------------------------------------------------------------------------------
//Multiexplode function
//---------------------------------------------------------------------------------------------
function ctp_main_multiexplode($delimiters,$string) {
   
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

//---------------------------------------------------------------------------------------------
//Add nojs action
//---------------------------------------------------------------------------------------------
function ctp_main_nojs_inject()
{
	global $ctp_main_settings;
	if ($ctp_main_settings['no_js_action'] == 'Watermark all')
	{
		if (!isset($_SESSION["no_js"]))
		{
			$pluginsurl = plugins_url( '', __FILE__ );
			
			$nojs_page_url = $pluginsurl . '/no-js.php';
			
			$referrer = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			$nojs_page_url = $nojs_page_url . "?referrer=" .$referrer;
			
			$st = "
				<!-- Redirect to another page (for no-js support) -->
				<noscript><meta http-equiv=\"refresh\" content=\"0;url=$nojs_page_url\"></noscript>
				
				<!-- Show a message -->
				<noscript>You dont have javascript enabled! Please download Google Chrome!</noscript>
			";

			echo $st;
		}
	}
}
if (isset($_SESSION["no_js"]))
{
	add_filter( 'the_content', 'ctp_main_replace_image_urls');
}

//---------------------------------------------------------------------------------------------
//Replace image urls with nothing
//---------------------------------------------------------------------------------------------
function ctp_main_replace_image_urls( $content ) {

	global $post;
	
	$ctp_main_settings = ctp_main_read_options();
	
	$dw_position = $ctp_main_settings['dw_position'];
	$dw_text = $ctp_main_settings['dw_text'];
		$dw_text = str_replace(" ","+",$dw_text);
	$dw_r_text = $ctp_main_settings['dw_r_text'];
		$dw_r_text = str_replace(" ","+",$dw_r_text);
	$dw_font_color = $ctp_main_settings['dw_font_color'];
	$dw_r_font_color = $ctp_main_settings['dw_r_font_color'];
	$dw_font_size_factor = $ctp_main_settings['dw_font_size_factor'];
	$dw_r_font_size_factor = $ctp_main_settings['dw_r_font_size_factor'];
	$dw_text_transparency = $ctp_main_settings['dw_text_transparency'];
	$dw_rotation = $ctp_main_settings['dw_rotation'];
	$dw_imagefilter = $ctp_main_settings['dw_imagefilter'];
	$dw_signature = $ctp_main_settings['dw_signature'];
		$dw_signature = str_replace(" ","+",$dw_signature);
	$dw_logo = $ctp_main_settings['dw_logo'];
	
	$dw_query = "type=dw&position=$dw_position&text=$dw_text&font_color=$dw_font_color&r_text=$dw_r_text&r_font_color=$dw_r_font_color&font_size_factor=$dw_font_size_factor&r_font_size_factor=$dw_r_font_size_factor&text_transparency=$dw_text_transparency&rotation=$dw_rotation&imagefilter=$dw_imagefilter&signature=$dw_signature&stamp=$dw_logo";
	
	$dw_query = str_replace("#","%23",$dw_query);
	
	$pluginsurl = plugins_url( '', __FILE__ );

	$regexp = '<img[^>]+src=(?:\"|\')\K(.[^">]+?)(?=\"|\')';

	//Watermark images inside the content
	if(preg_match_all("/$regexp/", $content, $matches, PREG_SET_ORDER))
	{
		if( !empty($matches) )
		{
			for ($i=0; $i <= count($matches); $i++)
			{
				if (isset($matches[$i]) && isset($matches[$i][0]))
				{
					$img_src = $matches[$i][0];
				}
				else
				{
					$img_src = '';
				}
				$url_parser = parse_url($img_src); //Array [scheme] => http    [host] => www.example.com    [path] => /foo/bar    [query] => hat=bowler&accessory=cane
				
				$img_file_path = $url_parser['path'];
				
				//$http = $pluginsurl . "/watermark.php?w=watermarksaveas.png&p=c&q=90&src=";
				
				$http = $pluginsurl . '/watermark.php?'. $dw_query . '&src=';

				$encrypted_img_src = $http . $img_file_path;

				$content = str_replace($img_src,$encrypted_img_src,$content);
			}
		}
	}
	$content = str_replace(']]>', ']]&gt;', $content);

return $content;
}

?>