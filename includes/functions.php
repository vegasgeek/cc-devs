<?php
/**
 * Items that need to be built:
 * 1. Add field to general settings page to allow for comma separated list of email address
 * 2. If emails exist in field, add them to CC field for any emails going to admin
 * 3. Store a transient token for 3 days to allow for CC'd person to be allowed to alter that field, even if not logged in
 * 4. Append a link to emails that would allow a dev to click and unsubscribe from the list
 * - - The link should include the token. If the token matches a transient, we remove the dev from the CC field 
 */


add_action( 'admin_init', 'ccd_add_settings_section' );
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

function ccd_section_options_callback() {
	echo '<p>'. __( 'Add a comma separated list of email addresses to receive copies of emails sent to the site admin.', 'ccdevs' ) .'</p>';
}

function ccdev_list_callback($args) {
	$option = get_option($args[0]);
	echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}