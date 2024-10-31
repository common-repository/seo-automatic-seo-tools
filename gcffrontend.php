<?php
function gcf_shortcode( $atts ) {
	ob_start();
?>

<script>
function gcfprocess()
{
var url="http://webcache.googleusercontent.com/search?q=cache:" + document.getElementById("gcf").value;
window.open(url, '_blank');
return false;
}
</script>
<form id="gcfform" method="get" onSubmit="return gcfprocess();">
<p><input class="gcf" id="gcf" name="gcf" size="30" type="text" value="" placeholder="Paste full URL here" />	
<input type="submit" value="Check for cached page" /></p>	
</form>
		
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode( 'googlecachefinder', 'gcf_shortcode' );
?>