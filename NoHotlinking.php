<p align="center"><img border="0" src="http://www.hostgator-best-coupon.com/<?php echo $_GET["src"]; ?>"></p>
<p align="center"><img border="0" src="http://www.hostgator-best-coupon.com/wp-content/plugins/ctp-pro/watermark.php?p=c&q=90&src=<?php echo $_GET["src"]; ?>"></p>
<?php wp_enqueue_script('jquery'); ?>
<script type="text/javascript">
var $ = jQuery;
$(function() {
    //var pixelSource = 'http://upload.wikimedia.org/wikipedia/commons/c/ce/Transparent.gif';
	var pixelSource = 'NoHotlinking.png';
    var useOnAllImages = true;
    // Preload the pixel
    var preload = new Image();
    preload.src = pixelSource;
    $('img').live('mouseenter mouseout touchstart', function(e) {
        // Only execute if this is not an overlay or skipped
        var img = $(this);
        if (img.hasClass('protectionOverlay')) return;
        if (!useOnAllImages && !img.hasClass('protectMe')) return;
        // Get the real image's position, add an overlay
        var pos = img.offset();
        var overlay = $('<img class="protectionOverlay" src="' + pixelSource + '" width="' + img.width() + '" height="' + img.height() + '" />').css({position: 'absolute', zIndex: 9999999, left: 

pos.left, top: pos.top}).appendTo('body').bind('mouseleave', function() {
            setTimeout(function(){ overlay.remove(); }, 0, $(this));
        });
        if ('ontouchstart' in window) $(document).one('touchend', function(){ setTimeout(function(){ overlay.remove(); }, 0, overlay); });
    });
});
</script>