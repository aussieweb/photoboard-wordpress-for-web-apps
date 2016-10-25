<?php

/**
 * Plugin Name: Photoboard WordPress for Web Apps
 * Plugin URI: https://github.com/cferdinandi/photoboard-wordpress-for-web-apps
 * GitHub Plugin URI: https://github.com/cferdinandi/photoboard-wordpress-for-web-apps
 * Description: Add user groups to Photoboard
 * Version: 1.0.0
 * Author: Chris Ferdinandi
 * Author URI: http://gomakethings.com
 * License: All rights reserved
 */


	/**
	 * Redirect logged out users to sign-in page
	 */
	function photoboard_wpwa_redirect_logged_out_users() {

		// Only run for logged out users visiting certain pages
		if ( is_user_logged_in() || is_page() ) return;

		// Redirect
		wp_safe_redirect( site_url() . '/log-in' , 302 );
		exit;

	}
	add_action('wp', 'photoboard_wpwa_redirect_logged_out_users');



	/**
	 * Disable RSS feeds
	 */
	function photoboard_wpwa_disable_feeds() {
		wp_safe_redirect( site_url(), 301 );
		exit;
	}
	add_action('do_feed', 'photoboard_wpwa_disable_feeds', 1);
	add_action('do_feed_rdf', 'photoboard_wpwa_disable_feeds', 1);
	add_action('do_feed_rss', 'photoboard_wpwa_disable_feeds', 1);
	add_action('do_feed_rss2', 'photoboard_wpwa_disable_feeds', 1);
	add_action('do_feed_atom', 'photoboard_wpwa_disable_feeds', 1);
	add_action('do_feed_rss2_comments', 'photoboard_wpwa_disable_feeds', 1);
	add_action('do_feed_atom_comments', 'photoboard_wpwa_disable_feeds', 1);



	/**
	 * Restrict dashboard access to admins
	 */
	function photoboard_wpwa_restrict_dashboard_access() {
		if (!current_user_can( 'manage_options' ) && $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php') {
			wp_safe_redirect( site_url() );
			exit;
		}
	}
	add_action( 'admin_init', 'photoboard_wpwa_restrict_dashboard_access' );