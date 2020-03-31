<?php
if(!isset($_SESSION)) 
    { 
        //session_start(); 
    }

$pluginsurl = plugins_url( '', __FILE__ );

$ctp_main_settings = ctp_main_read_options();

function ctp_main_save_setting($name, $default_value)
{
	$ctp_main_settings = ctp_main_read_options();
	
	if (!array_key_exists("$name",$ctp_main_settings) && !isset( $_POST['Save_settings'] ) && isset( $_POST['Restore_defaults'] )) //Restore defaults
	{
		$option_new_value = $default_value;
		
		$ctp_main_settings["$name"] = $option_new_value;
		
		update_blog_option_single_and_multisite( 'ctp_main_settings' , $ctp_main_settings );
		//update_blog_option( int $id, string $option, mixed $value, mixed $deprecated = null )
		
		
	}
	
	if (!array_key_exists("$name",$ctp_main_settings) && !isset( $_POST['Save_settings'] ) && !isset( $_POST['Restore_defaults'] )) //Option saved with default value after first activation
	{
		$option_new_value = $default_value;
		
		$ctp_main_settings["$name"] = $option_new_value;
		
		update_blog_option_single_and_multisite( 'ctp_main_settings' , $ctp_main_settings );
	}
	
	if(isset( $_POST['Save_settings'] )) //Save settings
	{
		$ctp_main_settings = ctp_main_read_options();
		
		$option_new_value = '';
		
		if(isset($_POST["$name"])) $option_new_value = $_POST["$name"];
		
		if (!isset($_POST["$name"]) && $ctp_main_settings["$name"] != '') $option_new_value = $ctp_main_settings["$name"];
		
		if(!isset($_POST["$name"]) && $ctp_main_settings["$name"] == 'checked') $option_new_value = '';
		
		$ctp_main_settings["$name"] = $option_new_value;
		
		update_blog_option_single_and_multisite( 'ctp_main_settings' , $ctp_main_settings );

		$ctp_main_settings = ctp_main_read_options();
	}
}

function update_blog_option_single_and_multisite($option,$value)
{
	if(is_multisite())
	{
		$id = get_current_blog_id();
		update_blog_option($id, $option,$value);
	}
	else
	{
		update_option($option,$value);
	}
}

function get_blog_option_single_and_multisite($option = '')
{
	if(is_multisite())
	{
		$id = get_current_blog_id();
		return get_blog_option($id, $option);
	}
	else
	{
		return get_option($option);
	}
}

