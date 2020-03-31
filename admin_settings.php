<?php
//delete_blog_option('ctp_main_settings');
$ctp_main_settings = ctp_main_read_options();
//delete_option('ctp_main_settings');
session_unset();
if ( isset( $_POST['Restore_defaults'] ) ) 
{
	if(is_multisite())
	{
		$id = get_current_blog_id();
		delete_blog_option($id,'ctp_main_settings');
	}
	else
	{
		delete_option('ctp_main_settings');
	}
}
if ( isset( $_POST['clear_cached_images'] ) ) 
{
	ctp_main_delete_watermarked_cached_images('');
}
?>

<style>
#aio_admin_main {
	text-align:left;
	direction:ltr;
	padding:10px;
	margin: 10px;
	background-color: #ffffff;
	border:1px solid #EBDDE2;
	display: relative;
	overflow: auto;
}
.inner_block{
	height: 370px;
	display: inline;
	min-width:770px;
}
#donate{
    background-color: #EEFFEE;
    border: 1px solid #66DD66;
    border-radius: 10px 10px 10px 10px;
    height: 58px;
    padding: 10px;
    margin: 15px;
    }
.text-font {
    color: #1ABC9C;
    font-size: 14px;
    line-height: 1.5;
    padding-left: 3px;
    transition: color 0.25s linear 0s;
}
.text-font:hover {
    opacity: 1;
    transition: color 0.25s linear 0s;
}
.simpleTabsContent{
	border: 1px solid #E9E9E9;
	padding: 4px;
}
div.simpleTabsContent{
	margin-top:0;
	border: 1px solid #E0E0E0;
    display: none;
    height: 100%;
    min-height: 400px;
    padding: 5px 15px 15px;
}
html {
	background: #FFFFFF;
}

.inner-label {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #f6f6f6;
    border-image: none;
    border-radius: 3px;
    border-style: solid;
    border-width: 1px 1px 1px 7px;
    font-family: tahoma;
    font-size: 11px;
    padding: 13px;
    text-align: center;
}
.controls_container {
    align-content: center;
    border-radius: 15px;
    min-height: 54px;
    padding-top: 7px;
    font-family: "Georgia", "Times New Roman", "Bitstream Charter", "Times", serif;
    font-size: 20px;
}
.framework_small_font {
    font-family: 'Raleway', Arial, sans-serif;
    font-size: 11px;
}
.welling {
    border-left: 1px inset #84ff8f;
    border-right: 1px outset #84ff8f;
    color: #000000;
    text-align: justify;
    border-radius: 3px;
    min-height: 54px;
    padding: 10px;
    font-family: "Lato", Helvetica, Arial, sans-serif;
    font-size: 15px;
}
.welling p {
    font-family: tahoma;
    font-size: 11px;
}
.welling > span {
    display: table-cell;
    height: 44px;
    vertical-align: middle;
}
.tab_heading_text{
    margin: 15px;
    font-size: 25px;
}
</style>
<!-- This for range slider only -->
<style>
.sliderr {
    -webkit-appearance: none;
    width: 100%;
    height: 15px;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
	}
.sliderr:hover {
    opacity: 1;
}

.sliderr::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.sliderr::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}
</style>
<style>
.styled-select-div {
  background: transparent;
  border: none;
  font-size: 14px;
  height: 37px;
  padding: 5px; /* If you add too much padding here, the options won't show in IE */
  width: 268px;
  background-color: #3b8ec2;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
}
.styled-select-div select:focus
{
	color: #fff;
}
.styled-select-div select option:hover {
    
}
/* -------------------- Colors: Text */
.styled-select-div select{
  color: #fff;
  background-color: rgb(59, 142, 194);
  border: none;
  font-size: 14px;
  height: 29px !important;
  /* padding: 0px;  If you add too much padding here, the options won't show in IE */
  width: 258px;
}
.styled-select-div option{
  color: #fff;
  background-color: rgb(59, 142, 194);
}
#container_Getting-Support{
    background-color: transparent !important;
    color: black;
}
</style>
<?php
$c = new ctp_main_controls_class();

echo '<p style="margin: 20px 0 20px;font-size: 35px;font-weight: bold;color: #218838; text-align: center;">Content Thief Protector</p>';
?>
<form method="POST">

<input type="hidden" value="update" name="action">
		<div class="tab_container"">
			<input class="tab_container_radio_tabs" id="tab1" type="radio" name="tabs" checked>
			<label class="tab_container_label_tabs" for="tab1"><i class="fa fa-cog"></i><span><?php _e('Selection','ctp_lang'); ?></span></label>

			<input class="tab_container_radio_tabs" id="tab9" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab9"><i class="fa fa-code"></i><span><?php _e('Styling','ctp_lang'); ?></span></label>

			<input class="tab_container_radio_tabs" id="tab2" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab2"><i class="fa fa-pencil-square-o"></i><span><?php _e('RightClick','ctp_lang'); ?></span></label>

			<input class="tab_container_radio_tabs" id="tab3" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab3"><i class="fa fa-bar-chart-o"></i><span><?php _e('CSS protection','ctp_lang'); ?></span></label>

			<input class="tab_container_radio_tabs" id="tab4" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab4"><i class="fa fa-ticket"></i><span><?php _e('Smart protection','ctp_lang'); ?></span></label>

			<input class="tab_container_radio_tabs" id="tab5" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab5"><i class="fa fa-picture-o"></i><span><?php _e('Watermark','ctp_lang'); ?></span></label>
			
			<input class="tab_container_radio_tabs" id="tab6" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab6"><i class="fa fa-filter"></i><span><?php _e('Exclusion','ctp_lang'); ?></span></label>
			
			<input class="tab_container_radio_tabs" id="tab7" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab7"><i class="fa fa-cog"></i><span><?php _e('Custom Settings','ctp_lang'); ?></span></label>
			
			<input class="tab_container_radio_tabs" id="tab8" type="radio" name="tabs">
			<label class="tab_container_label_tabs" for="tab8"><i class="fa fa-envelope-o"></i><span><?php _e('Contact','ctp_lang'); ?></span></label>
