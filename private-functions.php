<?php
//---------------------------------------------------------------------------------------------
//Register libraries using new wordpress register_script & enqueue_script functions
//---------------------------------------------------------------------------------------------

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$pluginsurl = plugins_url( '', __FILE__ );

$c = new ctp_main_controls_class();

function ctp_main_enqueue_scripts() {

	$pluginsurl = plugins_url( '', __FILE__ );
	
	$admincore = '';
	
	if (isset($_GET['page'])) $admincore = $_GET['page'];
	
	if( is_admin() && $admincore == 'ctp-main-menu-option') {
	
		wp_enqueue_script('jquery');
		
		wp_register_style('font-awesome.min', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
		wp_enqueue_style('font-awesome.min');
		
		wp_register_style('defaultcss', $pluginsurl.'/css/responsive-pure-css-tabs/default.css');
		wp_enqueue_style('defaultcss');
		
		wp_register_style('stylecss', $pluginsurl.'/css/responsive-pure-css-tabs/style.css');
		wp_enqueue_style('stylecss');
		
		wp_register_script('responsive_pure_css_tabsjs', $pluginsurl.'/css/responsive-pure-css-tabs/js.js');
		wp_enqueue_script('responsive_pure_css_tabsjs');
		
		wp_register_style('bootstrapcss', $pluginsurl.'/flat-ui/css/vendor/bootstrap/css/bootstrap.min.css');
		wp_enqueue_style('bootstrapcss');
		
		wp_register_script('applicationjs', $pluginsurl.'/flat-ui/js/application.js');
		wp_enqueue_script('applicationjs');
		
		wp_register_script('image-picker.js', $pluginsurl.'/image-picker/image-picker.js');
		wp_enqueue_script('image-picker.js');
		
		wp_register_style('image-picker.css', $pluginsurl.'/image-picker/image-picker.css');
		wp_enqueue_style('image-picker.css');
		
		wp_register_style('bootstrap-select.min.css', $pluginsurl.'/css/bootstrap-select.min.css');
		wp_enqueue_style('bootstrap-select.min.css');
		
		wp_register_script('bootstrap-select.min.js', $pluginsurl.'/js/bootstrap-select.min.js');
		wp_enqueue_script('bootstrap-select.min.js');
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle', plugins_url('admin_script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_media();
	}
	else
	{
		wp_enqueue_script('jquery');
	}
}
add_action('admin_enqueue_scripts', 'ctp_main_enqueue_scripts');

//---------------------------------------------------------------------------------------------
//Add and icon to the top admin bar
//---------------------------------------------------------------------------------------------
function ctp_add_items($admin_bar)
{
	$pluginsurl = plugins_url( '', __FILE__ );
	global $post;
	$perma_link = '';
	$ctpadminurl = get_admin_url();
	//if($post->ID) $perma_link = get_permalink($post->ID);
	//if($_REQUEST['tag_ID']) $perma_link = get_category_link($_REQUEST['tag_ID']);
	
	//The properties of the new item. Read More about the missing 'parent' parameter below

    $args = array(
            'id'    => 'Protection',
            'title' => __('<img src="'.$pluginsurl.'/images/adminbaricon.png" style="vertical-align:middle;margin-right:5px;width: 22px;" alt="Protection" title="Protection" />CTF' ),
            'href'  => $ctpadminurl.'options-general.php?page=ctp-main-menu-option',
            'meta'  => array('title' => __('Content Thief Protector'),)
            );

	$sub_args_exclude = array(
            'id'    => 'CTPExclude',
			'parent' => 'Protection',
            'title' => __('Exclude this from protection' ),
            'href'  => "#",
            'meta'  => array('title' => __('Content Thief Protector'))
            );
	
	$sub_args_include = array(
            'id'    => 'CTP_Protect',
			'parent' => 'Protection',
            'title' => __('Protect this' ),
            'href'  => "#",
            'meta'  => array('title' => __('Content Thief Protector'))
            );
    $admin_bar->add_menu($args);
	
	global $ctp_main_settings;
	if (get_blog_option_single_and_multisite('ctp_main_settings')) $ctp_main_settings = get_blog_option_single_and_multisite('ctp_main_settings'); //To get refreshed array for ajax use

	$url_exclude_list = $ctp_main_settings["url_exclude_list"];

	global $current_screen;
}

if($c -> ctp_main_get_setting('show_admin_bar_icon') == 'Yes')
{
	add_action('admin_bar_menu', 'ctp_add_items',  40);
}

//---------------------------------------------------------------------------------------------
//Show settings page
//---------------------------------------------------------------------------------------------
function ctp_main_options_page_pro()
{
		include 'admin_settings.php';
}

//---------------------------------------------------------------------------------------------
//Make our function to call the WordPress function to add to the correct menu
//---------------------------------------------------------------------------------------------
function ctp_main_add_options() {

	add_options_page('Content Thief Protector', 'Content Thief Protector', 'manage_options', 'ctp-main-menu-option', 'ctp_main_options_page_pro');
}
add_action('admin_menu', 'ctp_main_add_options');
?>