//---------------------------------------------------------------------------------------------
//Function to read options from the database
//---------------------------------------------------------------------------------------------
function ctp_main_read_options()
{
	if (get_blog_option_single_and_multisite('ctp_main_settings'))
		$ctp_main_settings = get_blog_option_single_and_multisite('ctp_main_settings');
	else
		$ctp_main_settings = array();
	
	$defaults_array = array('single_posts_protection' => '',"home_page_protection" => 'checked','page_protection' => 'checked',
	'smessage' => 'checked','ctrl_message' => 'checked','prntscr_protection' => 'checked','ctrl_p_protection' => 'checked',
	'ctrl_s_protection' => 'checked','ctrl_i_protection' => 'checked','ctrl_a_protection' => 'checked','ctrl_c_protection' => 'checked','ctrl_x_protection' => 'checked',
	'ctrl_v_protection' => 'checked','ctrl_u_protection' => 'checked','f12_protection' => 'checked','custom_keys_message' => 'checked',
	'prnt_scr_msg' => 'Protected' ,'msg_color' => '','font_color' => '','border_color' => '','shadow_color' => '',
	'message_show_time' => 3,'right_click_protection_posts' => 'checked','right_click_protection_homepage' => "checked",
	'right_click_protection_pages' => "checked",'img' => "checked", 'a' => "checked", 'pb' => "checked",
	'h' => "checked",'textarea' => "checked", 'input' => "checked", 'emptyspaces' => "checked",
	'videos' => "", 'alert_msg_img' => "Alert: Protected image", 'alert_msg_a' => "Alert: This link is protected",
	'alert_msg_pb' => "Alert: Right click on text is disabled",
	'alert_msg_h' => "Alert: Right click on headlines is disabled",
	'alert_msg_textarea' => "Alert: Right click is disabled",
	'alert_msg_input' => "Alert: Right click is disabled",
	'alert_msg_emptyspaces' => "Alert: Right click on empty spaces is disabled",
	'alert_msg_videos' => "Alert: Right click on videos is disabled",
	'home_css_protection' => "Yes", 'posts_css_protection' => "Yes", 'pages_css_protection' => "Yes",
	'custom_css_code' => "", 'protection_overlay_posts' =>"", 'protection_overlay_homepage' =>"",
	'protection_overlay_pages' =>"", 'remove_img_urls' => "No", 'no_js_action' => "Nothing",'watermark_caching' => 'checked',
	'hotlinking_rule' => "Watermark", 'mysite_rule' => "Watermark", 'dw_logo' => "", 'dw_margin_top_factor' => 98,
	'dw_margin_left_factor' => 98, 'dw_text' => "WATERMARKED", 'dw_font_color' => "#000000",
	'dw_position' => "center-center", 'dw_font_size_factor' => 90, 'dw_r_text' => "www.mywebsite.com",
	'dw_r_font_color' => "#efefef", 'dw_r_font_size_factor' => 55, 'dw_text_transparency' => 65, 'dw_rotation' => 40,
	'dw_imagefilter' => "None", 'dw_signature' => "This image is protected", 'url_exclude_list' =>"",
	'selection_exclude_classes' =>"", 'exclude_online_bots' =>"", 'administrator' =>"checked", 'editor' =>"", 'author' =>"",
	'contributor' =>"", 'subscriber' =>"", 'show_admin_bar_icon' => "Yes",
	'show_rating_message' => "Yes" );

	foreach ($ctp_main_settings as $key=>$value)
	{
		$ctp_main_settings[$key] = stripslashes($value);
	}
	
	if (isset($_GET['page']))
	{
		if($_GET['page'] != 'ctp-main-menu-option') //We don't want this merge to work inside plugin admin panel
		{
			$ctp_main_settings = array_merge($defaults_array, $ctp_main_settings);//Set default value for any unexisted key
		}
	}
	else
	{
		$ctp_main_settings = array_merge($defaults_array, $ctp_main_settings);//Set default value for any unexisted key
	}
	
	return $ctp_main_settings;

}
function ctp_main_cover_images( $content ) {

	global $ctp_main_settings;

	//if($ctp_main_settings["mysite_rule"] == "Fast Watermark (Recommended)"){

		$regexp = '<img[^>]*>';

		if(preg_match_all("/$regexp/iU", $content, $matches, PREG_SET_ORDER)) {

			if( !empty($matches) ) {

				$srcUrl = get_permalink();

				for ($i=0; $i <= count($matches); $i++)
				{
					if (isset($matches[$i]) && isset($matches[$i][0]))
					{
						$tag = $matches[$i][0];
					}
					else
					{
						$tag = '';
					}
					$tag2 = '';
					
					echo htmlentities($tag, ENT_QUOTES) . '<br><br>';

					$tag2 = '<div class="cover-container">'.'<div class="glass-cover"></div>'.$tag.'</div>';
					
					$tag2 = '<div class="cover-container">'.
					''.$tag.'<h2><span>A Movie in the Park:<span class="spacer">&nbsp;</span><br><span class="spacer">&nbsp;</span>Kung Fu Panda</span></h2></div>';
					
					$content = str_replace($tag,$tag2,$content);

				}

			}
		}
	//}
	return $content;
}
////////////////////////////////////////////////////////////////////////
function ctp_main_find_image_urls( $content ) {
	
	global $ctp_main_settings;
	
	if($ctp_main_settings["remove_img_urls"] == "Yes"){

	$regexp = '(href=\"http)(.*)(.jpg|.jpeg|.png)';

	if(preg_match_all("/$regexp/iU", $content, $matches, PREG_SET_ORDER)) {

		if( !empty($matches) ) {

			$srcUrl = get_permalink();

			for ($i=0; $i <= count($matches); $i++)
			{
				if (isset($matches[$i]) && isset($matches[$i][0]))

					$tag = $matches[$i][0];

				else

					$tag = '';

				$tag2 = '';

				$content = str_replace($tag,$tag2,$content);
			}
		}
	}
	}
	return $content;
}