<script>
//Remeber last tab checked after refreshing the page
var currunt_tab = localStorage.getItem("ctp_main_lastTab") || "tab1";
currunt_tab = "#" + currunt_tab;
jQuery(currunt_tab).prop('checked', 'checked');
jQuery(".tab_container :radio").on("change", function(){
  localStorage.setItem("ctp_main_lastTab",this.id );
});

</script>
<?php
//---------------------------------------------------------------------
//Basic Protection 
//---------------------------------------------------------------------
/* translators: 1: WordPress version number, 2: plural number of bugs. */
$c->open_tab('content1');
		$c->open_row();
	    $c->add_label(__("Disable Selection on",'ctp_lang'));
	    $c->open_controls_container('disable_selection_on');
			$c->add_checkbox('single_posts_protection' , __('Posts','ctp_lang') , 'checked', '');
			$c->add_checkbox('home_page_protection' , __('HomePage','ctp_lang') , 'checked', '');
			$c->add_checkbox('page_protection' , __('Static pages','ctp_lang') , 'checked', '');
		$c->close_controls_container();
	    $c->add_help_container(__('To choose where to apply the protection <p>To allow selection please disable all css protection tab','ctp_lang'));
	$c->close_row();
    $c->add_line();
    
    $c->open_row();
        $c->add_label(__("Selection disabled message",'ctp_lang'));
        $c->open_controls_container('selection_disabled_message');
			$default_text = __('<b>Alert:</b> Content is protected !!','ctp_lang');
	        $c->add_textbox('smessage' , 'Selection disabled message here', 'col-md-7 col-xs-12', $default_text);
		$c->close_controls_container();
    $c->close_row();
    $c->add_line();
	
	$c->open_row();
        $c->add_label(__("CTRL + key disabled message",'ctp_lang'));
        $c->open_controls_container('ctrl_message_container');
			$default_text = __('<b>Alert:</b> You are not allowed to copy content or view source','ctp_lang');
	        $c->add_textbox('ctrl_message' , __('Write a message for CTRL + keys','ctp_lang'), 'col-md-7 col-xs-12', $default_text);
		$c->close_controls_container();
        $c->add_help_container(__('Message for disable the keys  CTRL+A , CTRL+C , CTRL+X , CTRL+S or CTRL+V , CTRL+U','ctp_lang'));
    $c->close_row();
    $c->add_line();
    
	$c->open_row();
	    $c->add_label(__("Disable special keys",'ctp_lang'));
	    $c->open_controls_container('special_keys_protection');
			$c->open_controls_row();
				$c->add_checkbox('ctrl_p_protection' , __('Ctrl+P Key','ctp_lang') , 'checked', '');
				$c->add_checkbox('ctrl_s_protection' , __('Ctrl+S Key','ctp_lang') , 'checked', '');
				$c->add_checkbox('ctrl_a_protection' , __('CTRL+A Key','ctp_lang') , 'checked', '');
				$c->add_checkbox('ctrl_c_protection' , __('Ctrl+C Key','ctp_lang') , 'checked', '');
			$c->close_controls_row();
			
			$c->open_controls_row();
				$c->add_checkbox('ctrl_x_protection' , __('Ctrl+X Key','ctp_lang') , 'checked', '');
				$c->add_checkbox('ctrl_v_protection' , __('Ctrl+V Key','ctp_lang') , 'checked', '');
				$c->add_checkbox('ctrl_u_protection' , __('Ctrl+U Key','ctp_lang') , 'checked', '');
				$c->add_checkbox('f12_protection' , __('F12','ctp_lang') , 'checked', '');
			$c->close_controls_row();
			
			$c->open_controls_row();
				$c->add_checkbox('prntscr_protection' , __('Print Screen Key','ctp_lang') , 'checked', '');
                $c->add_checkbox('ctrl_i_protection' , __('Ctrl+I Key','ctp_lang') , 'checked', '');
			$c->close_controls_row();
			
		$c->close_controls_container();
	    $c->add_help_container(__('Disable PrintScreen key & Printing key & Save page key<p>Note: this may not work on all browsers</p>','ctp_lang'));
	$c->close_row();
    $c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Special keys disabled message",'ctp_lang'));
	    $c->open_controls_container('special_keys_disabled_message');
			$default_text = __('You are not allowed to print or save this page!!','ctp_lang');
	        $c->add_textbox('custom_keys_message' , 'Write a message for PrintScreen key', 'col-md-7 col-xs-12', $default_text);
		$c->close_controls_container();
	$c->close_row();
    $c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Print page disabled message",'ctp_lang'));
	    $c->open_controls_container('p_p_d_m');
			$default_text = __("WARNING:  UNAUTHORIZED USE AND/OR DUPLICATION OF THIS MATERIAL WITHOUT EXPRESS AND WRITTEN PERMISSION FROM THIS SITE'S AUTHOR AND/OR OWNER IS STRICTLY PROHIBITED! CONTACT US FOR FURTHER CLARIFICATION.!!",'ctp_lang');
			$bottom_hint = '';
			$c->add_textarea('prnt_scr_msg', __('Write the message here','ctp_lang'), 'col-md-10 col-xs-12',$bottom_hint, $default_text);
		$c->close_controls_container();
	    $c->add_help_container(__('Leave this field blank if you want to allow users to print your pages','ctp_lang'));
	$c->close_row();
    $c->add_line();

