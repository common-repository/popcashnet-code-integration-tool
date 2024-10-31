=== PopCash Code Integration Tool ===
Contributors: (popcashnet)
Tags: popcash.net, code, integrator, integration, popunder, script, snippet, tool
Requires at least: 3.0.1
Tested up to: 6.4
Stable tag: 1.8
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is designed to help the integration of the publisher code from PopCash.Net

== Description ==

The plugin offers Wordpress publishers the possibility to integrate the PopCash.Net pop-under code by two methods: either through inserting User ID (UID) and Website ID (WID) or through copying and pasting the code obtained through your PopCash.Net user panel. More than this, the plugin also offers users the option to temporarily disable the code integration without having to uninstall or deactivate the plugin

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/popcash-net` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the PopCash.Net screen to configure the plugin
3.1. Plugin Configuration
3.1.1. On the Standard Script page, insert the User ID and Website ID that you have obtained from your PopCash.Net User Dashboard
3.1.2. On the Anti Adblock, insert your Popcash Anti Adblock ApiKey and Website ID that you have obtained from your PopCash.Net User Dashboard
3.1.3. On the Manual Integration page, copy and paste the code that you can get from your PopCash.Net User Dashboard

== Changelog ==

= 1.1 =
* Fix cross site scripting vulnerability described [here](https://packetstormsecurity.com/files/144583/WordPress-PopCash.Net-Publisher-Code-Integration-1.0-Cross-Site-Scripting.html). Thanks to Ricardo Sanchez
= 1.1.1 =
* Fixing bugs when switching tabs
= 1.2 =
* New drop-down option to choose the fallback behavior (if popunder is not possible)
* Added a fallback CDN (if the main one is not available)
= 1.2.1 =
* Update script source

= 1.3 =
* Updated old layout and fixed bugs
* Added Anti AdBlock feature

= 1.4 =
* Bumped version for wordpress 6.1


== Upgrade Notice ==

= 1.1 =
Includes fix for cross site scripting vulnerability described [here](https://packetstormsecurity.com/files/144583/WordPress-PopCash.Net-Publisher-Code-Integration-1.0-Cross-Site-Scripting.html). Thanks to Ricardo Sanchez

= 1.2.1 =
Includes fix for 404 cdn file, described [here](https://wordpress.org/support/topic/failed-to-load-resource-the-server-responded-with-a-status-of-404-16/). Thanks to [@jotavek](https://wordpress.org/support/users/jotavek)

= 1.3 =
Includes fix for css typo in name, described [here](https://wordpress.org/support/topic/404-css-from-spelling-error/). Thanks to [@dualaudi](https://wordpress.org/support/users/dualaudi)
Includes assets file only for plugin page, described [here](https://wordpress.org/support/topic/plugin-need-to-update/). Thanks to [@maulik882](https://wordpress.org/support/users/maulik882)

= 1.4 =
* Bumped version for wordpress 6.1

= 1.6 =
Added bootstrap version 5

= 1.7 =
Tested for wordpress 6.4

= 1.8 =
Fixed dynamic property deprecation warning
