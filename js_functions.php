<?php
$pluginsurl = plugins_url( '', __FILE__ );

$ctp_main_settings = ctp_main_read_options();

global $ctp_main_settings;

function ctp_main_disable_Right_Click()
{
global $ctp_main_settings;
?>

	<script id="ctp_main_disable_Right_Click" type="text/javascript">
	//<![CDATA[
	document.ondragstart = function() { return false;}
	    function nocontext(e) {
			
			e = e || window.event; // also there is no e.target property in IE. instead IE uses window.event.srcElement
			console.log('RC '+e);
			if (apply_class_exclusion(e) == 'Yes') return true;
	
	    	var exception_tags = 'NOTAG,';
	        var clickedTag = (e==null) ? event.srcElement.tagName : e.target.tagName;
	        //alert(clickedTag);
	        var checker = '<?php echo $ctp_main_settings['img'];?>';
	        if ((clickedTag == "IMG" || clickedTag == "PROTECTEDIMGDIV") && checker == 'checked') {
	            if (alertMsg_IMG != "")show_ctp_main_message(alertMsg_IMG);
	            return false;
	        }else {exception_tags = exception_tags + 'IMG,';}
			
			checker = '<?php echo $ctp_main_settings['videos'];?>';
			if ((clickedTag == "VIDEO" || clickedTag == "WCCPVIDEO" || clickedTag == "EMBED") && checker == 'checked') {
	            if (alertMsg_VIDEO != "")show_ctp_main_message(alertMsg_VIDEO);
	            return false;
	        }else {exception_tags = exception_tags + 'VIDEO,WCCPVIDEO,EMBED,';}
	        
	        checker = '<?php echo $ctp_main_settings['a'];?>';
	        if ((clickedTag == "A" || clickedTag == "TIME") && checker == 'checked') {
	            if (alertMsg_A != "")show_ctp_main_message(alertMsg_A);
	            return false;
	        }else {exception_tags = exception_tags + 'A,';}
	        
	        checker = '<?php echo $ctp_main_settings['pb'];?>';
	        if ((clickedTag == "P" || clickedTag == "B" || clickedTag == "FONT" ||  clickedTag == "LI" || clickedTag == "UL" || clickedTag == "STRONG" || clickedTag == "OL" || clickedTag == "BLOCKQUOTE" || clickedTag == "TD" || clickedTag == "SPAN" || clickedTag == "EM" || clickedTag == "SMALL" || clickedTag == "I" || clickedTag == "BUTTON") && checker == 'checked') {
	            if (alertMsg_PB != "")show_ctp_main_message(alertMsg_PB);
	            return false;
	        }else {exception_tags = exception_tags + 'P,B,FONT,LI,UL,STRONG,OL,BLOCKQUOTE,TD,SPAN,EM,SMALL,I,BUTTON,';}
	        
	        checker = '<?php echo $ctp_main_settings['input'];?>';
	        if ((clickedTag == "INPUT" || clickedTag == "PASSWORD") && checker == 'checked') {
	            if (alertMsg_INPUT != "")show_ctp_main_message(alertMsg_INPUT);
	            return false;
	        }else {exception_tags = exception_tags + 'INPUT,PASSWORD,';}
	        
	        checker = '<?php echo $ctp_main_settings['h'];?>';
	        if ((clickedTag == "H1" || clickedTag == "H2" || clickedTag == "H3" || clickedTag == "H4" || clickedTag == "H5" || clickedTag == "H6" || clickedTag == "ASIDE" || clickedTag == "NAV") && checker == 'checked') {
	            if (alertMsg_H != "")show_ctp_main_message(alertMsg_H);
	            return false;
	        }else {exception_tags = exception_tags + 'H1,H2,H3,H4,H5,H6,';}
	        
	        checker = '<?php echo $ctp_main_settings['textarea'];?>';
	        if (clickedTag == "TEXTAREA" && checker == 'checked') {
	            if (alertMsg_TEXTAREA != "")show_ctp_main_message(alertMsg_TEXTAREA);
	            return false;
	        }else {exception_tags = exception_tags + 'TEXTAREA,';}
	        
	        checker = '<?php echo $ctp_main_settings['emptyspaces'];?>';
	        if ((clickedTag == "DIV" || clickedTag == "BODY" || clickedTag == "HTML" || clickedTag == "ARTICLE" || clickedTag == "SECTION" || clickedTag == "NAV" || clickedTag == "HEADER" || clickedTag == "FOOTER") && checker == 'checked') {
	            if (alertMsg_EmptySpaces != "")show_ctp_main_message(alertMsg_EmptySpaces);
	            return false;
	        }
	        else
	        {
				//show_ctp_main_message(exception_tags.indexOf(clickedTag));
	        	if (exception_tags.indexOf(clickedTag)!=-1)
	        	{
		        	return true;
		        }
	        	else
	        	return false;
	        }
	    }
	    var alertMsg_IMG = "<?php echo addslashes($ctp_main_settings['alert_msg_img']);?>";
	    var alertMsg_A = "<?php echo addslashes($ctp_main_settings['alert_msg_a']);?>";
	    var alertMsg_PB = "<?php echo addslashes($ctp_main_settings['alert_msg_pb']);?>";
	    var alertMsg_INPUT = "<?php echo addslashes($ctp_main_settings['alert_msg_input']);?>";
	    var alertMsg_H = "<?php echo addslashes($ctp_main_settings['alert_msg_h']);?>";
	    var alertMsg_TEXTAREA = "<?php echo addslashes($ctp_main_settings['alert_msg_textarea']);?>";
	    var alertMsg_EmptySpaces = "<?php echo addslashes($ctp_main_settings['alert_msg_emptyspaces']);?>";
		var alertMsg_VIDEO = "<?php echo addslashes($ctp_main_settings['alert_msg_videos']);?>";
	    document.oncontextmenu = nocontext;
		//document.body.oncontextmenu=function(event) { nocontext(); };
	//]]>
	</script>
<?php
}?>
<?php
///////////////////////////////////////////////////////////
function ctp_main_disable_prntscr_key()
{
	global $ctp_main_settings;
	?>
	<script type="text/javascript">
	jQuery(document).bind("keyup keydown", function(e){
		e = e || window.event; // also there is no e.target property in IE. instead IE uses window.event.srcElement
		console.log (e.keyCode);
		dealWithPrintScrKey(e);
});
	
	//window.addEventListener("keyup", dealWithPrintScrKey, false);
	document.onkeyup = dealWithPrintScrKey;
	function dealWithPrintScrKey(e)
	{
		e = e || window.event; // also there is no e.target property in IE. instead IE uses window.event.srcElement
		
		// gets called when any of the keyboard events are overheard
		var prtsc = e.keyCode||e.charCode;
		
		//alert (prtsc);

		if (prtsc == 44)
		{
			e.cancelBubble = true;
			e.preventDefault();
			e.stopImmediatePropagation();
			show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
		}
	}
	</script>
	<?php if($ctp_main_settings['prnt_scr_msg'] != ''){ ?>
	<style>
	@media print {
	body * { display: none !important;}
		body:after {
		content: "<?php echo $ctp_main_settings['prnt_scr_msg']; ?>"; }
	}
	</style>
	<?php } ?>
<?php
}
///////////////////////////////////////////////////////////
function ctp_main_disable_selection_footer()
{
	global $ctp_main_settings;
	echo '<style type="text/css" data-asas-style="">body, div, p, span{ cursor: inherit ; user-select: none !important; }
	a{ cursor: pointer ; user-select: none !important; }
	h1, h2, h3, h4, h5, h6{ cursor: default ; user-select: none !important; }
	::selection{ background-color: transparent !important; color: #fff !important; }
	</style>';
	$selection_exclude_classes = get_selection_exclude_classes();
	
	$selection_exclude_classes2 = str_replace(",", ", .", $selection_exclude_classes);
	
	echo "<style> ." . $selection_exclude_classes2 . " " . "{cursor: text !important; user-select: text !important;}</style>";
	
	$contenteditable_inputs = "TEXT,TEXTAREA,input[type=text],input[type=password],input[type=number]";
	
	echo "<style>" . $contenteditable_inputs . " " . "{cursor: text !important; user-select: text !important;}</style>";
	
	$contenteditable_inputs_selection = str_replace(",", "::selection, ", $contenteditable_inputs);
	
	echo "<style>" . $contenteditable_inputs_selection . "::selection{background-color: #338FFF !important; color: #fff !important;}</style>";
	
	$selection_exclude_classes3 = str_replace(",", "::selection, .", $selection_exclude_classes);
	
	echo "<style> ." . $selection_exclude_classes3 . "::selection{background-color: #338FFF !important; color: #fff !important;}</style>";
	
	
	
	//Loop here to create a full string of selection_exclude_classes2 with all tags seperated by commas
	$tags_array = array("body" , "div" , "p" , "span" , "h1" , "h2" , "h3" , "h4" , "h5");
	
	//print_r($selection_exclude_classes2);
	
	foreach($tags_array as $tag_name){
		
		$selection_exclude_classes2 = str_replace(",", " > $tag_name ,.", $selection_exclude_classes);
	
		echo "<style> ." . $selection_exclude_classes2 . " > $tag_name" . "{cursor: text !important; user-select: text !important;}</style>";
		
		$selection_exclude_classes3 = str_replace(",", "::selection, .", $selection_exclude_classes);
		
		echo "<style> ." . $selection_exclude_classes3 . " $tag_name::selection{background-color: #338FFF !important; color: #fff !important;}</style>";
	}
}
///////////////////////////////////////////////////////////
function ctp_main_disable_hot_keys()
{
global $ctp_main_settings;
?>
<script id="ctp_main_disable_hot_keys" type="text/javascript">
//<![CDATA[
function disable_hot_keys(e)
{
	var key_number;
	
		if(window.event)
			  key_number = window.event.keyCode;     //IE
		else
			key_number = e.which;     //firefox (97)

	/////////////////////////////////////////////Case F12
	<?php if($ctp_main_settings['f12_protection'] == 'checked')
	{ ?>
		if (key_number == 123)//F12 chrome developer key disable
		{
			show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
			return false;
		}
	<?php } ?>
	var elemtype = e.target.tagName;
	
	elemtype = elemtype.toUpperCase();
	
	if (elemtype == "TEXT" || elemtype == "TEXTAREA" || elemtype == "INPUT" || elemtype == "PASSWORD" || elemtype == "SELECT")
	{
		elemtype = 'TEXT';
	}
	
	if (e.ctrlKey || e.metaKey)
	{
		var key = key_number;
		
		console.log(key);

		if (elemtype!= 'TEXT' && (key == 97 || key == 99 || key == 120 || key == 26 || key == 43))
		{
			 show_ctp_main_message('<?php echo addslashes($ctp_main_settings['ctrl_message']);?>');
			 return false;
		}
		if (elemtype!= 'TEXT')
		{
			/////////////////////////////////////////////Case Ctrl + P 80 (prntscr = 44)
			<?php if($ctp_main_settings['ctrl_p_protection'] == 'checked')
			{ ?>
			if (key == 80 || key_number == 44)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>
			
			/////////////////////////////////////////////Case Ctrl + S 83
			<?php if($ctp_main_settings['ctrl_s_protection'] == 'checked')
			{ ?>
			
			if (key == 83)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>

			/////////////////////////////////////////////Case Ctrl + i 73
			<?php if($ctp_main_settings['ctrl_i_protection'] == 'checked')
			{ ?>

			if (key==73)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>
			
			/////////////////////////////////////////////Case Ctrl + A 65
			<?php if($ctp_main_settings['ctrl_a_protection'] == 'checked')
			{ ?>
			
			if (key == 65)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>
			
			/////////////////////////////////////////////Case Ctrl + C 67
			<?php if($ctp_main_settings['ctrl_c_protection'] == 'checked')
			{ ?>
			
			if (key == 67)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>
			
			/////////////////////////////////////////////Case Ctrl + X 88
			<?php if($ctp_main_settings['ctrl_x_protection'] == 'checked')
			{ ?>
			
			if (key == 88)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>
			
			/////////////////////////////////////////////Case Ctrl + V 86
			<?php if($ctp_main_settings['ctrl_v_protection'] == 'checked')
			{ ?>
			
			if (key == 86)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>
			
			/////////////////////////////////////////////Case Ctrl + U 85
			<?php if($ctp_main_settings['ctrl_u_protection'] == 'checked')
			{ ?>
			
			if (key == 85)
			{
				show_ctp_main_message('<?php echo addslashes($ctp_main_settings['custom_keys_message']);?>');
				return false;
			}<?php } ?>
		}
	else
		return true;
    }
}
//document.oncopy = function(){return false;};
jQuery(document).bind("keyup keydown", disable_hot_keys);
</script>
<?php
}
///////////////////////////////////////////////////////////
function ctp_main_disable_selection()
{
global $ctp_main_settings;
?>
<script id="ctp_main_disable_selection" type="text/javascript">
//<![CDATA[

var image_save_msg='You cant save images!';
var no_menu_msg='Context menu disabled!';
var smessage = "<?php echo $ctp_main_settings['smessage'];?>";
	
document.addEventListener('allow_copy', e => {
    if (e.detail) {
        // Stop extension functionality
		const event = new CustomEvent('allow_copy', { detail: { unlock: false } })
		window.top.document.dispatchEvent(event)
    }
});

"use strict";
// This because search property "includes" does not supported by IE
if (!String.prototype.includes) {
String.prototype.includes = function(search, start) {
  if (typeof start !== 'number') {
	start = 0;
  }

  if (start + search.length > this.length) {
	return false;
  } else {
	return this.indexOf(search, start) !== -1;
  }
};
}
//////////////
function disable_copy(e)
{
	var e = e || window.event; // also there is no e.target property in IE. instead IE uses window.event.srcElement
  	
	var target = e.target || e.srcElement;
	
	if (apply_class_exclusion(e) == "Yes") return true;
	
	//For contenteditable tags
	var iscontenteditable = target.getAttribute("contenteditable"); // Return true or false as string
	
	var iscontenteditable2 = target.isContentEditable; // Return true or false as boolean

	if (iscontenteditable == "true" || iscontenteditable2 == true)
	{
		target.style.cursor = "text";
		return true;
	}
	
	//disable context menu when shift + right click is pressed
	var shiftPressed = 0;
	
	var evt = e?e:window.event;
	
	if (parseInt(navigator.appVersion)>3) {
		
		if (document.layers && navigator.appName=="Netscape")
			
			shiftPressed = (e.modifiers-0>3);
			
		else
			
			shiftPressed = e.shiftKey;
			
		if (shiftPressed) {
			
			if (smessage !== "") show_ctp_main_message(smessage);
			
			var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
			
			if (isFirefox) {
			evt.cancelBubble = true;
			if (evt.stopPropagation) evt.stopPropagation();
			if (evt.preventDefault()) evt.preventDefault();
			console.log(evt);
			show_ctp_main_message (smessage);
			return false;
			}
			
			return false;
		}
	}
	
	if(e.which === 2 ){
	var clickedTag_a = (e==null) ? event.srcElement.tagName : e.target.tagName;
	   show_ctp_main_message(smessage);
       return false;
    }
	var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
	var elemtype = e.target.nodeName;
	elemtype = elemtype.toUpperCase();
	var checker_IMG = '<?php echo $ctp_main_settings['img'];?>';
	if (elemtype == "IMG" && checker_IMG == 'checked' && e.detail == 2) {show_ctp_main_message(alertMsg_IMG);return false;}

    if (elemtype != "TEXT" && elemtype != "TEXTAREA" && elemtype != "INPUT" && elemtype != "PASSWORD" && elemtype != "SELECT" && elemtype != "OPTION" && elemtype != "EMBED")
	{
		if (smessage !== "" && e.detail == 2)
			show_ctp_main_message(smessage);
		
		if (isSafari)
			return true;
		else
			return false;
	}	
}
function disable_copy_ie()
{
	var e = e || window.event;
  // also there is no e.target property in IE.
  // instead IE uses window.event.srcElement
  	var target = e.target || e.srcElement;
	
	var iscontenteditable = target.getAttribute("contenteditable"); // Return true or false as string
	
	var iscontenteditable2 = target.isContentEditable; // Return true or false as boolean

	if (iscontenteditable == "true" || iscontenteditable2 == true)
	{
		target.style.cursor = "text";
		return true;
	}
	console.log("888888");
	if (apply_class_exclusion(e) == "Yes") return true;
	console.log("99999");
	
	var elemtype = window.event.srcElement.nodeName;
	elemtype = elemtype.toUpperCase();
	if (elemtype == "IMG") {show_ctp_main_message(alertMsg_IMG);return false;}
	if (elemtype != "TEXT" && elemtype != "TEXTAREA" && elemtype != "INPUT" && elemtype != "PASSWORD" && elemtype != "SELECT" && elemtype != "EMBED" && elemtype != "OPTION")	
	{
		return false;
	}
}	
function reEnable()
{
	return true;
}

//document.oncopy = function(){return false;};
//document.onkeydown = disable_hot_keys;

if(navigator.userAgent.indexOf('MSIE')==-1) //If not IE
{
	document.onmousedown = disable_copy;
	document.onclick = reEnable;
}else
{
	document.onselectstart = disable_copy_ie;
}
//]]>
</script>
<?php
}
///////////////////////////////////////////////////////////
function ctp_main_images_overlay()
{
	global $pluginsurl,$ctp_main_settings;
	?>
	<!--Smart protection techniques -->
	<script type="text/javascript">
		jQuery("img").wrap('<div style="position: relative;"></div>');
		//jQuery("img").wrap('<ProtectedImgDiv class="protectionOverlaytext"></ProtectedImgDiv>');
		jQuery("img").after('<ProtectedImgDiv class="protectionOverlaytext"><img src= "<?php echo $pluginsurl."/images/transparent.gif";?>" style="width:100%; height:100%" /><p><?php //echo $ctp_main_settings['dw_text'];?></p></ProtectedImgDiv>');
	</script>
	<style>
	.protectionOverlaytext{
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		display: block;
		z-index: 999;

		font-weight: bold;
		opacity: 0.<?php echo $ctp_main_settings['dw_text_transparency'];?>;
		text-align: center;
		transform: rotate(0deg);
	}
	</style>
	<!--Smart protection techniques -->
	<?php
}
?>
<?php
function ctp_main_video_overlay()
{
	?>
	<!--just for video protection -->
	<script type="text/javascript">	
	jQuery(function() {
		
		jQuery('IFRAME').load(function(e) {
			iframe_load(this);
		});
		
		jQuery('IFRAME').live('mouseenter touchstart',function(e) {
			//iframe_load(this);
		});
	});
	
	function play_stop_video(ev)
	{
		jQuery('ctpvideo').hide();
		setTimeout(function(){ jQuery('ctpvideo').show(); }, 1000);
	}
	
	function iframe_load(e)
	{
		//Only execute if this is not an overlay or skipped
			var img = jQuery(e);
			
			//Get the real image's position, add an overlay
			
			var pos = img.offset();
			
			var overlay_top = jQuery('<ctpvideo onclick="play_stop_video(this)"></ctpvideo>').css({width: img.width(),height:((img.height()/2)-30), border: '1px sloid #fff', position: 'absolute', zIndex: 9999999, left: pos.left, top: pos.top}).appendTo('body');
			
			var overlay_btm = jQuery('<ctpvideo onclick="play_stop_video(this)"></ctpvideo>').css({width: img.width(),height:((img.height()/2.2)), border: '1px sloid #fff',position: 'absolute', zIndex: 9999999, left: pos.left, top: pos.top+(img.height()/2)+25}).appendTo('body');
			
			var overlay_left = jQuery('<ctpvideo onclick="play_stop_video(this)"></ctpvideo>').css({width: ((img.width()/2)-30),height:((img.height()/2)-25), border: '1px sloid #fff',position: 'absolute', zIndex: 9999999, left: pos.left, top: pos.top+(img.height()/4)+25}).appendTo('body');
			
			var overlay_right = jQuery('<ctpvideo onclick="play_stop_video(this)"></ctpvideo>').css({width: ((img.width()/2)-30),height:((img.height()/2)-25), border: '1px sloid #000',position: 'absolute', zIndex: 9999999, left: pos.left+(img.width()/2)+30, top: pos.top+(img.height()/3)+25}).appendTo('body');
			
			//if ('ontouchstart' in window) jQuery(document).one('touchend', function(){ setTimeout(function(){ overlay4.remove(); }, 0, overlay4); });
	}
	</script>
	<style>
	ctpvideo {
		background: transparent none repeat scroll 0 0;
		//border: 2px solid #fff;
		//opacity: 0.0;
	}
	.protectionOverlay{
		background: #fff none repeat scroll 0 0;
		border: 2px solid #fff;
		opacity: 0.0;
	}
	</style>
	<!--just for iphones end -->
	<?php
}
?>
<?php
function change_image_src_onclick()
{
?>
<script type="text/javascript">
/* var $ = jQuery;
jQuery(function() {
    jQuery("body").find('img').bind("contextmenu", function() {
        var src = $(this).attr("src");
        // Check the beginning of the src attribute  
        var state = src.indexOf("?");
        // Apply the new src attribute value  
        $(this).attr("src", src+"?"+Date.now());

        // This is just for demo visibility
        $('body').append('<p>' + $(this).attr('src') + '</p>');
    });
    jQuery("body").find('a').bind("click", function() {
        var href = $(this).attr("href");
        // Check the beginning of the src attribute  
        //var state = (src.indexOf("?") === 0) ? 'bw' : 'clr';
        // Apply the new src attribute value  
        $(this).attr("href", href+"?wpcphotclicked"+Date.now());

        // This is just for demo visibility
        $('body').append('<p>' + $(this).attr('href') + '</p>');
        //return false;
    });

}); */
</script>
<?php
}
?>
