<?php
function autoseo_options_page() {
include('thisplugin.php');

if (function_exists('plugins_url')) {
	$path=trailingslashit(plugins_url(basename(dirname(__FILE__))));
	} else {
	$path = dirname(__FILE__);
	$path = str_replace("\\","/",$path);
	$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
}
	$blogpath = get_bloginfo('url');
	if (substr($blogpath, -1) != '/') {
		$blogpath.="/";
	}	
if (get_bloginfo('version') < 2.8) {
	echo '<style>.postbox-container { float: left; } #side-sortables { padding-left: 20px; }';
} else {
	echo '<style>';
}
?>
.postbox .inside { padding: 8px !important; }
#about-plugins a, #resources a {text-decoration: none;}
#about-plugins img, #resources img {float: left; padding-right: 3px;}
#success li, #success h3 {color: #006600; }
#fail li, #fail h3 {color: #ff0000; }
#resources li { clear: both; }
#about-plugins li { clear: both; }
</style>

<div class="wrap seoautoreview">
<br />
<div id="dashboard-widgets-wrap">
<div id='dashboard-widgets' class='metabox-holder'>

<div class='postbox-container' style='width:60%;'>
<div id='normal-sortables' class='meta-box-sortables'>

<div id="main-admin-box" class="postbox">
<h3><span><img src="<?php echo plugins_url();?>/seo-automatic-seo-tools/images/favicon.png" alt="Search Commander, Inc." /> Admin - SEO Tools by Search Commander, Inc.</span></h3>
<div class="inside">
<?php
	if (isset($_POST['seoupload'])){
		if(seoauto_import($_FILES['seofile']['tmp_name']))
			$message = "Options Successfully Imported!";
		else
			$message = "<span style='border:1px solid red;font-weight:bold'>There was an error importing the file.  Your settings have not been changed.</span>";
	}
	if (isset($_POST['info_update'])) {
		update_option('autoseo_options', stripslashes_deep($_POST));
		$message = "Options Updated!";
	}
	if (isset($message)){
	?><div id="message" class="updated fade"><p><strong><?php echo $message; ?></strong></p></div><?php
	}
	$settings = get_option('autoseo_options');	
	// below is what displays on the options page  
	?>	
		<?php if (!is_writable(ABSPATH . PLUGINDIR . '/seo-automatic-seo-tools/writable')){?>
		<div style="width:100%;text-align:center;border:1px solid red;">In order for this tool to work this folder must be writable by the server:<br /><strong><?php echo ABSPATH . PLUGINDIR . '/seo-automatic-seo-tools/writable';?></strong></div>
		<?php } ?> 
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
			<input type="hidden" name="info_update" id="info_update" value="true" />
			<input type="hidden" name="app[theme]" value="seoinspector" />
	<h3>Instructions:</h3>
<p>You need to edit and personalize your "advice" below, and you can also uncheck each ranking factor if you'd like the report to be shorter.</p>
<p>Individual factor definitions go in the far left box, "positive feedback" result in the center, and negative items are on the the right.&nbsp;</p>
<p>Note that the boxes DO accept .html code.</p>
<p>You may define an area as a "higher priority" item by checking the box to the right of the negative comment section, which will shade those boxes red for your quick identification.</p>
<p>Also, for a few of the factors, such as page size or outbound links, use the small box to the right of each one for editing those variables to a size or quantity that YOU deem to be too large.</p>
<p>To display the tool for the end user, simply place [seotool] within the body of any page or post from the admin / edit screen, USING THE .HTML TAB.</p>
<p>The tool appears on any page where you've placed the [seotool] shortcode, and that's where the results will display.</p>
<p>Please note that sometimes, some URLs (should be under 2%) will simply fail without explanation. We're sorry, but that's the way it is.&nbsp;</p>
<p>Sometimes this is the result of some sort of redirect on the url, which is resolved after a copy / paste out of the address bar.&nbsp;</p>
<p>Other times, different web hosts have their security cranked up, and will block our scanning too for YOUR protection.&nbsp;</p>
<p>Finally, Some failures simply cannot be explained in certain situations - sort of like MS Windows. When that happens, you can usually (and inexplicably) run the report from a second installation on another domain / host of your own.  Go figure.</p>
<p>If you do need help, please feel free to contact Scott Hendison via Twitter @shendison, create a support post at Search Commander Inc., or phone 877-241-4453.</p>
	
<br />

<table>
		<tr>
			<td><h3>Report Headers</h3></td>
		</tr>
		<tr>
			<td title="Explain the importance of the item."><input type="text" value="<?php echo $settings['heading']['overview'];?>" name="heading[overview]" class="overview" /></td>
		</tr>
		<tr>
			<td title="Result is correct."><input type="text" value="<?php echo $settings['heading']['correct'];?>" name="heading[correct]" class="correct" /></td>
		</tr>
		<tr>
			<td title="Result is incorrect and worth reviewing."><input type="text" value="<?php echo $settings['heading']['problem'];?>" name="heading[problem]" class="problem" /></td>
		</tr>
		<tr>
			<td title="Result is incorrect and demands immediate attention."><input type="text" value="<?php echo $settings['heading']['critical'];?>" name="heading[critical]" class="important" /></td>
		</tr>
		<tr>
			<td><br /><h3>Misc.</h3></td>
		</tr>
		<tr>
		<td colspan="4"><p><b>Check this box to also show grouped results.</b> <input type="checkbox" name="ungrouped[resultset]" id="ungrouped[resultset]" value="ON" <?php if(isset($settings['ungrouped']['resultset'])){echo 'checked';}?> /></b></p></td></tr>
		<tr>
		<td><p><b>You can force a message to display above the tool box anywhere that the [seotool] short code is displayed by typing it into the box below.</b></p></td></tr>
		<tr>
			<td><h4 style="padding-top:0;margin-top:0">Message Above Form</h4></td>
		</tr>
		<tr>
			<td title="The message that is displayed above the URL form.">
			<textarea rows="3" cols="40" name="misc[top-message]"><?php echo $settings['misc']['top-message'];?></textarea></td>
		</tr>
		<tr>
			<td><h4>Submit Button text</h4></td>
		</tr>
		<tr>
			<td><input type="text" value="<?php echo $settings['misc']['button'];?>" name="misc[button]" class="button-text" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><p><input type="checkbox" name="misc[fixed-table]" <?php if($settings['misc']['fixed-table']){echo 'checked';}?> /> Fixed Tables (Play with this checkbox if you have weird theme issues with the results tables)</p></td>
		</tr>
</table><br /><table style="margin-top: 150px;">
		<tr>
			<td><h2>Results Text</h2></td>
		</tr>
		<tr>
			<td><h4 style="margin-top:0;padding-top:0">Title Tag</h4></td>
		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[title][enable]" id="title-enable" class="tog-enable" <?php if($settings['locale']['title']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-title-enable" <?php if(!$settings['locale']['title']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[title][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['title']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[title][correct]" rows="5" class="correct" cols="40"><?php echo $settings['locale']['title']['correct']; ?></textarea></td>
			<td><textarea name="locale[title][problem]" id="p-title" class="problem<?php if($settings['locale']['title']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['title']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[title][important]" id="title" class="tog-imp" <?php if(isset($settings['locale']['title']['important'])){echo 'checked';}?> /></td>
		</tr>
		<tr>
			<td><h4>Description Tag</h4></td>
		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[description][enable]" id="description-enable" class="tog-enable" <?php if($settings['locale']['description']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-description-enable" <?php if(!$settings['locale']['description']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[description][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['description']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[description][correct]" rows="5" class="correct" cols="40"><?php echo $settings['locale']['description']['correct']; ?></textarea></td>
			<td><textarea name="locale[description][problem]" id="p-description" class="problem<?php if($settings['locale']['description']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['description']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[description][important]" id="description" class="tog-imp" <?php if(isset($settings['locale']['description']['important'])){echo 'checked';}?> /></td>
		</tr>
		<tr>
			<td><h4>H1 Tag</h4></td>
		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[h1_status][enable]" id="h1_status-enable" class="tog-enable" <?php if($settings['locale']['h1_status']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-h1_status-enable" <?php if(!$settings['locale']['h1_status']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[h1_status][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['h1_status']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[h1_status][correct]" rows="5" class="correct" cols="40"><?php echo $settings['locale']['h1_status']['correct']; ?></textarea></td>
			<td><textarea name="locale[h1_status][problem]" id="p-h1_status" class="problem<?php if($settings['locale']['h1_status']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['h1_status']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[h1_status][important]" id="h1_status" class="tog-imp" <?php if(isset($settings['locale']['h1_status']['important'])){echo 'checked';}?> /></td>
		</tr>

		<tr>			<td><h4>H2 Tag (or bolded)</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[h2_status][enable]" id="h2_status-enable" class="tog-enable" <?php if($settings['locale']['h2_status']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-h2_status-enable" <?php if(!$settings['locale']['h2_status']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[h2_status][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['h2_status']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[h2_status][correct]" rows="5" class="correct" cols="40"><?php echo $settings['locale']['h2_status']['correct']; ?></textarea></td>
			<td><textarea name="locale[h2_status][problem]" id="p-h2_status" class="problem<?php if($settings['locale']['h2_status']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['h2_status']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[h2_status][important]" id="h2_status" class="tog-imp" <?php if(isset($settings['locale']['h2_status']['important'])){echo 'checked';}?> /></td>
		</tr>
	
		<tr>			<td><h4>Keyword Meta Tag</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[keywords][enable]" id="keywords-enable" class="tog-enable" <?php if($settings['locale']['keywords']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-keywords-enable" <?php if(!$settings['locale']['keywords']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[keywords][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['keywords']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[keywords][correct]" rows="5" class="correct" cols="40"><?php echo $settings['locale']['keywords']['correct']; ?></textarea></td>
			<td><textarea name="locale[keywords][problem]" id="p-keywords" class="problem<?php if($settings['locale']['keywords']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['keywords']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[keywords][important]" id="keywords" class="tog-imp" <?php if(isset($settings['locale']['keywords']['important'])){echo 'checked';}?> /></td>
		</tr>
		
		<tr>			<td><h4>Image Height/Width</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[image_dimensions][enable]" id="image_dimensions-enable" class="tog-enable" <?php if($settings['locale']['image_dimensions']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-image_dimensions-enable" <?php if(!$settings['locale']['image_dimensions']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[image_dimensions][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['image_dimensions']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[image_dimensions][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['image_dimensions']['correct']; ?></textarea></td>
			<td><textarea name="locale[image_dimensions][problem]" id="p-image_dimensions" class="problem<?php if($settings['locale']['image_dimensions']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['image_dimensions']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[image_dimensions][important]" id="image_dimensions" class="tog-imp" <?php if(isset($settings['locale']['image_dimensions']['important'])){echo 'checked';}?> /></td>
		</tr>
		
		<tr>			<td><h4>Image Expires Headers</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[expires_headers][enable]" id="expires_headers-enable" class="tog-enable" <?php if($settings['locale']['expires_headers']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-expires_headers-enable" <?php if(!$settings['locale']['expires_headers']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[expires_headers][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['expires_headers']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[expires_headers][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['expires_headers']['correct']; ?></textarea></td>
			<td><textarea name="locale[expires_headers][problem]" id="p-expires_headers" class="problem<?php if($settings['locale']['expires_headers']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['expires_headers']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[expires_headers][important]" id="expires_headers" class="tog-imp" <?php if(isset($settings['locale']['expires_headers']['important'])){echo 'checked';}?> /></td>
		</tr>
		
		<tr>			<td><h4>Robots Meta Tag</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[robots][enable]" id="robots-enable" class="tog-enable" <?php if($settings['locale']['robots']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-robots-enable" <?php if(!$settings['locale']['robots']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[robots][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['robots']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[robots][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['robots']['correct']; ?></textarea></td>
			<td><textarea name="locale[robots][problem]" id="p-robots" class="problem<?php if($settings['locale']['robots']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['robots']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[robots][important]" id="robots" class="tog-imp" <?php if(isset($settings['locale']['robots']['important'])){echo 'checked';}?> /></td>
		</tr>
						
		<tr>			<td><h4>robots.txt file</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[robots_txt][enable]" id="robots_txt-enable" class="tog-enable" <?php if($settings['locale']['robots_txt']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-robots_txt-enable" <?php if(!$settings['locale']['robots_txt']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[robots_txt][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['robots_txt']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[robots_txt][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['robots_txt']['correct']; ?></textarea></td>
			<td><textarea name="locale[robots_txt][problem]" id="p-robots_txt" class="problem<?php if($settings['locale']['robots_txt']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['robots_txt']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[robots_txt][important]" id="robots_txt" class="tog-imp" <?php if(isset($settings['locale']['robots_txt']['important'])){echo 'checked';}?> /></td>
		</tr>
		
		<tr>			<td><h4>XML Sitemap File</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[sitemap_xml][enable]" id="sitemap_xml-enable" class="tog-enable" <?php if($settings['locale']['sitemap_xml']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-sitemap_xml-enable" <?php if(!$settings['locale']['sitemap_xml']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[sitemap_xml][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['sitemap_xml']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[sitemap_xml][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['sitemap_xml']['correct']; ?></textarea></td>
			<td><textarea name="locale[sitemap_xml][problem]" id="p-sitemap_xml" class="problem<?php if($settings['locale']['sitemap_xml']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['sitemap_xml']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[sitemap_xml][important]" id="sitemap_xml" class="tog-imp" <?php if(isset($settings['locale']['sitemap_xml']['important'])){echo 'checked';}?> /></td>
		</tr>
		<tr>			<td><h4>Local - Google Earth KML file</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[google_earth][enable]" id="google_earth-enable" class="tog-enable" <?php if($settings['locale']['google_earth']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-google_earth-enable" <?php if(!$settings['locale']['google_earth']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[google_earth][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['google_earth']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[google_earth][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['google_earth']['correct']; ?></textarea></td>
			<td><textarea name="locale[google_earth][problem]" id="p-google_earth" class="problem<?php if($settings['locale']['google_earth']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['google_earth']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[google_earth][important]" id="google_earth" class="tog-imp" <?php if(isset($settings['locale']['google_earth']['important'])){echo 'checked';}?> /></td>
		</tr>
		<tr>			<td><h4>rel="author" and rel="publisher" Tags</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[rel_author][enable]" id="rel_author-enable" class="tog-enable" <?php if($settings['locale']['rel_author']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-rel_author-enable" <?php if(!$settings['locale']['rel_author']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[rel_author][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['rel_author']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[rel_author][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['rel_author']['correct']; ?></textarea></td>
			<td><textarea name="locale[rel_author][problem]" id="p-rel_author" class="problem<?php if($settings['locale']['rel_author']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['rel_author']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[rel_author][important]" id="rel_author" class="tog-imp" <?php if(isset($settings['locale']['rel_author']['important'])){echo 'checked';}?> /></td>
		</tr>			
		<tr>			<td><h4>rel="canonical" Tag</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[canonical_tag][enable]" id="canonical_tag-enable" class="tog-enable" <?php if($settings['locale']['canonical_tag']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-canonical_tag-enable" <?php if(!$settings['locale']['canonical_tag']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[canonical_tag][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['canonical_tag']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[canonical_tag][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['canonical_tag']['correct']; ?></textarea></td>
			<td><textarea name="locale[canonical_tag][problem]" id="p-canonical_tag" class="problem<?php if($settings['locale']['canonical_tag']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['canonical_tag']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[canonical_tag][important]" id="canonical_tag" class="tog-imp" <?php if(isset($settings['locale']['canonical_tag']['important'])){echo 'checked';}?> /></td>
		</tr>
		<tr>			<td><h4>Canonical www</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[canonical_url][enable]" id="canonical_url-enable" class="tog-enable" <?php if($settings['locale']['canonical_url']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-canonical_url-enable" <?php if(!$settings['locale']['canonical_url']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[canonical_url][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['canonical_url']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[canonical_url][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['canonical_url']['correct']; ?></textarea></td>
			<td><textarea name="locale[canonical_url][problem]" id="p-canonical_url" class="problem<?php if($settings['locale']['canonical_url']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['canonical_url']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[canonical_url][important]" id="canonical_url" class="tog-imp" <?php if(isset($settings['locale']['canonical_url']['important'])){echo 'checked';}?> /></td>
		</tr>
			
		<tr>			<td><h4>Nested Tables</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[nested_tables][enable]" id="nested_tables-enable" class="tog-enable" <?php if($settings['locale']['nested_tables']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-nested_tables-enable" <?php if(!$settings['locale']['nested_tables']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[nested_tables][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['nested_tables']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[nested_tables][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['nested_tables']['correct']; ?></textarea></td>
			<td><textarea name="locale[nested_tables][problem]" id="p-nested_tables" class="problem<?php if($settings['locale']['nested_tables']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['nested_tables']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[nested_tables][important]" id="nested_tables" class="tog-imp" <?php if(isset($settings['locale']['nested_tables']['important'])){echo 'checked';}?> /></td>
		</tr>
			
		<tr>			<td><h4>Inline Styles</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[inline_styles][enable]" id="inline_styles-enable" class="tog-enable" <?php if($settings['locale']['inline_styles']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-inline_styles-enable" <?php if(!$settings['locale']['inline_styles']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[inline_styles][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['inline_styles']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[inline_styles][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['inline_styles']['correct']; ?></textarea></td>
			<td><textarea name="locale[inline_styles][problem]" id="p-inline_styles" class="problem<?php if($settings['locale']['inline_styles']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['inline_styles']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[inline_styles][important]" id="inline_styles" class="tog-imp" <?php if(isset($settings['locale']['inline_styles']['important'])){echo 'checked';}?> /></td>
		</tr>
			
		<tr>			<td><h4>Inline Scripts</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[inline_script][enable]" id="inline_script-enable" class="tog-enable" <?php if($settings['locale']['inline_script']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-inline_script-enable" <?php if(!$settings['locale']['inline_script']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[inline_script][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['inline_script']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[inline_script][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['inline_script']['correct']; ?></textarea></td>
			<td><textarea name="locale[inline_script][problem]" id="p-inline_script" class="problem<?php if($settings['locale']['inline_script']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['inline_script']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[inline_script][important]" id="inline_script" class="tog-imp" <?php if(isset($settings['locale']['inline_script']['important'])){echo 'checked';}?> /></td>		
		</tr>
			
		<tr>			<td><h4>Favicon</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[favicon][enable]" id="favicon-enable" class="tog-enable" <?php if($settings['locale']['favicon']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-favicon-enable" <?php if(!$settings['locale']['favicon']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[favicon][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['favicon']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[favicon][correct]" rows="5" class="correct" cols="40"><?php echo $settings['locale']['favicon']['correct']; ?></textarea></td>
			<td><textarea name="locale[favicon][problem]" id="p-favicon" class="problem<?php if($settings['locale']['favicon']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['favicon']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[favicon][important]" id="favicon" class="tog-imp" <?php if(isset($settings['locale']['favicon']['important'])){echo 'checked';}?> /></td>
		</tr>
		
		<tr>			<td><h4>Favicon Method</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[favicon_linked][enable]" id="favicon_linked-enable" class="tog-enable" <?php if($settings['locale']['favicon_linked']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-favicon_linked-enable" <?php if(!$settings['locale']['favicon_linked']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[favicon_linked][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['favicon_linked']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[favicon_linked][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['favicon_linked']['correct']; ?></textarea></td>
			<td><textarea name="locale[favicon_linked][problem]" id="p-favicon_linked" class="problem<?php if($settings['locale']['favicon_linked']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['favicon_linked']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[favicon_linked][important]" id="favicon_linked" class="tog-imp" <?php if(isset($settings['locale']['favicon_linked']['important'])){echo 'checked';}?> /></td>
		</tr>
		
		<tr>			<td><h4>Image ALT Tags</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[alt_attributes][enable]" id="alt_attributes-enable" class="tog-enable" <?php if($settings['locale']['alt_attributes']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-alt_attributes-enable" <?php if(!$settings['locale']['alt_attributes']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[alt_attributes][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['alt_attributes']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[alt_attributes][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['alt_attributes']['correct']; ?></textarea></td>
			<td><textarea name="locale[alt_attributes][problem]" id="p-alt_attributes" class="problem<?php if($settings['locale']['alt_attributes']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['alt_attributes']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[alt_attributes][important]" id="alt_attributes" class="tog-imp" <?php if(isset($settings['locale']['alt_attributes']['important'])){echo 'checked';}?> /></td>
		</tr>

		<tr>			<td><h4>Link anchor text</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[anchor_text][enable]" id="anchor_text-enable" class="tog-enable" <?php if($settings['locale']['anchor_text']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-anchor_text-enable" <?php if(!$settings['locale']['anchor_text']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[anchor_text][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['anchor_text']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[anchor_text][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['anchor_text']['correct']; ?></textarea></td>
			<td><textarea name="locale[anchor_text][problem]" id="p-anchor_text" class="problem<?php if($settings['locale']['anchor_text']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['anchor_text']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[anchor_text][important]" id="anchor_text" class="tog-imp" <?php if(isset($settings['locale']['anchor_text']['important'])){echo 'checked';}?> /></td>
		</tr>
			
		<tr>			<td><h4>Internal Text Links</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[internal_link][enable]" id="internal_link-enable" class="tog-enable" <?php if($settings['locale']['internal_link']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-internal_link-enable" <?php if(!$settings['locale']['internal_link']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[internal_link][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['internal_link']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[internal_link][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['internal_link']['correct']; ?></textarea></td>
			<td><textarea name="locale[internal_link][problem]" id="p-internal_link" class="problem<?php if($settings['locale']['internal_link']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['internal_link']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[internal_link][important]" id="internal_link" class="tog-imp" <?php if(isset($settings['locale']['internal_link']['important'])){echo 'checked';}?> /></td>
			<td>Max:<input type="text" name="locale[internal_link][max]" size="5" value="<?php echo $settings['locale']['internal_link']['max']; ?>" /></td>
		</tr>
	
		<tr>			<td><h4>External Text Links</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[external_link][enable]" id="external_link-enable" class="tog-enable" <?php if($settings['locale']['external_link']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-external_link-enable" <?php if(!$settings['locale']['external_link']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[external_link][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['external_link']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[external_link][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['external_link']['correct']; ?></textarea></td>
			<td><textarea name="locale[external_link][problem]" id="p-external_link" class="problem<?php if($settings['locale']['external_link']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['external_link']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[external_link][important]" id="external_link" class="tog-imp" <?php if(isset($settings['locale']['external_link']['important'])){echo 'checked';}?> /></td>
			<td>Max:<input type="text" name="locale[external_link][max]" size="5" value="<?php echo $settings['locale']['external_link']['max']; ?>" /></td>
		</tr>

		<tr>			<td><h4>Total Page Size</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[total_page_size][enable]" id="total_page_size-enable" class="tog-enable" <?php if($settings['locale']['total_page_size']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-total_page_size-enable" <?php if(!$settings['locale']['total_page_size']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[total_page_size][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['total_page_size']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[total_page_size][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['total_page_size']['correct']; ?></textarea></td>
			<td><textarea name="locale[total_page_size][problem]" id="p-total_page_size" class="problem<?php if($settings['locale']['total_page_size']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['total_page_size']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[total_page_size][important]" id="total_page_size" class="tog-imp" <?php if(isset($settings['locale']['total_page_size']['important'])){echo 'checked';}?> /></td>
			<td>Max Bytes:<input type="text" name="locale[total_page_size][max]" size="5" value="<?php echo $settings['locale']['total_page_size']['max']; ?>" /></td>
		</tr>

		<tr>			<td><h4>HTML Size (uncompressed)</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[html_size][enable]" id="html_size-enable" class="tog-enable" <?php if($settings['locale']['html_size']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-html_size-enable" <?php if(!$settings['locale']['html_size']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[html_size][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['html_size']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[html_size][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['html_size']['correct']; ?></textarea></td>
			<td><textarea name="locale[html_size][problem]" id="p-html_size" class="problem<?php if($settings['locale']['html_size']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['html_size']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[html_size][important]" id="html_size" class="tog-imp" <?php if(isset($settings['locale']['html_size']['important'])){echo 'checked';}?> /></td>
			<td>Max Bytes:<input type="text" name="locale[html_size][max]" size="5" value="<?php echo $settings['locale']['html_size']['max']; ?>" /></td>
		</tr>

		<tr>			<td><h4>HTML Compression Status</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[gzip][enable]" id="gzip-enable" class="tog-enable" <?php if($settings['locale']['gzip']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-gzip-enable" <?php if(!$settings['locale']['gzip']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[gzip][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['gzip']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[gzip][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['gzip']['correct']; ?></textarea></td>
			<td><textarea name="locale[gzip][problem]" id="p-gzip" class="problem<?php if($settings['locale']['gzip']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['gzip']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[gzip][important]" id="gzip" class="tog-imp" <?php if(isset($settings['locale']['gzip']['important'])){echo 'checked';}?> /></td>
		</tr>

		<tr>			<td><h4>Compression Ratio</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[compression_ratio][enable]" id="compression_ratio-enable" class="tog-enable" <?php if($settings['locale']['compression_ratio']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-compression_ratio-enable" <?php if(!$settings['locale']['compression_ratio']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[compression_ratio][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['compression_ratio']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[compression_ratio][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['compression_ratio']['correct']; ?></textarea></td>
			<td><textarea name="locale[compression_ratio][problem]" id="p-compression_ratio" class="problem<?php if($settings['locale']['compression_ratio']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['compression_ratio']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[compression_ratio][important]" id="compression_ratio" class="tog-imp" <?php if(isset($settings['locale']['compression_ratio']['important'])){echo 'checked';}?> /></td>
			<td>Min %:<input type="text" name="locale[compression_ratio][max]" size="5" value="<?php echo $settings['locale']['compression_ratio']['max']; ?>" /></td>		
		</tr>
		
		<tr>			<td><h4>HTML Size (If Compressed)</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[gzip_size][enable]" id="gzip_size-enable" class="tog-enable" <?php if($settings['locale']['gzip_size']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-gzip_size-enable" <?php if(!$settings['locale']['gzip_size']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[gzip_size][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['gzip_size']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[gzip_size][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['gzip_size']['correct']; ?></textarea></td>
			<td><textarea name="locale[gzip_size][problem]" id="p-gzip_size" class="problem<?php if($settings['locale']['gzip_size']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['gzip_size']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[gzip_size][important]" id="gzip_size" class="tog-imp" <?php if(isset($settings['locale']['gzip_size']['important'])){echo 'checked';}?> /></td>
		</tr>

		<tr>			<td><h4>x-cache - Page Caching</h4></td>		</tr>
		<tr>
			<td>Enable&nbsp;&nbsp;<input type="checkbox" name="locale[xcache][enable]" id="xcache-enable" class="tog-enable" <?php if($settings['locale']['xcache']['enable']){echo 'checked';}?> /></td>
		</tr>
		<tr id="e-xcache-enable" <?php if(!$settings['locale']['xcache']['enable']){echo 'style="display:none"';}?>>
			<td><textarea name="locale[xcache][tooltip]" rows="5" cols="40"><?php echo $settings['locale']['xcache']['tooltip']; ?></textarea></td>
			<td><textarea name="locale[xcache][correct]" class="correct" rows="5" cols="40"><?php echo $settings['locale']['xcache']['correct']; ?></textarea></td>
			<td><textarea name="locale[xcache][problem]" id="p-xcache" class="problem<?php if($settings['locale']['xcache']['important']){echo ' important';}?>" rows="5" cols="40"><?php echo $settings['locale']['xcache']['problem']; ?></textarea></td>
			<td class="checkbox"><input type="checkbox" name="locale[xcache][important]" id="xcache" class="tog-imp" <?php if(isset($settings['locale']['xcache']['important'])){echo 'checked';}?> /></td>
		</tr>
		</table>
		<p><input type="submit" value="Update Settings" class="button" /></p>
		</form>
<br />
		<h3>Import / Export Settings</h3>
		<h4>Import data (above) from another export (below) on another installation</h4>
		<form name="seoimport" enctype="multipart/form-data" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST">
			<p title="Choose an xml file to import"><input name="seofile" type="file" /></p>
			<input type="hidden" name="seoupload" value="true" />
			<input type="submit" value="Import" class="button" title="Submit" />
		</form>
		<h4>EXPORT to SAVE your work from above!</h4>
		<p title="Save a backup of your settings"><a class="button" target="_blank" href="?page=seo-automatic-plugin&seoexport=true">Download XML</a></p>
<br />
		<h3>Stats</h3>
		<?php $urls = get_option('autoseo_urls');
		if (!$urls){ ?>
		<p>It doesn't look like the tool has been used yet.  Check back later for stats.</p>
		<?php } else { ?>
		<p>wow! This tool has already been run <strong><?php echo get_option('autoseo_count'); ?> times</strong> to check <strong><?php echo count($urls); ?> domains</strong>. Can you believe that?</p>
		<p>Domains checked:</p>
		<table id="urls" class="tablesorter">
		<thead>
		<tr>
			<th>Domain</th>
			<th style="width:50px">Count</th>
		</tr>
		</thead>
		<?php
		$i=0;
		foreach ($urls as $domain => $count){ ?>
		<tr<?php if ($i > 9){echo ' class="table-more"';}?>>
			<td style="border:1px solid black"><?php echo $domain; ?></td>
			<td style="border:1px solid black"><?php echo $count; ?></td>
		</tr>
		<?php $i++;} //end foreach ?>
		</table>
		<?php if ($i > 10){echo '<a id="show-table" href="#">Show all ' . $i . ' domains.</a>';} //only print more text if we have 11 or more urls
		 } //end if urls 
		 ?>

</div></div>

</div></div>

<?php include('seoauto-sidebar.php'); ?>

<div class="clear"></div>
</div><!-- dashboard-widgets-wrap -->

</div></div><!-- wrap -->
<?php
}

/*
* Import / Export Helpers
*/

function seoauto_import($xmlpath){
	if (empty($xmlpath))
		return false;
	include('libs/assoc_array2xml.php');
	$converter = new assoc_array2xml;
	$xml = file_get_contents($xmlpath);
	$newsettings = $converter->xml2array($xml);
	$newsettings = $newsettings['array'];
	array_walk_recursive($newsettings, 'seoauto_prepare_import');
	if(!is_array($newsettings['locale']['title'])) //validate it is an actual seoauto export
		return false;

	$oldsettings = get_option('autoseo_options');
	
	if(is_array($oldsettings['paypal']))
		$newsettings['paypal']['require'] = $oldsettings['paypal']['require']; //We don't export this setting to avoid conflicts so we will keep the original setting
	else
		unset($newsettings['paypal']['require']);
	
	update_option('autoseo_options', $newsettings);
	return true;
}

function seoauto_export(){
	if (isset($_GET['seoexport']) && current_user_can('activate_plugins')){
		include('libs/assoc_array2xml.php');
		header('Content-type: text/xml');
		header('Content-disposition: attachment; filename=seo-settings.xml');
		$array = get_option('autoseo_options');
		unset($array['paypal']['require']); // This could cause conflicts with people who do not have the paypal plugin if we left it set.
		array_walk_recursive($array, 'seoauto_prepare_export');
		$converter = new assoc_array2xml;
		$xml = $converter->array2xml($array);
		echo $xml;
		die;
	}
}
// walker functions
function seoauto_prepare_export(&$var, $key){
	$var = base64_encode($var);
}
function seoauto_prepare_import(&$var, $key){
	$var = base64_decode($var);
}
add_action('init', 'seoauto_export',99);
?>