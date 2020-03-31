<?php
//---------------------------------------------------------------------------------------------
//Here is how disable selection script will shown
//---------------------------------------------------------------------------------------------
function ctp_main_main_settings()
{
	global $ctp_main_settings;

	if (((is_home() || is_front_page() || is_archive() || is_post_type_archive() ||  is_404() || is_attachment() || is_author() || is_category() || is_feed() || is_search()))) //dont forget to search for woocommerce pages
	{
		if($ctp_main_settings['home_page_protection'] == 'checked') ctp_main_disable_selection();
		
		if($ctp_main_settings['prntscr_protection'] == 'checked') ctp_main_disable_prntscr_key();//توحيد في واحدة فقط
						
		return;
	}
	if (is_single())
	{
		if($ctp_main_settings['single_posts_protection'] == 'checked') ctp_main_disable_selection();
		
		if($ctp_main_settings['prntscr_protection'] == 'checked') ctp_main_disable_prntscr_key();//توحيد في واحدة فقط
						
		return;
	}
	if (is_page() && !is_front_page())
	{
		if($ctp_main_settings['page_protection'] == 'checked') ctp_main_disable_selection();
		
		if($ctp_main_settings['prntscr_protection'] == 'checked') ctp_main_disable_prntscr_key(); //توحيد في واحدة فقط
						
		return;
	}
}

function ctp_main_disable_selection_settings_footer()
{
	
	global $ctp_main_settings;
	if (((is_home() || is_front_page() || is_archive() || is_post_type_archive() ||  is_404() || is_attachment() || is_author() || is_category() || is_feed() || is_search())))
	{
		if($ctp_main_settings['home_page_protection'] == 'checked') ctp_main_disable_selection_footer();
										
		return;
	}
	if (is_single())
	{
		if($ctp_main_settings['single_posts_protection'] == 'checked') ctp_main_disable_selection_footer();
										
		return;
	}
	if (is_page() && !is_front_page())
	{
		if($ctp_main_settings['page_protection'] == 'checked') ctp_main_disable_selection_footer();
						
		return;
	}
}
//---------------------------------------------------------------------------------------------
//Here is how disable right click script will shown
//---------------------------------------------------------------------------------------------
function ctp_main_right_click_premium_settings()
{
	global $ctp_main_settings;
	if (((is_home() || is_front_page() || is_archive() || is_post_type_archive() ||  is_404() || is_attachment() || is_author() || is_category() || is_feed()) && $ctp_main_settings['right_click_protection_homepage'] == 'checked'))
	{
		ctp_main_disable_Right_Click(); //Located in js_functions.php
		return;
	}
	if (is_single() && $ctp_main_settings['right_click_protection_posts'] == 'checked')
	{
		ctp_main_disable_Right_Click(); //Located in js_functions.php
		return;
	}
	if (is_page() && !is_front_page() && $ctp_main_settings['right_click_protection_pages'] == 'checked')
	{
		ctp_main_disable_Right_Click(); //Located in js_functions.php
		return;
	}
}

//---------------------------------------------------------------------------------------------
//Here is how disable selection by CSS style sheet
//---------------------------------------------------------------------------------------------
function ctp_main_css_settings()
{
	global $ctp_main_settings;
	ctp_main_css_inject(); //Located in css_functions.php
	if (((is_home() || is_front_page() || is_archive() || is_post_type_archive() ||  is_404() || is_attachment() || is_author() || is_category() || is_feed() || is_search()) && $ctp_main_settings['home_css_protection'] == 'Yes'))
	{
		ctp_main_css_script(); //Located in css_functions.php
		return;
	}
	if (is_single() && $ctp_main_settings['posts_css_protection'] == 'Yes')
	{
		ctp_main_css_script(); //Located in css_functions.php
		return;
	}
	if (is_page() && !is_front_page() && $ctp_main_settings['pages_css_protection'] == 'Yes')
	{
		ctp_main_css_script(); //Located in css_functions.php
		return;
	}
}

//---------------------------------------------------------------------------------------------
//Here we add specific CSS class by filter
//---------------------------------------------------------------------------------------------
// Add specific CSS class by filter
function ctp_main_class_names($classes) {
global  $ctp_main_settings;
	if ($ctp_main_settings['home_css_protection'] == 'Yes' || $ctp_main_settings['posts_css_protection'] == 'Yes' ||  $ctp_main_settings['pages_css_protection'] == 'Yes')
	{
		$classes[] = 'unselectable';
		return $classes;
	}
	else
	{
		$classes[] = 'ctp-no-classes';
		return $classes;
	}
}

//---------------------------------------------------------------------------------------------
//Here is how protection overlay is work for images
//---------------------------------------------------------------------------------------------
function ctp_main_images_overlay_settings()
{
	global $ctp_main_settings;
	if (((is_home() || is_front_page() || is_archive() || is_post_type_archive() ||  is_404() || is_attachment() || is_author() || is_category() || is_feed() || is_search()) && $ctp_main_settings['protection_overlay_homepage'] == 'checked'))
	{
		ctp_main_images_overlay(); //Located in js_functions.php
		return;
	}
	if (is_single() && $ctp_main_settings['protection_overlay_posts'] == 'checked')
	{
		ctp_main_images_overlay(); //Located in js_functions.php
		return;
	}
	if (is_page() && !is_front_page() && $ctp_main_settings['protection_overlay_pages'] == 'checked')
	{
		ctp_main_images_overlay(); //Located in js_functions.php
		return;
	}
}

//---------------------------------------------------------------------------------------------
//Here is how protection overlay is work for videos
//---------------------------------------------------------------------------------------------
function ctp_main_videos_overlay_settings()
{
	global $ctp_main_settings;
	if (((is_home() || is_front_page() || is_archive() || is_post_type_archive() ||  is_404() || is_attachment() || is_author() || is_category() || is_feed()) && $ctp_main_settings['right_click_protection_homepage'] == 'checked' && $ctp_main_settings['videos'] == 'checked'))
		{
			ctp_main_video_overlay(); //Located in js_functions.php
			return;
		}
	if (is_single() && $ctp_main_settings['right_click_protection_posts'] == 'checked' && $ctp_main_settings['videos'] == 'checked')
		{
			ctp_main_video_overlay(); //Located in js_functions.php
			return;
		}
	if (is_page() && !is_front_page() && $ctp_main_settings['right_click_protection_pages'] == 'checked' && $ctp_main_settings['videos'] == 'checked')
		{
			ctp_main_video_overlay(); //Located in js_functions.php
			return;
		}
}
?>