////////////////////////////////////////////////////////////////////////
function ctp_main_add_style() {
	global $ctp_main_pluginsurl;
	echo wp_enqueue_script('ctp_main_add_style', $ctp_main_pluginsurl.'/hide-saving.css');
}
////////////////////////////////////////////////////////////////////////
function get_selection_exclude_classes()
{
	global $ctp_main_settings;

	$selection_exclude_classes = '';

	if ( isset( $ctp_main_settings['selection_exclude_classes'] ) )
	{
		$selection_exclude_classes = $ctp_main_settings['selection_exclude_classes'];
	}

	// Processes \r\n's first so they aren't converted twice.
	$selection_exclude_classes = str_replace("\\n", "\n", $selection_exclude_classes);

	$selection_exclude_classes = str_replace("\n", ",", $selection_exclude_classes);

	$selection_exclude_classes = str_replace("\r", ",", $selection_exclude_classes);

	$selection_exclude_classes = str_replace("|", ",", $selection_exclude_classes);

	$selection_exclude_classes = str_replace(",,", ",", $selection_exclude_classes);
	
	return $selection_exclude_classes;
}
////////////////////////////////////////////////////////////////////////
function ctp_main_global_js_scripts()
{
	global $ctp_main_settings;

	$selection_exclude_classes = '';

	if ( isset( $ctp_main_settings['selection_exclude_classes'] ) )
	{
		$selection_exclude_classes = $ctp_main_settings['selection_exclude_classes'];
	}

	// Processes \r\n's first so they aren't converted twice.
	$selection_exclude_classes = str_replace("\\n", "\n", $selection_exclude_classes);

	$selection_exclude_classes = str_replace("\n", ",", $selection_exclude_classes);

	$selection_exclude_classes = str_replace("\r", ",", $selection_exclude_classes);

	$selection_exclude_classes = str_replace("|", ",", $selection_exclude_classes);

	$selection_exclude_classes = str_replace(",,", ",", $selection_exclude_classes);

?>
<script id="ctp_main_class_exclusion" type="text/javascript">
function apply_class_exclusion(e)
{
	var my_return = 'No';
	
	var e = e || window.event; // also there is no e.target property in IE. instead IE uses window.event.srcElement
  	
	var target = e.target || e.srcElement || 'nothing';
	
	console.log (target.parentElement.className);
	
	var excluded_classes = '<?php echo $selection_exclude_classes; ?>' + '';
	
	var class_to_exclude = target.className + ' ' + target.parentElement.className || '';
	
	var class_to_exclude_array = class_to_exclude.split(" ");
	
	console.log (class_to_exclude_array);
	
	class_to_exclude_array.forEach(function(item)
	{
		if(item != '' && excluded_classes.indexOf(item)>=0)
		{
			target.style.cursor = "text";
			
			console.log ('Yes');
			
			my_return = 'Yes';
		}
	});

	try {
		class_to_exclude = target.parentElement.getAttribute('class') || target.parentElement.className || '';
		}
	catch(err) 
		{
		class_to_exclude = '';
		}
	
	if(class_to_exclude != '' && excluded_classes.indexOf(class_to_exclude)>=0)
	{
		target.style.cursor = "text";
		my_return = 'Yes';
	}

	return my_return;
}
</script>
<?php
}
?>
<?php
////////////////////////////////////////////////////////////////////////
function ctp_main_alert_message()
{
	global $ctp_main_settings;
?>
	<div oncontextmenu="return false;" id='ctp_main_mask'></div>
	<div id="wpcp-error-message" class="msgmsg-box-wpcp warning-wpcp hideme"><span>error: </span><?php echo $ctp_main_settings['smessage'];?></div>
	<script>
	var timeout_result;
	function show_ctp_main_message(smessage)
	{
		<?php
		$timeout = $ctp_main_settings['message_show_time'] * 1000;
		
		if (isset($_GET['page']))
		{
			$admincore = $_GET['page'];
			
			if($admincore == 'ctp-main-menu-option') $timeout = 4000;
		}
		?>
		
		timeout = <?php echo $timeout;?>;
		
		if (smessage !== "" && timeout!=0)
		{
			var smessage_text = smessage;
			jquery_fadeTo();
			document.getElementById("wpcp-error-message").innerHTML = smessage_text;
			document.getElementById("wpcp-error-message").className = "msgmsg-box-wpcp warning-wpcp showme";
			clearTimeout(timeout_result);
			timeout_result = setTimeout(hide_message, timeout);
		}
		else
		{
			clearTimeout(timeout_result);
			timeout_result = setTimeout(hide_message, timeout);
		}
	}
	function hide_message()
	{
		jquery_fadeOut();
		document.getElementById("wpcp-error-message").className = "msgmsg-box-wpcp warning-wpcp hideme";
	}
	function jquery_fadeTo()
	{
		try {
			jQuery("#ctp_main_mask").fadeTo("slow", 0.3);
		}
		catch(err) {
			//alert(err.message);
			}
	}
	function jquery_fadeOut()
	{
		try {
			jQuery("#ctp_main_mask").fadeOut( "slow" );
		}
		catch(err) {}
	}
	</script>
	<style type="text/css">
	#ctp_main_mask
	{
		position: absolute;
		bottom: 0;
		left: 0;
		position: fixed;
		right: 0;
		top: 0;
		background-color: #000;
		pointer-events: none;
		display: none;
		z-index: 10000;
		animation: 0.5s ease 0s normal none 1 running ngdialog-fadein;
		background: rgba(0, 0, 0, 0.4) none repeat scroll 0 0;
	}
	#wpcp-error-message {
	    direction: ltr;
	    text-align: center;
	    transition: opacity 900ms ease 0s;
		pointer-events: none;
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
	.msgmsg-box-wpcp b {
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
}
?>