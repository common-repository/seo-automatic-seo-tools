<?php
include('thisplugin.php');
$adminhome = 'yes';
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
#resources li { clear: both; }
</style>

<div class="wrap">
<br />
<div id="dashboard-widgets-wrap">
<div id='dashboard-widgets' class='metabox-holder'>

<div class='postbox-container' style='width:60%;'>
<div id='normal-sortables' class='meta-box-sortables'>

<div id="main-admin-box" class="postbox">
<h3><span><img src="<?php echo plugins_url().$thisplugin; ?>/images/favicon.png" alt="Search Commander Inc." /> SEO Tools <?php echo $pro; ?>Admin</span></h3>
<div class="inside">

<p>SEO Tools is more than one plugin, it's a proven system for getting the most out of WordPress, that was developed for Search Commander, Inc.</p>
<p>Access any of your installed modules from the menu now added to the bottom left of your WP-admin.</p>
<p>Here are the modules you have installed:</p>

<?php
if (function_exists('sc_settings')) {
	echo "<p><a href=\"?page=seo-automatic-wp-core-tweaks/settings.php\">Core Tweaks</a></p>";
}
if (function_exists('affiliate_menu')) {
	echo "<p><a href=\"?page=affiliate/files/admin/index.php\">Affiliate Site Generator</a></p>";
}
if (function_exists('aw_paypal_add_pages')){
	echo "<p><a href=\"?page=paypal-credits-options\">PayPal Credits</a><br />".
	"<a href=\"?page=paypal-manage-users\">Manage Users</a><br />".
	"<a href=\"?page=import-users\">Import Users</a></p>";
}
if (function_exists('unf_content_filter')) {
	echo "<p><a href=\"?SEO-Automatic-No-Followizer/unf-admin-menu.php\">No Followizer</a></p>";
}
if (function_exists('seo_tools_admin')) {
	echo "<p><a href=\"?page=seo-automatic-seo-tools/settings.php\">SEO Tools</a></p>";
}
if (function_exists('seo_tools_admin_pro')) {
	echo "<p><a href=\"?page=seo-automatic-seo-tools/settings.php\">SEO Tools Pro</a></p>";
}
//if (function_exists('autoseo_add_pages')){
//	echo "<p><a href=\"?page=seo-automatic-plugin\">SEO Tools URL Review add-on</a></p>";
//}
if (function_exists('autoseo_add_pages_pro')){
	echo "<p><a href=\"?page=seo-automatic-plugin\">SEO Tools Pro - URL Checker add-on</a></p>";
}
if (function_exists('ourprofiles_init')){
	echo "<p><a href=\"?page=our-profiles-config\">Our Profiles</a></p>";
}
?>

<p>Clicking on the installed module links above will take you to the respective settings page. To return here, go to the Admin menu option under SEO Tools.</p>

</div></div>

<div id="wpsc_dashboard_widget" class="postbox" >
<h3><span>Latest news from the Search Commander blog ...</span></h3>
<div class="inside">
<?php
include_once(ABSPATH . WPINC . '/feed.php');
$rss = fetch_feed('https://www.searchcommander.com/feed/');
if (!is_wp_error( $rss ) ) : 
    $maxitems = $rss->get_item_quantity(5); 
    $rss_items = $rss->get_items(0, $maxitems); 
endif;
?>

<ul>
    <?php if ($maxitems == 0) echo '<li>No items.</li>';
    else
    foreach ( $rss_items as $item ) : ?>
    <li>
        <a href='<?php echo $item->get_permalink(); ?>'
        title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>' target='_blank'>
        <?php echo $item->get_title(); ?></a><br />
		<?php echo $item->get_description(); ?>
    </li>
    <?php endforeach; ?>
</ul>
</div></div>

</div></div>

<?php include('seoauto-sidebar.php'); ?>

<div class="clear"></div>
</div><!-- dashboard-widgets-wrap -->

</div></div><!-- wrap -->