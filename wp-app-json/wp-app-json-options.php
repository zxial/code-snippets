<?php
function wp_app_json_option_page(){
?>	<div class="wrap">
		<h2>WP APP JSON <small>v. 1.0</small></h2><div class="clear"></div>
		<h3>Configuration</h3><div class="clear"></div>
		<hr/>
		<form method="POST" action="options.php">
		<?php settings_fields( 'wp-app-json-setting-group' ); ?>
		<?php do_settings_sections( 'wp-app-json-setting-group' ); ?>
		
			<table class="form-table"><tbody>
				<tr valign="top">
					<th scope="row">Secrets:</th>
					<td><input id="wp_app_json_secrets" value="<?php echo get_option('wp_app_json_secrets',wp_app_json_get_default_option('wp_app_json_secrets')); ?>" name="wp_app_json_secrets" type="text"></td>
					<td>APP Secrets for the methods provided.</td>
				</tr>
				<tr valign="top">
					<th scope="row">Post count for <code>gl</code> method:</th>
					<td><input id="wp_app_json_postcount" value="<?php echo get_option('wp_app_json_postcount', wp_app_json_get_default_option('wp_app_json_postcount')); ?>" name="wp_app_json_postcount" type="text"></td>
					<td>MUST be integer. When the APP calls <code>gl</code> method, this number specify how many posts will be returned in one invoke.</td>
				</tr>
				<tr valign="top">
					<th scope="row">Default thumb url:</th>
					<td><input id="wp_app_json_thumburl" value="<?php echo get_option('wp_app_json_thumburl', wp_app_json_get_default_option('wp_app_json_thumburl')); ?>" name="wp_app_json_thumburl" type="text"></td>
					<td>Default thumb file if no thumb in post.</td>
				</tr>
				<tr valign="top">
					<th scope="row">Header(can be any text or html):</th>
					<td><textarea id="wp_app_json_header" name="wp_app_json_header" style="width:360px;height:150px"><?php echo get_option('wp_app_json_header', wp_app_json_get_default_option('wp_app_json_header')); ?></textarea></td>
					<td>The text here will show before the title of the post.</td>
				</tr>
				<tr valign="top">
					<th scope="row">Banner(can be any text or html):</th>
					<td><textarea id="wp_app_json_banner" name="wp_app_json_banner" style="width:360px;height:150px"><?php echo get_option('wp_app_json_banner', wp_app_json_get_default_option('wp_app_json_banner')); ?></textarea></td>
					<td>The text here will show under the title of the post, and before the content.</td>
				</tr>
				<tr valign="top">
					<th scope="row">Footer(can be any text or html):</th>
					<td><textarea id="wp_app_json_footer" name="wp_app_json_footer" style="width:360px;height:150px"><?php echo get_option('wp_app_json_footer', wp_app_json_get_default_option('wp_app_json_footer')); ?></textarea></td>
					<td>Text here will show under the content of the post.</td>
				</tr>
			</tbody></table>
			<br/>
	<?php submit_button();
 	echo 
		'<br/><br/>
		</form>
	</div>';
	echo '<div class="clear"></div><div class="clear"></div>';

	//Documents parts
	echo '<h3>Documents of WP-APP-JSON</h3><div class="clear"></div><hr/><div class="clear"></div><p>This plugin provides JSON data to mobile APPs. Here\'s the scenarios that you could use this plugin: you want to develop a mobile app or app on mac, and the app is to show the list of your blogs(in category, tag, or keywords), after the app user click one item in the blog list, you would like to show him the detail page of the item, but the logos/banners/sidebar of blog is suitable only for a desktop other than a mobile device or you want to do something different. In the case here, wp_app_json maybe could help. </p>';
	echo '<p>In version 1.0 of WP APP JSON, 2 methods are provided,<code>gl</code> and <code>dt</code>.</p>';
	//Method of gl
	echo '<p><h4>Method <code>gl</code> will retrieve posts from the plugin, search results of keywords.</h4></p>';
	echo '<p>You need to call <code>gl</code> from the URL <br/><code>http://YOUR.WORDPRESS.DOMAIN/?YOURSECRECTS&gl&k=KEYWORDS&p=PAGENO</code></p>';
	echo '<p><code>YOURSECRECTS</code> is the string you set in the configuration.</p>';
	echo '<p><code>gl</code> will Get List of Posts.</p>';
	echo '<p><code>p</code> which page of the results. By default, <code>p=0</code> the method will return the first page of search result.</p>';
	echo '<p>When <code>gl</code> is called, the following JSON will be returned as example.</p>';
	echo '';
	echo '<p><code>{"msg":"1","0":{"ID":238,"title":"title of Post 0","excerpt":"excerpt of post 0...","thumb":"http://www.diaoyuqu.cn/wp-content/uploads/2013/12/17-150x150.jpg"},"1":{"ID":238,"title":"title of Post 1","excerpt":"excerpt of post 1...","thumb":"http://www.diaoyuqu.cn/wp-content/uploads/2013/12/17-150x150.jpg"},...
} </code></p>';
	
	//Method of dt
	echo '<h4>Method <code>dt</code> will retrieve specified post from the plugin, by Post ID.</h4>';
	echo '<p>You need to call <code>dt</code> from the URL <br/><code>http://YOUR.WORDPRESS.DOMAIN/?YOURSECRECTS&dt&pid=xxx</code></p>';
	echo '<p><code>YOURSECRECTS</code> is the string you set in the configuration.</p>';
	echo '<p><code>dt</code> will get DeTail of specified post</p>';
	echo '<p><code>pid</code> is the Post ID you wanted, you can get the Post ID in method<code>gl</code></p>';

	echo '<p>NOTE: if you want to change the style in detail page, you need to modify the style.css file.</p>';
	//About
	echo '<h3>About WP-APP-JSON</h3><div class="clear"></div><hr/><div class="clear"></div>';
	echo '<p>This plugin is under GPL v2 or later Licence.</p>';
	echo '<p>Author: <a href="http://zxial.me" target="_blank">Zxial</a>. Code at <a href="https://github.com/zxial/code-snippets" target="_blank">github</a></p>';
}

function wp_app_json_get_default_option($option_name){
	switch ($option_name){
		case 'wp_app_json_secrets': return 'appjson';
		case 'wp_app_json_postcount': return '10';
		case 'wp_app_json_thumburl': return 'http://zxial.me/wp-content/uploads/2014/03/wordpress-logo.png';
		case 'wp_app_json_header': return '<section><h2>Header Here! Maybe you want to add logo here.</h2></section>';
		case 'wp_app_json_banner': return '<section><h2>Banners Here! Maybe you want to add some banners or notifications here.</h2></section>';
		case 'wp_app_json_footer': return '<section>Powered by <a href="http://wordpress.org">Wordpress</a> and the plugin of <a href="http://zxial.me">WP-APP-JSON</a></section>';
	}
	
}

function wp_app_json_register_settings(){
	register_setting( 'wp-app-json-setting-group', 'wp_app_json_secrets' );
	register_setting( 'wp-app-json-setting-group', 'wp_app_json_postcount' );
	register_setting( 'wp-app-json-setting-group', 'wp_app_json_thumburl' );
	register_setting( 'wp-app-json-setting-group', 'wp_app_json_banner' );
	register_setting( 'wp-app-json-setting-group', 'wp_app_json_header' );
	register_setting( 'wp-app-json-setting-group', 'wp_app_json_footer' );

}
?>