$c->close_tab();

//---------------------------------------------------------------------
// Style
//---------------------------------------------------------------------
$c->open_tab('content9');
    $c->open_row();
    $c->add_label(__("Message inner style",'ctp_lang'));
    $c->open_controls_container('m_i_s');
    $c->add_colorpicker('msg_color', __('Message background','ctp_lang'), '#ffecec');
    $c->add_colorpicker('font_color', __('Font color','ctp_lang'), '#555555');
    $c->close_controls_container();
    $c->add_help_container(__('You may use CTRL+F5 after saving to preview the message','ctp_lang'));
    $c->close_row();
    $c->add_line();

    $c->open_row();
    $c->add_label(__("Message outer style",'ctp_lang'));
    $c->open_controls_container('m_o_s');
    $c->add_colorpicker('border_color', __('Border color','ctp_lang'), '#f5aca6');
    $c->add_colorpicker('shadow_color', __('Shadow color','ctp_lang'), '#f2bfbf');
    $c->close_controls_container();
    $c->add_help_container(__('You may use CTRL+F5 after saving to preview the message','ctp_lang'));
    $c->close_row();
    $c->add_line();

    $c->open_row();
    $c->add_label(__("Message Show Time",'ctp_lang'));
    $c->open_controls_container('m_s_t');
    $c->open_form_group();
    $show_array[] = array();
    $show_array["class"] = 'col-md-4 col-xs-12';$show_array["counter"] = 1;
    $show_array["tansparency_meter"] = 0;$show_array["behind_text"] = '';
    $c->add_slider('message_show_time', 3, 0, 15, 1, 'horizontal', $show_array);
    $c->close_form_group();
    $c->close_controls_container();
    $c->add_help_container(__('By seconds, the alert message show time<p>0 value will hide the message','ctp_lang'));
    $c->close_row();
$c->close_tab();

