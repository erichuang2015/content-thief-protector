<?php
function ctp_main_css_script()
{
?>
	<style>
.cover-container {
   border: 1px solid #DDDDDD;
   width: 100%;
   height: 100%;
   position: relative;
}
.glass-cover {
   float: left;
   position: relative;
   left: 0px;
   top: 0px;
   z-index: 1000;
   background-color: #92AD40;
   padding: 5px;
   color: #FFFFFF;
   font-weight: bold;
}
	.unselectable
	{
	-moz-user-select:none;
	-webkit-user-select:none;
	cursor: default;
	}
	html
	{
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-tap-highlight-color: rgba(0,0,0,0);
	}
	img
	{
	-webkit-touch-callout:none;
	-webkit-user-select:none;
	}
	</style>
	<script id="ctp_main_css_disable_selection" type="text/javascript">
	function ctp_main_msieversion()
		{
			var ua = window.navigator.userAgent;
			var msie = ua.indexOf("MSIE");
			var msie2 = ua.indexOf("Edge");
			var msie3 = ua.indexOf("Trident");

		if (msie > -1 || msie2 > -1 || msie3 > -1) // If Internet Explorer, return version number
		{
			return "IE";
		}
		else  // If another browser, return 0
		{
			return "otherbrowser";
		}
	}
    
	var e = document.getElementsByTagName('H1')[0];
	if(e && ctp_main_msieversion() == "IE")
	{
		e.setAttribute('unselectable',"on");
	}
	</script>
<?php
}
?>
<?php
function ctp_main_css_inject()
{
	global $ctp_main_settings;
	echo str_replace('\"', '"', $ctp_main_settings['custom_css_code']);
}
?>