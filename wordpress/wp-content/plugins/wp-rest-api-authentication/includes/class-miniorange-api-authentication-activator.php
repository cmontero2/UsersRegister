<?php

/**
 * Fired during plugin activation
 *
 * @link       miniorange
 * @since      1.0.0
 *
 * @package    Miniorange_api_authentication
 * @subpackage Miniorange_api_authentication/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Miniorange_api_authentication
 * @subpackage Miniorange_api_authentication/includes
 * @author     miniOrange 
 */
class Miniorange_api_authentication_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		update_option( 'host_name', 'https://login.xecurify.com' );

		mo_api_authentication_reset_api_protection();

		if(! get_option('miniorange_api_authentication_act'))
		{
			update_option('miniorange_api_authentication_act',base64_encode(current_time('timestamp')));
		}

		if(! get_option('miniorange_api_authentication_ctr'))
		{
			update_option('miniorange_api_authentication_ctr',base64_encode(0));
		}

	}

}
