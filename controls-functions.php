<?php
class ctp_main_controls_class{
	//---------------------------------------------------------------------
	//Layout builders
	//---------------------------------------------------------------------
	public static function open_tab($tab_id)
	{
		//echo '<div class="simpleTabsContent"><!-- Tab Opened -->';
		echo '<section id="' .$tab_id. '" class="tab-content"><!-- Tab Opened -->';
	}
	public static function add_tab_heading($text)
	{
		echo '<div class="row align-items-center tab_heading_text">'. $text .'</div>';
	}
	public static function close_tab()
	{
		echo '</section><!-- Tab Closed -->';
	}
	public static function open_row()
	{
		echo '<div class="row align-items-center">';
	}
	public static function close_row()
	{
		echo '</div><!-- Row Closed -->';
	}
	public static function open_form_group()
	{
		echo '<div class="col"><!-- Form Group Opened -->';
	}
	public static function open_controls_row()
	{
		echo '<div class="row col-12"><!-- Controls_row Opened -->';
	}
	public static function close_controls_row()
	{
		echo '</div><!-- Controls_row Closed -->';
	}
	public static function close_form_group()
	{
		echo '</div><!-- Form Group Closed -->';
	}
	public static function add_label($text)
	{
		echo '<div class="col-md-2 col-12"><div class="welling"><span>'. $text .'</span></div></div>';
	}
	public static function add_inner_label($text)
	{
		//echo '<div class="col-md-2 col-12"><div class="inner-label"><span>'. $text .'</span></div></div>';
		echo '<label for="disabledSelect">' . $text . '</label>';
	}
	public static function open_controls_container($id)
	{
		echo '<div id="container_'.$id.'" style="" class="col-md-7 col controls_container">';
		echo '<div class="row d-flex align-items-center">';
	}
	public static function close_controls_container()
	{
	    echo '</div></div>';
	}
	public static function add_help_container($text)
	{
	    echo '<div class="col-md-3 col-12 help-container"><div class="welling"><span>'. $text .'</span></div></div><!-- Help container closed -->';
	}
	public static function add_line()
	{
	    echo '<hr style="margin-bottom: 5px; margin-top: 5px;">';
	}
	public static function add_section($title,$color)
	{
		if($color == '') $color = '#1ABC9C';
		echo '<div class="col-lg-12 section"><h4><strong><font size="3" color="$color">'.$title.'</font></strong></h4></div>';
		
		echo "<style>.col-lg-12.section {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: rgba(0, 0, 0, 0) linear-gradient(to right bottom, #f8f8f8, #fff) repeat scroll 0 0;
    border-bottom: 1px solid #f1f1f1;
    border-image: none;
    border-left: 7px solid;
    border-right: 1px solid #f1f1f1;
    color: $color;
    margin: 8px 0;}</style>";
	}
	public static function close_div()
	{
		echo '</div>';
	}
	//---------------------------------------------------------------------
	//Function to show a message (alert - success - fail) after saving
	//---------------------------------------------------------------------
	public static function save_changes_message()
	{
		echo 'Settings saved successfully';
	}
	//---------------------------------------------------------------------
	//Function to add a static photo behind any control
	//---------------------------------------------------------------------
	public static function add_photo_help_container($path, $class)
	{
		$pluginsurl = plugins_url( '', __FILE__ );
		
		$img = '<img id="'.$class.'" border="0" src="'. $pluginsurl .'/'.$path.'">';
		
		echo '<div class="col-md-3 col-5 help-container"><div class="welling"><span>'. $img .'</span></div></div><!-- Photo container closed -->';
	}
	//---------------------------------------------------------------------
	//Function to get settings from the main options array
	//---------------------------------------------------------------------
	public static function ctp_main_get_setting($name)
	{
		$ctp_main_settings = ctp_main_read_options();
		
		if (array_key_exists($name,$ctp_main_settings))
		{
			$option_value = $ctp_main_settings["$name"];
		}
		else
		{
			$option_value = '';
		}
		return stripslashes($option_value);
	}
	//---------------------------------------------------------------------
	//Add dropdown control
	//---------------------------------------------------------------------
	public static function add_dropdown($name , $options_array , $default_value)
	{
		ctp_main_save_setting($name, $default_value);
		
		$choosed_option_value = self::ctp_main_get_setting($name);
		
		echo '<div id="div_'.$name.'" class="col-md-5 col-xs-12">';
		
	    	echo '<div class="styled-select-div">';
			
			echo '<select class="" size="1" id="'.$name.'" name="'.$name.'">'; //form-control select select-primary select-block mbl
	    	
	    	$arrlength = count($options_array);
	    	
	    	for($x = 0; $x < $arrlength; $x++)
	    	{
	    		if ($options_array[$x] == $choosed_option_value)
	    		
	    			echo '<option selected>'.$options_array[$x].'</option>';
	    			
	    		else
	    		
	    			echo '<option>'.$options_array[$x].'</option>';
	    	}
	    	
	    	echo '</select>';
	    	
	    	echo '</div>';

		echo '</div>';
	}
	//---------------------------------------------------------------------
	//Add multiselection dropdown control
	//---------------------------------------------------------------------
	public static function add_multiselection_dropdown($name , $options_array , $default_value)
	{
		ctp_main_save_setting($name, $default_value);
		
		$choosed_option_value = self::ctp_main_get_setting($name);

		//print_r($choosed_option_value);
		
		$values = $choosed_option_value;

		foreach ($values as $a){
			
			echo $a;
		}
		
		echo '<div id="div_'.$name.'" class="col-md-5 col-xs-12">';
		
	    	echo '<select class="selectpicker" multiple size="1" id="'.$name.'[]" name="'.$name.'[]">';
	    	
	    	$arrlength = count($options_array);
	    	
	    	for($x = 0; $x < $arrlength; $x++)
	    	{
	    		//if ($options_array[$x] == $choosed_option_value)
				
				if (in_array(($options_array[$x]), ($choosed_option_value)))
				
	    			echo '<option value="'. $x .'" data-subtext="Heinz1" selected>'.$options_array[$x].'</option>';
				
	    		else
	    		
	    			echo '<option  value="'. $x .'" data-subtext="Heinz">'.$options_array[$x].'</option>';
	    	}
	    	
	    	echo '</select>';

		echo '</div>';
	}
	//---------------------------------------------------------------------
	//add button
	//---------------------------------------------------------------------
	public static function add_button($name , $class, $default_value, $disable_after_click, $clicked_message)
	{
		ctp_main_save_setting($name, $default_value);
		
		$is_disabled = "";
		
		if ($disable_after_click && isset( $_POST['clear_cached_images'] ) ) 
		{
			$is_disabled = "disabled";
		}
		
		echo "<div style=\"padding-bottom: 5px;\" class=\"$class\">";
		
		echo "<input $is_disabled type=\"submit\" class=\"form-control btn btn-success\" name=\"$name\" id=\"$name\" value=\"$default_value\" style=\"width: auto; height: auto;\">";
		
		if ($clicked_message !='' && isset( $_POST['clear_cached_images'] ) ) 
		{
			echo '<label style="margin: 0; margin-left: 7px; color: green;">'. $clicked_message .'</label>';
		}
		
		echo '</div>';
	}
	//---------------------------------------------------------------------
	//add textbox control
	//---------------------------------------------------------------------
	public static function add_textbox($name , $placeholder, $class, $default_value)
	{
		ctp_main_save_setting($name, $default_value);
		
		$choosed_option_value = self::ctp_main_get_setting($name);
		
		echo "<div style=\"padding-bottom: 5px;\" class=\"$class\">";
		
		echo "<input type=\"text\" placeholder=\"$placeholder\" class=\"form-control textbox_custom\" name=\"$name\" id=\"$name\"   value=\"$choosed_option_value\" size=\"25\">";
		
		echo '</div>';
	}
	//---------------------------------------------------------------------
	//add bottom hint under any control
	//---------------------------------------------------------------------
	public static function add_bottom_hint($bottom_hint)
	{
		echo '<div class="col-md-12 col-xs-12"><div class="">';
		
		echo "<span>$bottom_hint</span>";
		
		echo '</div></div>';
	}
	//---------------------------------------------------------------------
	//add textarea
	//---------------------------------------------------------------------
	public static function add_textarea($name , $placeholder, $class, $bottom_hint, $default_value)
	{
		ctp_main_save_setting($name, $default_value);
		
		$choosed_option_value = self::ctp_main_get_setting($name);

		//$choosed_option_value = '1';
		
		echo "<div style=\"padding-bottom: 5px;\" class=\"$class\">";
		
		echo "<textarea placeholder=\"$placeholder\" class=\"form-control textbox_custom\" name=\"$name\" id=\"$name\">$choosed_option_value</textarea>";
		
		echo '</div>';
		
		echo '<div class="col"><div class="">';
		
		echo "<span>$bottom_hint</span>";
		
		echo '</div></div>';
	}
	//---------------------------------------------------------------------
	//add colorpicker control whitch belongs to wordpress
	//---------------------------------------------------------------------
	public static function add_colorpicker($name, $behind_text, $default_color)
	{
		ctp_main_save_setting($name, $default_color);
		
		$choosed_option_value = self::ctp_main_get_setting($name);
		
		echo '<div class="col"><div class="framework_small_font">'.$behind_text.'</div>';
		
		if ($choosed_option_value == '') $choosed_option_value = $default_color;
			
			echo "<input name=\"$name\" type=\"text\" value=\"$choosed_option_value\" class=\"nrcw-colorpicker-field\" data-default-color=\"$default_color\" />";
		
		echo "<style>.wp-picker-input-wrap,.wp-picker-holder{position: absolute;z-index:9999999;background:#ffffff;}</style>";
		
		echo "<script>jQuery(document).ready(function($){
		jQuery('.nrcw-colorpicker-field').wpColorPicker();});</script>";
		
		echo '</div>';
	}
	//---------------------------------------------------------------------
	//add dismissable alert anywhere
	//---------------------------------------------------------------------
	public static function add_dismissable_box($name, $behind_text, $default_color)
	{
		//https://premium.wpmudev.org/blog/adding-admin-notices/
	}
	//---------------------------------------------------------------------
	//add Slider control
	//---------------------------------------------------------------------
	public static function add_slider($name, $default_value, $min, $max, $factor, $orientation, $show_array)
	{
		ctp_main_save_setting($name, $default_value);
		
		$choosed_option_value = self::ctp_main_get_setting($name);
		
		echo '<div class="col"><div class="row justify-content">';
		
		echo '<div style="float: left; max-width:250px !important;">';
			
			echo '<input type="range" min="'. $min .'" max="'. $max .'" step="1" value="'.$choosed_option_value.'" class="sliderr" name="'.$name.'" id="'.$name.'"><br/>';
		
		echo '</div>';
		
		echo '<div class="rounded-circle" style="background:#f1f1f1;text-align:center; display: block; margin-left:7px; width: 27px;"><span id="span'.$name.'">'.$choosed_option_value.'</span></div>';
		
		echo '</div></div>';
		
		echo '<script>';
		
			echo 'var range_slider_value_'.$name.' = document.getElementById("'.$name.'");';
			
			echo 'var range_slider_output_tag_'.$name.' = document.getElementById("span'.$name.'");';

			echo 'range_slider_output_tag_'.$name.'.innerHTML = range_slider_value_'.$name.'.value;';

			echo 'range_slider_value_'.$name.'.oninput = function() { range_slider_output_tag_'.$name.'.innerHTML = this.value; }';
			
		echo '</script>';
	}
	
	//////////////////////////////////////
	public static function add_slider2($name, $default_value, $min, $max, $factor, $orientation, $show_array)
	{
		ctp_main_save_setting($name, $default_value);
		
		$choosed_option_value = self::ctp_main_get_setting($name);
		
		$pluginsurl = plugins_url( '', __FILE__ );
		
		if(!array_key_exists('class', $show_array)) $show_array["class"] = 'col-md-4 col-xs-12';
		
		echo '<div class="'. $show_array["class"] .'" style="margin-top: 20px;">';

		echo '<div class="'.$name.'_tooltip"></div><div onmousemove="getslidervalue_'.$name.'();" id="'.$name.'_slider_div"></div>';
		
		echo '</div>';
		
		if ($show_array["counter"] == 1)
		{
			echo '<div class="col-md-1 col-xs-3" style="margin-top: 13px;">';
			
			echo '<input id="'.$name.'" name="'.$name.'" value="'.$choosed_option_value.'" readonly type="number" size="5" style="border: 1px solid #FFFFFF; border-radius: 44px;text-align: center;width: 45px;">';
			
			echo '</div>';
		}
		else
		{
			echo '<input hidden id="'.$name.'" name="'.$name.'" value="'.$choosed_option_value.'" readonly type="text" size="5" style="border: 1px solid #FFFFFF; border-radius: 44px;text-align: center;width: 45px;">';
		}

		if ($show_array["tansparency_meter"] == 1)
		{
			echo '<div class="col-md-1 col-xs-4" style="margin-top: 12px;">';
			
			$opacity = 1 - ($choosed_option_value/$max);
			
			echo '<img border="0" style="opacity: '. $opacity .'" src="'.$pluginsurl.'/framework/images/tansparency_meter.png" id="tansparency_meter_'.$name.'"/>';
			
			echo '</div>';
		}
		
		if (array_key_exists('behind_text', $show_array)) {
			
			if ($show_array["behind_text"] != '')
			{
				echo '<div class="col-md-1 col-xs-4" style="margin-top: 12px;">';
				
					echo $show_array["behind_text"];
				
				echo '</div>';
			}
			$show_array["behind_text"] = '';
		}
		echo'
			<script>var $slider_'.$name.' = jQuery"#'.$name.'_slider_div");
			tooltip = jQuery".'.$name.'_tooltip");
			//tooltip.hide();
			if ($slider_'.$name.'.length > 0) {
			  $slider_'.$name.'.slider({
			    min: '.$min * $factor.',
			    max: '.$max * $factor.',
			    value: '.$choosed_option_value * $factor.',
			    orientation: "horizontal",
			    range: "min",
			    start: function(event,ui) {
			          tooltip.fadeIn("fast");
			        },
			
			        stop: function(event,ui) {
			          tooltip.fadeOut("fast");
			        }
			  }).addSliderSegments($slider_'.$name.'.slider("option").max);
			}
			jQuery document ).ready(function() {
			    getslidervalue_'.$name.'();
			});

			function getslidervalue_'.$name.'()
			{
				document.getElementById("'.$name.'").value = parseInt($slider_'.$name.'.slider("option").value/'.$factor.');
				var element = document.getElementById("tansparency_meter_'.$name.'");
				var op = parseInt($slider_'.$name.'.slider("option").value/'.$factor.');
				if(element) element.style.opacity = 1 - (op/'.$max.');
			}
			</script>';
		
		echo '<style>.ui-slider-segment{ display:none !important;}</style>';
	}
	//---------------------------------------------------------------------
	// Function to add a set of photos and select one of them
	//---------------------------------------------------------------------
	public static function add_image_picker($name, $settings, $options_array, $folder_path, $default_value)
	{
		ctp_main_save_setting($name, $default_value);
		
		//$settings = 'multiple="multiple" data-limit="2"';
		
		$choosed_option_value = self::ctp_main_get_setting($name);
		
		$pluginsurl = plugins_url( '', __FILE__ );
		
		echo '<div style="margin: 1px 0 -9px;">';
			
		echo '<select '.$settings.' id="'.$name.'" name="'.$name.'" hidden class="image-picker show-html">';
		
		$arrlength = count($options_array[0]);
	    	
	    	for($x = 0; $x < $arrlength; $x++)
	    	{
				$value = $options_array[0][$x];
				
				$title = $options_array[1][$x];
				
	    		if ($value == $choosed_option_value)
					
					echo "<option selected data-img-src=\"$pluginsurl/$folder_path/$value.png\" value=\"$value\">$title</option>";
					
	    		else
					
	    			echo "<option data-img-src=\"$pluginsurl/$folder_path/$value.png\" value=\"$value\">$title</option>";
	    	}
		
		echo '</select>';
		
		echo '</div>';

		echo '
			<script type="text/javascript">
			jQuery("select.image-picker").imagepicker({
			  hide_select:  false,
			});

			jQuery("select.image-picker.show-labels").imagepicker({
			  hide_select:  false,
			  show_label:   true,
			});

			jQuery("select.image-picker.limit_callback").imagepicker({
			  limit_reached:  function(){alert("We are full!")},
			  hide_select:    false
			});

			var container = jQuery("select.image-picker.masonry").next("ul.thumbnails");
			
		  </script>';
	}
	//---------------------------------------------------------------------
	//add media_uploader control 
	//---------------------------------------------------------------------
	public static function add_media_uploader($name, $default_image)
	{		
		ctp_main_save_setting($name, $default_image);
		
		$choosed_option_value = self::ctp_main_get_setting($name);
		
		include 'media_uploader_script.php';
	}
	//---------------------------------------------------------------------
	//add checkbox control 
	//---------------------------------------------------------------------
	public static function add_checkbox($name , $behind_text , $default_value, $js_function)
	{
		ctp_main_save_setting($name, $default_value);
		
		$choosed_option_value = self::ctp_main_get_setting($name);
				
		if ($choosed_option_value != '') $choosed_option_value = 'checked=' . $choosed_option_value;
		
		echo '<div class="col">';
		
		echo '<div class="custom-control custom-checkbox my-1 mr-sm-2">';
		
		echo '<input type="checkbox" class="custom-control-input" '.$js_function.' id="'.$name.'" name="'.$name.'" value="checked" '.$choosed_option_value.'>';

		echo '<label class="custom-control-label framework_small_font" for="'.$name.'">'. $behind_text .'</label>';
		
		echo '</div></div>';

	}
	public static function add_empty_col()
	{
		echo '<div class="col"></div>';

	}

}//Class End
?>