//---------------------------------------------------------------------
// Copy Protection on RightClick
//---------------------------------------------------------------------
$c->open_tab('content2');
	$c->open_row();
	    $c->add_label(__("Disable RightClick on",'ctp_lang'));
	    $c->open_controls_container('');
			$c->add_checkbox('right_click_protection_posts' , __('Posts','ctp_lang') , 'checked', '');
			$c->add_checkbox('right_click_protection_homepage' , __('HomePage','ctp_lang') , 'checked', '');
			$c->add_checkbox('right_click_protection_pages' , __('Static pages','ctp_lang') , 'checked', '');
		$c->close_controls_container();
	    $c->add_help_container(__('To choose where to apply the protection','ctp_lang'));
	$c->close_row();
	$c->add_line();

	$c->open_row();
	    $c->add_label(__("Disables RightClick for HTML tags",'ctp_lang'));
	    $c->open_controls_container('');
			$c->open_controls_row();
				$c->add_checkbox('img' , __('Images','ctp_lang') , 'checked', '');
				$c->add_checkbox('a' , __('links','ctp_lang') , 'checked', '');
				$c->add_checkbox('pb' , __('Text content','ctp_lang') , 'checked', '');
			$c->close_controls_row();
			$c->open_controls_row();
				$c->add_checkbox('h' , __('Headlines','ctp_lang') , 'checked', '');
				$c->add_checkbox('textarea' , __('Text area','ctp_lang') , 'checked', '');
				$c->add_checkbox('input' , __('Text fields','ctp_lang') , 'checked', '');
			$c->close_controls_row();
			$c->open_controls_row();
				$c->add_checkbox('emptyspaces' , __('Empty spaces','ctp_lang') , 'checked', '');
				$c->add_checkbox('videos' , __('Videos (Not Recommended)','ctp_lang') , '', '');
				$c->add_empty_col();
			$c->close_controls_row();
		$c->close_controls_container();
	    $c->add_help_container(__('Video protection is not recommended because video players are too different','ctp_lang'));
	$c->close_row();
	$c->add_line();

	$c->open_row();
	    $c->add_label(__("Right click disabled messages",'ctp_lang'));
	    $c->open_controls_container('');
			$c->add_textbox('alert_msg_img' , __('For Images','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> Protected image');
			$c->add_textbox('alert_msg_a' , __('For Links','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> This link is protected');
			$c->add_textbox('alert_msg_pb' , __('For Text','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> Right click on text is disabled');
			$c->add_textbox('alert_msg_h' , __('For Headlines','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> Right click on headlines is disabled');
			$c->add_textbox('alert_msg_textarea' , __('For Text Area','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> Right click is disabled');
			$c->add_textbox('alert_msg_input' , __('For Text fields','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> Right click is disabled');
			$c->add_textbox('alert_msg_emptyspaces' , __('For Empty Spaces','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> Right click on empty spaces is disabled');
			$c->add_textbox('alert_msg_videos' , __('For videos','ctp_lang'), 'col-md-4 col-xs-12', '<b>Alert:</b> Right click on videos is disabled');
		$c->close_controls_container();
	    $c->add_help_container(__('&lt;b&gt;some text&lt;/b&gt; shows the text in <b>bold</b> format','ctp_lang'));
	$c->close_row();
	$c->add_line();
$c->close_tab();

//---------------------------------------------------------------------
//Protection by CSS Techniques 
//---------------------------------------------------------------------
$c->open_tab('content3');
	$c->open_row();
        $c->add_label(__('Home Page Protection by CSS','ctp_lang'));
        $c->open_controls_container('');
	        $options_array = array('Yes','No');
	        $default_value = 'Yes';
	        $c->add_dropdown('home_css_protection', $options_array, $default_value);
		$c->close_controls_container();
		$c->add_help_container(__('Protect your Homepage by CSS tricks','ctp_lang'));
	$c->close_row();
    $c->add_line();
	
	$c->open_row();
        $c->add_label(__('Posts Protection by CSS','ctp_lang'));
        $c->open_controls_container('');
	        $options_array = array('Yes','No');
	        $default_value = 'Yes';
	        $c->add_dropdown('posts_css_protection', $options_array, $default_value);
		$c->close_controls_container();
		$c->add_help_container(__('Protect your single posts by CSS tricks','ctp_lang'));
	$c->close_row();
	$c->add_line();
    
    $c->open_row();
        $c->add_label(__('Pages Protection by CSS','ctp_lang'));
        $c->open_controls_container('');
	        $options_array = array('Yes','No');
	        $default_value = 'Yes';
	        $c->add_dropdown('pages_css_protection', $options_array, $default_value);
		$c->close_controls_container();
		$c->add_help_container(__('Protect your static pages by CSS tricks','ctp_lang'));
	$c->close_row();
		
	$c->open_row();
	    $c->add_label(__("Add custom CSS code",'ctp_lang'));
	    $c->open_controls_container('custom_css_code_container');
			$bottom_hint = '';
			$default_value = __("<style>/* Start your code after this line */\n \n/* End your code before this line */</style>",'ctp_lang');
			$c->add_textarea('custom_css_code', __('Insert your custom code here','ctp_lang'), 'col-md-10 col-xs-12',$bottom_hint , $default_value);
		$c->close_controls_container();
	$c->close_row();
$c->close_tab();

//---------------------------------------------------------------------
// Smart protection
//---------------------------------------------------------------------
$c->open_tab('content4');
	$c->open_row();
	    $c->add_label(__("Auto overlay a transparent image over the real images on:",'ctp_lang'));
	    $c->open_controls_container('');
			$c->add_checkbox('protection_overlay_posts' , __('Posts','ctp_lang') , '', '');
			$c->add_checkbox('protection_overlay_homepage' , __('HomePage','ctp_lang') , '', '');
			$c->add_checkbox('protection_overlay_pages' , __('Static pages','ctp_lang') , '', '');
		$c->close_controls_container();
	    $c->add_photo_help_container('images/tansparent.png', '');
	$c->close_row();
	$c->add_line();

	$c->open_row();
	    $c->add_label(__("Auto remove image attachment links",'ctp_lang'));
	    $c->open_controls_container('Auto-remove-image-attachment-links');
			$options_array = array('Yes', 'No');
				$default_value = 'No';
				$c->add_dropdown('remove_img_urls', $options_array, $default_value);
				$c->add_bottom_hint(__("<p>Not recommended when you are using any lightbox plugin</p>",'ctp_lang'));
		$c->close_controls_container();
	    $c->add_help_container(__('All images will be without hover links','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Action when JavaScript is disabled",'ctp_lang'));
	    $c->open_controls_container('hotlinking_rule4');
			$options_array = array('Nothing', 'Watermark all');
			$default_value = 'Nothing';
			$c->add_dropdown('no_js_action', $options_array, $default_value);
		$c->close_controls_container();
	    $c->add_help_container(__('The browser will do it if the user disable JavaScript','ctp_lang'));
	$c->close_row();

$c->close_tab();
//---------------------------------------------------------------------
//Protection by watermarking
//---------------------------------------------------------------------
$c->open_tab('content5');
	if (!extension_loaded('gd') && !function_exists('gd_info')) {
		//echo "PHP GD library is NOT installed on your web server";
		$c->add_section(__('Warning: PHP GD library is NOT installed on your web server, watermarking will not work!','ctp_lang'),'orange');
	}
	if(!ctp_main_check_watermark_dir_can_cache())
		$c->add_section(__('Notice: Cache Directory is NOT found or not writable on your web server, watermarked images will not cached!','ctp_lang'),'red');
	$c->open_row();
        $c->add_label(__('Watermark Caching','ctp_lang'));
        $c->open_controls_container('watermark-caching');
			$c->add_checkbox('watermark_caching' , __('Active (Recommended)','ctp_lang') , 'checked', '');
			$c->add_button('clear_cached_images' , 'Clear_cache col' , __('Clear cache','ctp_lang'), true, "Cleared!");
		$c->close_controls_container();
	$c->add_help_container(__('Recommended for fast page loading & website server speed','ctp_lang'));
    $c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Hotlinking Rule",'ctp_lang'));
	    $c->open_controls_container('hotlinking_rule');
			$options_array = array('Watermark', 'No Action');
				$default_value = 'Watermark';
				$c->add_dropdown('hotlinking_rule', $options_array, $default_value);
				$htaccess_file = ABSPATH.'.htaccess';
				$filename = $htaccess_file;
				if (is_writable($filename)) {
					$hint = '<p style="color:green">' . __('Good! The htaccess file is writable','ctp_lang') . '</p>';
				} else {
					$hint = '<p style="color:red">' . __('Opps! The htaccess file is not writable','ctp_lang') . '</p>';
				}
				$c->add_bottom_hint($hint);
		$c->close_controls_container();
	    $c->add_help_container(__('Action when a thief copy your images to his site or try to download them','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("My Site Rule",'ctp_lang'));
	    $c->open_controls_container('my_site_rule');
			$options_array = array('Watermark', 'No Action');
				$default_value = 'No Action';
				$c->add_dropdown('mysite_rule', $options_array, $default_value);
		$c->close_controls_container();
	    $c->add_help_container(__('What will happen to images on my site','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Watermark logo",'ctp_lang'));
	    $c->open_controls_container('Watermark-logo');
			$pluginsurl = plugins_url( '', __FILE__ );
			$default_image = $pluginsurl . '/images/testing-logo.png';
			$c->add_media_uploader('dw_logo',$default_image);
		$c->close_controls_container();
	    $c->add_help_container(__('You can use a transparent logo in a png format<br>Best size: 128x128 px <p>Clear it to watermark without logo</p>','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Logo Margins",'ctp_lang'));
	    $c->open_controls_container('margin_factors');
			$c->open_form_group();
			$show_array[] = array();
				$c->add_inner_label(__("From Top",'ctp_lang'));
				$show_array["class"] = 'col-md-4 col-xs-12';$show_array["counter"] = 1;
				$show_array["tansparency_meter"] = 0;$show_array["behind_text"] = '%';
				$c->add_slider('dw_margin_top_factor', 98, 1, 100, 1, 'horizontal', $show_array);//Text size
			$c->close_form_group();
			
			$c->open_form_group();
				$c->add_inner_label(__("From Left",'ctp_lang'));
				$show_array[] = array();
				$show_array["class"] = 'col-md-4 col-xs-12';$show_array["counter"] = 1;
				$show_array["tansparency_meter"] = 0;$show_array["behind_text"] = '%';
				$c->add_slider('dw_margin_left_factor', 98, 1, 100, 2, 'horizontal', $show_array);//Text size
			$c->close_form_group();
		$c->close_controls_container();
	    $c->add_photo_help_container('images/logo-positioning.png', '');
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Watermark Central text",'ctp_lang'));
	    $c->open_controls_container('Watermark-text');
			$default_text = __('WATERMARKED','ctp_lang');
			$c->add_textbox('dw_text' , __('Watermark text','ctp_lang'), 'col-8', $default_text);
			$c->add_colorpicker('dw_font_color', '', '#000000');
		$c->close_controls_container();
	    $c->add_help_container(__('Write a short text','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Watermark text position",'ctp_lang'));
	    $c->open_controls_container('watermark-position');
			$options_array = 
			array(
				array('top-left','top-center','top-right','center-left','center-center','center-right','bottom-left','bottom-center','bottom-right'),
				array('Top Left','Top Center','Top Rright','Center Left','Center','Center Right','Bottom Left','Bottom Center','Bottom Right')
			);
			$c->add_image_picker('dw_position', '', $options_array, 'images/img-picker-1', 'center-center');
	    $c->close_controls_container();
		$c->add_help_container(__('Choose a watermark text position','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Central text font size",'ctp_lang'));
	    $c->open_controls_container('Watermark-font-size');
		$c->open_form_group();
			$show_array[] = array();
			$show_array["class"] = 'col-md-4 col-xs-12';$show_array["counter"] = 1;
			$show_array["tansparency_meter"] = 0;$show_array["behind_text"] = '%';
			//add_slider($name, $default_value, $min, $max, $factor, $orientation, $show_array)
			$c->add_slider('dw_font_size_factor', 90, 1, 100, 1, 'horizontal', $show_array);//Text size
		$c->close_form_group();
		$c->close_controls_container();
	    $c->add_help_container(__('Depend on image size','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Watermark Repeated text",'ctp_lang'));
	    $c->open_controls_container('Watermark-r-text');
			$default_text = 'your-site.com';
			$default_text = $_SERVER["SERVER_NAME"];
			$c->add_textbox('dw_r_text' , __('Watermark text','ctp_lang'), 'col-8', $default_text);
			$c->add_colorpicker('dw_r_font_color', '', '#efefef');
		$c->close_controls_container();
	    $c->add_help_container(__('Repeated as a grid on the image','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Repeated text font size",'ctp_lang'));
	    $c->open_controls_container('repeated-text-font-size');
		$c->open_form_group();
			$show_array[] = array();
			$show_array["class"] = 'col-md-4 col-xs-12';$show_array["counter"] = 1;
			$show_array["tansparency_meter"] = 0;$show_array["behind_text"] = '%';
			//add_slider($name, $default_value, $min, $max, $factor, $orientation, $show_array)
			$c->add_slider('dw_r_font_size_factor', 55, 1, 100, 1, 'horizontal', $show_array);//Text size
		$c->close_form_group();
		$c->close_controls_container();
	    $c->add_help_container(__('Depend on image size','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Text transparency",'ctp_lang'));
	    $c->open_controls_container('Watermark-transparency');
		$c->open_form_group();
			$show_array[] = array();
			$show_array["class"] = 'col-md-4 col-xs-12';$show_array["counter"] = 1;
			$show_array["tansparency_meter"] = 1;$show_array["behind_text"] = '';
			$c->add_slider('dw_text_transparency', 65, 1, 100, 1, 'horizontal', $show_array);//Text transparency
		$c->close_form_group();
			$c->add_inner_label(__("Rotation",'ctp_lang'));
			$c->add_textbox('dw_rotation', __('Rotation value','ctp_lang'), 'col-md-4 col-xs-12', '40');//Text Rotation
			// $c->add_filedropdown();
		$c->close_controls_container();
	    $c->add_help_container(__('Rotation value + or - (0 to 360)','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Watermark image filter",'ctp_lang'));
	    $c->open_controls_container('Watermark image filter');
			$options_array = array('Blur','Grayscale','Negate','Britness','None');
			$default_value = 'None';
			$c->add_dropdown('dw_imagefilter', $options_array, $default_value);
		$c->close_controls_container();
	    $c->add_help_container(__('Chosse any filter you want','ctp_lang'));
	$c->close_row();
	$c->add_line();
	
	$c->open_row();
	    $c->add_label(__("Signature",'ctp_lang'));
	    $c->open_controls_container('watermark_effect_3');
			$default_text = __('This image is protected','ctp_lang');
			$c->add_textbox('dw_signature' , __('Signature','ctp_lang'), 'col-8', $default_text);
		$c->close_controls_container();
	    $c->add_help_container(__('Will added at the bottom area of any image','ctp_lang'));
	$c->close_row();
	$c->add_line();
$c->close_tab();
//---------------------------------------------------------------------
// Exclude URLs (pages or posts) form protection
//---------------------------------------------------------------------
global $_wp_additional_image_sizes; 
$c->open_tab('content6');
	$c->open_row();
	    $c->add_label(__("URL Exclude List",'ctp_lang'));
	    $c->open_controls_container('url_exclude_list');
			$bottom_hint = "Example: http://www.mdmasudsikdar.com/";
			$c->add_textarea('url_exclude_list', __('Exclude list','ctp_lang'), 'col-md-10 col-xs-12',$bottom_hint, '');
		$c->close_controls_container();
	    $c->add_help_container(__("Please enter URL's line by line<p><b>Note:</b> Watermarking is out of exclusion</p>
		<P>To use bulk exclusion please put /* at the end of any URL
		<p>Example: mysite.com/cart/*",'ctp_lang'));
	$c->close_row();
	
	$c->open_row();
	    $c->add_label(__("Selection Exclude by class name",'ctp_lang'));
	    $c->open_controls_container('selection_exclude_classes');
			$bottom_hint = "Example: class1";
			$c->add_textarea('selection_exclude_classes', __('Exclude list','ctp_lang'), 'col-md-10 col-xs-12',$bottom_hint, '');
		$c->close_controls_container();
	    $c->add_help_container(__("Write excluded calsses from selection line by line<p><b>Note:</b> This type of exclusion has some special rules</p>",'ctp_lang'));
	$c->close_row();
	
	$c->open_row();
	    $c->add_label(__("Exclude online bots",'ctp_lang'));
	    $c->open_controls_container('bots_exclude');
			$bottom_hint = "Example: googlebot";
			$c->add_textarea('exclude_online_bots', __('Exclude list','ctp_lang'), 'col-md-10 col-xs-12',$bottom_hint, '');
		$c->close_controls_container();
	    $c->add_help_container(__("Write excluded bots line by line",'ctp_lang'));
	$c->close_row();
	
	$c->open_row();
	    $c->add_label(__("Exclude by user type:",'ctp_lang'));
	    $c->open_controls_container('');
			$c->open_controls_row();
				$c->add_checkbox('administrator' , __('Administrators','ctp_lang') , '', '');
				$c->add_checkbox('editor' , __('Editors','ctp_lang') , '', '');
				$c->add_checkbox('author' , __('Authors','ctp_lang') , '', '');
			$c->close_controls_row();
			$c->open_controls_row();
				$c->add_checkbox('contributor' , __('Contributors','ctp_lang') , '', '');
				$c->add_checkbox('subscriber' , __('Subscribers','ctp_lang') , '', '');
				$c->add_empty_col();
			$c->close_controls_row();
		$c->close_controls_container();
	$c->close_row();
	
	function wpsites_list_cats() {

$args = array(
'orderby' => 'name',
'exclude' => '',
'include' => '',
);
$categories = get_categories( $args );
echo'<nav id="primary-navigation" class="primary-navigation" role="navigation">';
foreach ( $categories as $category ) {
echo '<li><a href="' . get_category_link( $category->term_id ) . '">' .  $category->name . '</a></li>';
}
echo'</nav>';

}
//wpsites_list_cats();
	
	$c->open_row();
	    $registered_image_sizes = ctp_main_get_image_sizes();
		
		$options_array = array(); //Empty the $options_array to use it
		
		foreach($registered_image_sizes as $key => $value)
		{
			if (!is_array($value))
			{
				echo $key ." => ". $value ."\r\n" ;
			}
			else
			{
			   $value3 = '';
			   
			   foreach ($value as $key2 => $value2)
			   {
				   $value3 .= " ". $key2 ." => ". $value2 ." ";
			   }
			   
			   $options_array[].= $key;
			   
			   $value3 = '';
			}
		}
		$default_value = 'None';
		//$c->add_multiselection_dropdown('image_sizes' , $options_array , $default_value);
		//echo $c->ctp_main_get_setting('image_sizes');
	$c->close_row();

$c->close_tab();
//---------------------------------------------------------------------
//Custom Settings
//---------------------------------------------------------------------
$c->open_tab('content7');
	$c->open_row();
        $c->add_label(__('Show the plugin icon in the top admin bar','ctp_lang'));
        $c->open_controls_container('plugin-icon-top-admin-bar');
	        $options_array = array('Yes','No');
	        $default_value = 'Yes';
	        $c->add_dropdown('show_admin_bar_icon', $options_array, $default_value);
		$c->close_controls_container();
	$c->add_help_container(__('Used for going to plugin settings page fast','ctp_lang'));
    $c->close_row();
	$c->add_line();
	
	$c->open_row();
        $c->add_label(__('Show the plugin rating bar','ctp_lang'));
        $c->open_controls_container('plugin-rating-bar');
	        $options_array = array('Yes','No');
	        $default_value = 'Yes';
	        $c->add_dropdown('show_rating_message', $options_array, $default_value);
		$c->close_controls_container();
	$c->add_help_container(__('Used for show/hide plugin rating page','ctp_lang'));
    $c->close_row();
$c->close_tab();

//---------------------------------------------------------------------
//About tab
//---------------------------------------------------------------------
$c->open_tab('content8');
	$c->open_row();
	    $c->add_label(__("Getting Support:",'ctp_lang'));
	    $c->open_controls_container('Getting-Support');
			echo '<a href="https://www.mdmasudsikdar.com"><img src="'.$pluginsurl.'/images/wp-buy-new-logo.png"></a><p></p>';
			echo "<font size=4pt>";
			_e( "I would love to hear from you! Please write any question you want and I will get in touch with you shortly.",'ctp_lang');
			echo '<p></p>';
			_e( "Web: <a href='https://www.mdmasudsikdar.com' class='text-success'>www.mdmasudsikdar.com</a>",'ctp_lang');
			echo '<p></p>';
			_e( "Email: <a href='mailto:contact@mdmasudsikdar.com' class='text-success'>contact@mdmasudsikdar.com</a>",'ctp_lang');
			echo '<p></p>';
			echo "</font>";
		$c->close_controls_container();
	$c->close_row();

$c->close_tab();
?>
<div style="width:98%;" class="">
    <div class="row justify-content-center">
    <?php
    if($c -> ctp_main_get_setting('show_rating_message') == 'Yes')
    {
        echo ctp_rate_us('https://wordpress.org/support/plugin/content-thief-protector/reviews/?filter=5', '#191E23');
    }
    ?>
    </div>
<div class="row justify-content-center form-btns">
	<div class=""><input type="submit" class="btn btn-secondary" value="Restore defaults" style="width: 193; height: 29;" name="Restore_defaults"></div>
	<div class=""><input type="button" class="btn btn-primary" alt="Use CTRL+F5 after saving" onclick="show_ctp_main_message('This is a preview message (do not forget to save changes)');" value="Preview alert message" style="width: 193; height: 29;" name="B5"></div>
	<div class=""><input class="btn btn-success" type="submit" value="Save Settings" name="Save_settings" style="width: 193; height: 29;"></div>
</div></div>
</div><!-- tabs div end -->
<style>
.form-btns .btn{
	width:180px !important;
	margin-right: 5px;
	float: right;
}
@media (max-width: 415px)
{
	.form-btns .btn
	{
	width:250px !important;
	}
}
@media (min-width: 416px) and (max-width: 575.98px)
{
	.form-btns .btn
	{
	width:390px !important;
	}
}
@media (min-width: 576px) and (min-width: 768px)
{
	.form-btns .btn
	{
	width:180px !important;
	margin-right: 5px;
	}
}
@media (max-width: 768px)
{
	.help-container
	{
		display: none;
	}
	.welling {
		background-color: #fff;
		max-height: 30px;
		margin-top: 15px;
		background-image: -webkit-linear-gradient(left, #5d5d5d, #757474 1%, transparent 1%, transparent 100%);
		padding-left: 15px;
	}
	hr{display:none;}
	.controls_container{
		margin-top: 6px;
	}
}
@media screen and (max-width: 782px){.wp-picker-container input[type=text].wp-color-picker{width:80px;padding:6px 5px 5px;font-size:16px;line-height:18px}.wp-customizer .wp-picker-container input[type=text].wp-color-picker{padding:5px 5px 4px}.wp-picker-container .wp-color-result.button{height:auto;padding:0 0 0 40px;font-size:14px;line-height:29px}.wp-customizer .wp-picker-container .wp-color-result.button{font-size:13px;line-height:26px}.wp-picker-container .wp-color-result-text{padding:0 14px;font-size:inherit;line-height:inherit}.wp-customizer .wp-picker-container .wp-color-result-text{padding:0 10px}}
</style>
<script>
jQuery(document).ready(function(){
  var changeWidth = function(){
    if ( jQuery(window).width() < 575.98 ){
    jQuery('.form-btns').removeClass('justify-content-end').addClass('justify-content-center');
    } else {
      jQuery('.form-btns').removeClass('justify-content-center').addClass('justify-content-end');
    }
  };
  jQuery(window).resize(changeWidth);
});
</script>
</form>
<div class="msgmsg-box-wpcp warning-wpcp hideme" id="wpcp-error-message"><b>Alert: </b>Content is protected !!</div>


<style type="text/css">
	#wpcp-error-message {
	    direction: ltr;
	    text-align: center;
	    transition: opacity 900ms ease 0s;
	    z-index: 99999999;
	}
	.hideme {
    	opacity:0;
    	visibility: hidden;
	}
	.showme {
    	opacity:1;
    	visibility: visible;
	}
	.enable-me{

	}
	.disable-me{

	}
	.msgmsg-box-wpcp {
		border-radius: 10px;
		color: <?php echo $ctp_main_settings['font_color'];?>;
		font-family: Tahoma;
		font-size: 11px;
		margin: 10px;
		padding: 10px 36px;
		position: fixed;
		width: 255px;
		top: 50%;
  		left: 50%;
  		margin-top: -10px;
  		margin-left: -130px;
  		-webkit-box-shadow: 0px 0px 34px 2px <?php echo $ctp_main_settings['shadow_color'];?>;
		-moz-box-shadow: 0px 0px 34px 2px <?php echo $ctp_main_settings['shadow_color'];?>;
		box-shadow: 0px 0px 34px 2px <?php echo $ctp_main_settings['shadow_color'];?>;
	}
	.msgmsg-box-wpcp span {
		font-weight:bold;
		text-transform:uppercase;
	}
	.error-wpcp {<?php global $pluginsurl; ?>
		background:#ffecec url('<?php echo $pluginsurl ?>/images/error.png') no-repeat 10px 50%;
		border:1px solid #f5aca6;
	}
	.success {
		background:#e9ffd9 url('<?php echo $pluginsurl ?>/images/success.png') no-repeat 10px 50%;
		border:1px solid #a6ca8a;
	}
	.warning-wpcp {
		background:<?php echo $ctp_main_settings['msg_color'];?> url('<?php echo $pluginsurl ?>/images/warning.png') no-repeat 10px 50%;
		border:1px solid <?php echo $ctp_main_settings['shadow_color'];?>;
	}
	.notice {
		background:#e3f7fc url('<?php echo $pluginsurl ?>/images/notice.png') no-repeat 10px 50%;
		border:1px solid #8ed9f6;
	}
</style>
<?php
########## function creation ##################

function ctp_rate_us($plugin_url, $box_color='#0e6d25'){
	
	$ret = '
	<style type="text/css">
	
	.rate_box{
		max-width:700px;
		background-color: #1e5638 !important;
		color:#ffffff;
		margin:10px;
		-webkit-border-radius: 7px;
		-moz-border-radius: 7px;
		border-radius: 7px;
		padding:5px;
		direction: ltr;

	}
	.rating {
	  unicode-bidi: bidi-override;
	  direction: rtl;
	  
	  
	}
	.link_wp{
		color:#EDAE42 !important
	}
	.rating > span {
	  display: inline-block;
	  position: relative;
	  width: 1.1em;
	  font-size:22px;
	}
	.rating > span:hover:before,
	.rating > span:hover ~ span:before {
	   content: "\2605";
	   position: absolute;
	   color:yellow;
	}
	</style>';
	
	$ret .= '<div id="rate_box" class="row rate_box">
<div class="col-md-8">
<p>
<strong>Do you like this plugin?</strong><br /> Please take a few seconds to <a class="link_wp" href="'.$plugin_url.'" target="_blank">rate it on WordPress.org!</a></p>
</div>
<div class="col-md-4">
<div class="rating">';

	for($r=1; $r<=5; $r++)
	{
		
		$ret .= '<span onclick="window.open(\''.$plugin_url.'\',\'_blank\')">☆</span>';
	}

$ret .= '</div>
</div>
</div>';
return $ret;
}
//---------------------------------------------------------------------------------------------
/* Get size information for all currently-registered image sizes.
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.*/
//---------------------------------------------------------------------------------------------
function ctp_main_get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}

//---------------------------------------------------------------------------------------------
/* Get size information for a specific registered image size.
 * @uses   ctp_main_get_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.*/
 //---------------------------------------------------------------------------------------------
function get_image_size( $size ) {
	$sizes = ctp_main_get_image_sizes();

	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}

	return false;
}
//---------------------------------------------------------------------
//Check if watermark directory is created & writable or not
//---------------------------------------------------------------------
function ctp_main_check_watermark_dir_can_cache()
{
	$upload_dir = wp_upload_dir();

	$basedir = $upload_dir['basedir'];  //   /home3/server-folder/sitefoldername.com/wp-content/uploads

	$cachedir = $basedir. '/ctp_main_watermarked_images';
		
	$can_cache = false;

	if($cachedir !== false AND is_dir($cachedir) AND is_writable($cachedir))
		{
			$can_cache = true;
		}
	if (!$can_cache) $can_cache = create_watermarked_images_directory();

	return $can_cache;
}
//---------------------------------------------------------------------
//php delete function that deals with directories recursively
//---------------------------------------------------------------------
function ctp_main_delete_watermarked_cached_images($cachedir) {
    
	$upload_dir = wp_upload_dir();

	$basedir = $upload_dir['basedir'];  //   /home3/server-folder/sitefoldername.com/wp-content/uploads

	if (!isset($cachedir) || $cachedir == '') $cachedir = $basedir. '/ctp_main_watermarked_images/';
	
	$can_delete_cache = false;

	if($cachedir !== false AND is_dir($cachedir) AND is_writable($cachedir))
		{
			$can_delete_cache = true;
		}
	if($can_delete_cache){
        
		$files = glob( $cachedir . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file )
		{
			
            ctp_main_delete_watermarked_cached_images( $file );
        }

        rmdir( $cachedir );
    } elseif(is_file($cachedir)) {
        unlink( $cachedir );  
    }
}
//---------------------------------------------------------------------------------------------
//Update htaccess file when Save or restore defaults
//---------------------------------------------------------------------------------------------
if(isset( $_POST['Save_settings'] ))
{
	if($_POST['hotlinking_rule'] == "Watermark" || $_POST['mysite_rule'] == "Watermark")
	{
		ctp_main_modify_htaccess();
	}
	if($_POST['hotlinking_rule'] == "No Action" && $_POST['mysite_rule'] == "No Action")
	{
		ctp_main_clear_htaccess();
	}
}
if ( isset( $_POST['Restore_defaults'] ) ) 
{
	ctp_main_modify_htaccess();
	
	$ctpadminurl = get_admin_url();
	
	$settings_url = $ctpadminurl.'options-general.php?page=ctp-main-menu-option';
	
	header("Location: ".$settings_url);
}
?>

