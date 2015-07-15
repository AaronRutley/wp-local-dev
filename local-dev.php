<?php
/*
Plugin Name: Local Dev
Plugin URI: http://www.localdev.com/
Description: Very simple plugin for local dev helpers
Version: 0.0.1
Author: Aaron Rutley
Author URI: http://www.aaronrutley.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*  Copyright 2015 Aaron Rutley

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// echo 'url:'.WP_DEBUG;

class Local_Dev_Plugin {

	function __construct()
	{
		// define the current site url
		define('CURRENT_SITE_URL', get_site_url());

		// if (!defined('LOCAL_URL') ) {
		// 	echo 'localurl not defined';
		// } else {
		// 	echo 'localurli is:'.LOCAL_URL;
		// }


		// Local live reload function
		function turbo_local_reload() { ?>
		<!-- live reload -->
		<script src="//localhost:35729/livereload.js"></script>
		<!-- end live reload -->
		<?php }

		// Local image proxy function
		function turbo_local_proxy() { ?>
			<script type="text/javascript">
			(function($) {
				jQuery(document).ready(function() {
					$('img').attr('src',function(index,attr){
					      return attr.replace('<?php echo turbo_local_url; ?>','<?php echo turbo_remote_url; ?>');
					});
				});
			})( jQuery );
			</script>
		<?php }

		// Local admin css to style admin bar
		function turbo_admin_custom_css() {
		  	echo '<style>#wpadminbar {background:#005781 !important;}#adminmenu{margin-top:0 !important;} #wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar .ab-top-menu>li:hover>.ab-item, #wpadminbar .ab-top-menu>li>.ab-item:focus, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus { background:#0073AA !important; color: #FFF !important;} .ab-sub-wrapper { background:#0073AA !important; } </style>';
		}

		// Checks
		if (CURRENT_SITE_URL == LOCAL_URL):
			add_action('admin_head', 'turbo_admin_custom_css');
		endif;

		if (CURRENT_SITE_URL == LOCAL_URL && LOCAL_LIVE_RELOAD == true):
			add_action('wp_footer', 'turbo_local_reload',99);
		endif;

		if (CURRENT_SITE_URL == LOCAL_URL && LOCAL_IMAGE_PROXY == true):
			add_action('wp_footer', 'turbo_local_proxy',100);
		endif;
	}
}

$local_dev = new Local_Dev_Plugin();
