<?php

/**
 *
 * @link              https://napolux.com
 * @since             1.0.0
 * @package           Simplealexa
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Alexa news briefing
 * Plugin URI:        https://github.com/napolux/wp-alexa
 * Description:       A stupid simple WordPress plugin you can use to create Alexa flash briefing skills.
 * Version:           1.0.0
 * Author:            Francesco Napoletano
 * Author URI:        https://napolux.com
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       simplealexa
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SIMPLEALEXA_VERSION', '1.0.0');

// Write a new permalink entry on code activation
register_activation_hook(__FILE__, 'simplealexa_activation');
function simplealexa_activation()
{
	flush_rewrite_rules();
}

// If the plugin is deactivated, clean the permalink structure
register_deactivation_hook(__FILE__, 'simplealexa_deactivation');
function simplealexa_deactivation()
{
	flush_rewrite_rules();
}

// create fake page called "simplealexa"
// modify variable $url to the fake URL you require
add_filter('the_posts', 'simplealexa', -10);
function simplealexa($posts)
{
	global $wp;
	global $simplealexa;
	$url = "simplealexa"; // URL of the page for alexa data

	if (!$simplealexa && (strtolower($wp->request) == $url || $wp->query_vars['page_id'] == $url)) {
		$simplealexa = true;

		$posts = get_posts([
			'posts_per_page' => 5 // change here if you want more options!...
		]);

		$return = [];

		foreach ($posts as $post) {
			$text = (empty($post->post_excerpt)) ? $post->post_title : $post->post_title . ', ' . $post->post_excerpt;
			$return[] = [
				'uid' => get_site_url() . '-simplealexa-post-' . $post->ID,
				'updateDate' => date('c', strtotime($post->post_date)),
				'titleText' => $post->post_title,
				'mainText' => $text
			];
		}
		wp_reset_postdata();

		header("Content-Type: application/json");
		echo json_encode($return);
		exit;
	}

	return $posts;
}