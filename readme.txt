=== Plugin Name ===
Contributors: vegasgeek, toddhuish
Tags: email, developers
Requires at least: 3.0
Tested up to: 4.6.1
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the ability to easily CC developers on all admin emails

== Description ==

Have you ever built a site for a client and your email address gets set as the admin email, then lost access to the site but continue to receive their admin emails until the end of time? Me, too!

The CC Devs plugin adds a field to the General settings page where you can add a comma separated list of emails who should receive copies of admin emails for testing. The dev's version of the emails will include a link allowing them to unsubscribe from the site's emails.

== Installation ==

1. Upload `ccdevs` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. On the `Settings -> General` page, add a comma separated list of email addresses to recieve copies of admin emails

or

1. Go to `Plugins` -> `Add New` and search for CC Devs
1. Click `Install Now`
1. On the `Settings -> General` page, add a comma separated list of email addresses to recieve copies of admin emails

== Frequently Asked Questions ==

= How does it work? =

On the `Settings -> General` page, add a comma separated list of email addresses to the `Dev Emails` field. Then, any time the website sends an email to the site admin, the devs will be sent a copy of the email with a unique link that will allow them to unsubscribe from receiving future emails.

== Screenshots ==

1. On the `Settings -> General` page, add a comma separated list of email addresses to the `Dev Emails` field.

== Changelog ==

= 1.0.3 =
* Clean up syntax
* Removed functions file, moved all functions to main file

= 1.0.2 =
* Cleaned up an undefined index.

= 1.0.1 =
* Of course we pushed the first version live with a fatal php error. Fixed.

= 1.0 =
* Initial launch, just in time for Plugin-A-Palooza at WordCamp Orange County 2015
