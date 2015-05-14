<?php
/**
 * Items that need to be built:
 * Done! - 1. Add field to general settings page to allow for comma separated list of email address
 * 2. If emails exist in field, add them to CC field for any emails going to admin
 * 3. Store a transient token for 3 days to allow for CC'd person to be allowed to alter that field, even if not logged in
 * 4. Append a link to emails that would allow a dev to click and unsubscribe from the list
 * - - The link should include the token. If the token matches a transient, we remove the dev from the CC field 
 */

/**
 * ccd_add_settings_section	Setup CCDevs settings on General settings page
 * @return html
 */
function ccd_add_settings_section() {
	add_settings_section(
		'ccd_settings_section',
		'CC Devs',
		'ccd_section_options_callback',
		'general'
	);

	add_settings_field(
		'ccdev_list',
		'Dev Emails',
		'ccdev_list_callback',
		'general',
		'ccd_settings_section',
		array(
			'ccdev_list'
		)
	);

	register_setting( 'general','ccdev_list', 'esc_attr' );
}

add_action( 'admin_init', 'ccd_add_settings_section' );

/**
 * ccd_section_options_callback Displays a message in our section on the general settings page
 * @return [type] [description]
 */
function ccd_section_options_callback() {
	echo '<p>'. __( 'Add a comma separated list of email addresses to receive copies of emails sent to the site admin.', 'ccdevs' ) .'</p>';
}

/**
 * ccdev_list_callback Displays the input field in our section on the general settings page
 * @param  [type] $args [description]
 * @return html       [description]
 */
function ccdev_list_callback($args) {
	$option = get_option($args[0]);
	echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

/**
 * my_wp_mail_filter Filters emails, if sending to admins, also CC's developers
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
function my_wp_mail_filter( $args ) {

	// Get Admin email
	$admin_email = get_site_option( 'admin_email' );
	if( $admin_email == $args['to'] ) {
		$timehash = md5( date( 'U' ) );
		$list_of_devs = explode( ',', get_option( 'ccdev_list' ) );

		// 1. Set transient
		set_transient( 'ccdevs_list', $list_of_devs, 3 * DAYS_IN_SECONDS );

		// 2. Add CC list
		$do_cclist = true;

		// 3. Filter Message with unsub link
		$args['message'] .= "\n\n To unsubscribe from these emails, <a href=\"". get_option( 'site_url') ."?ccdevs=". $timehash ."\">Click Here</a>";

	}

	$new_wp_mail = array(
		'to'          => $args['to'],
		'subject'     => $args['subject'],
		'message'     => $args['message'],
		'headers'     => $args['headers'],
		'attachments' => $args['attachments'],
	);

	if( $do_cclist == true ) {
		$new_wp_mail['cc'] = get_option( 'ccdev_list' );
	}
	
	return $new_wp_mail;
}

add_filter( 'wp_mail', 'my_wp_mail_filter' );
