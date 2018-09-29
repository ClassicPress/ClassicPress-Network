=== Multisite User Sync ===
Contributors: shamim51
Tags: multisite,multisite user sync,user sync,sync,multisite user
Requires at least: 4.4
Tested up to: 4.9.8
Requires PHP: 5.4
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Multisite User Sync will automatically synchronize users to all sites in multisite. Roles of users will be same on everysite.

== Description ==

Multisite User Sync will automatically synchronize users to all sites in multisite. Roles of users will be same on every site. If Role change in one site it will also synchronize to all site. If new user/site created it will also add to all site/users.

In one of my website it was needed to separate them fully for every product. So i use multisite. But it also needed to use same users (including role) for every site. So i write one plugin. I have searched for this type of plugins and i found none. So i upload it to wordpress plugin directory if somebody need it. This plugin works out of the box, No settings required.


== Installation ==
1. Upload "multisite-user-sync" to the "/wp-content/plugins/" directory.
1. Activate the plugin through the "Plugins" menu in WordPress.
1. **Network Activate** this plugin if you want to sync all users in all sites.
1. Activate in Individual sites if you want to sync only users created/Change in those sites.


== Frequently Asked Questions ==
= How This Plugin Works? =
When activate this plugin it will add all users from current site to all sites. So that all users are in sync between subsites. Role will be same as current site role in all sites.
When a new site is created it will add all users to new sites in same role.
When a new user is created it loop through all sites and add this new user to all sites in same role. When a role is changed in one site it loop through all sites and change this user role to all sites.

= Can i sync users created/changed in particular site(s)? =
Yes. In that case do not activate this in Network Activate. Just activate this plugin for that particular site(s).

== Screenshots ==

1. Activate

== Changelog ==

= 1.2 =

* This plugin is redesigned. Logic changed. Bug fixed where it was issue when sync users.

= 1.1 =

* Initial release.

== Upgrade Notice ==

= 1.1 =

* Initial release.
