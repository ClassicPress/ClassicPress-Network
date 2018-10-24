=== weDocs - the documentation plugin ===
Contributors: tareq1988, wedevs
Donate link: https://tareq.co/donate/
Tags: document, documentation, help, support, note
Requires at least: 3.6
Tested up to: 4.9.1
Requires PHP: 5.4
Stable tag: 1.4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create great looking documentation for your products.

== Description ==

Create great looking documentation for your products. Organize your product documentation in your site, beautifully!

* [Documentation](https://github.com/tareq1988/wedocs-plugin/wiki)
* [Github](https://github.com/tareq1988/wedocs-plugin/)

You can host docs inside your WordPress, create/add new docs, organize with ordering, tags and even fetch docs from external sites using this plugin.

This plugin is extremely handy for delivering long and detailed documentation of your WordPress product / plugin by bundling this with it.

weDocs makes browsing and creating documentation a fresh and streamlined experience within the familiarity of your WP environment.

### Contribute ###
This may have bugs and lack of many features. If you want to contribute on this project, you are more than welcome. Please fork the repository from [Github](https://github.com/tareq1988/wedocs-plugin).

### Author ###
Brought to you by [Tareq Hasan](https://tareq.co) from [weDevs](https://wedevs.com)


== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

Nothing here yet

== Screenshots ==

1. Admin UI
2. Documentation on Admin UI builder
3. Actions UI
4. Switch to classic UI
5. Classic docs UI
6. All docs in frontend via shortcode
7. Single docs view with navigation
8. Search widget
9. Search widget in frontend

== Changelog ==

= v1.4.1 (26 August, 2018) =

 * **Fix:** Updated Vue.js version to 2.5.16 and added minified version as well.

= v1.4 (25 August, 2018) =

 * **New:** Added new shortcode attribute (<code>items</code>) to limit no. of items shown. [#59](https://github.com/tareq1988/wedocs-plugin/pull/59/files)
 * **New:** Added a new filter <code>wedocs_email_feedback_to</code> for outgoing mail to address. [#63](https://github.com/tareq1988/wedocs-plugin/issues/63)
 * **New:** Added theme wrapper support. Now developers will be able to put dynamic start and end divs and tags in the <code>single-docs.php</code> template.
 * **New:** Show 3rd level doc in the admin UI builder.
 * **New:** Added automatic anchor tags in docs for <code>h2</code> and <code>h3</code> tags. Bookmarking is now very easy! Thanks to [anchorjs](https://github.com/bryanbraun/anchorjs/).
 * **Fix:** Bug with quotes in the doc title. [#66](https://github.com/tareq1988/wedocs-plugin/issues/66)
 * **Improved:** Flush rewrite rules after plugin activates. Fixes the long time permalink issues with 404.
 * **Improved:** Disable page scrolling when the feedback modal is open.

= v1.3.3 (8 November, 2017) =

 * **Improved:** Proper user roles/permission checking when creating and deleting a doc. Previously, everyone who could access the UI, could create and delete any doc. No user capability checking was done previously, this version fixes the issue.

= v1.3.2 (15 October, 2017) =

* **Fix:** Remove WPUF dependency on weForms upsell
* **New:** Show docs and taxonomy in REST API. Fixes #44
* **New:** List child articles if present in single doc. Fixes #34
* **New:** Added page-atrribute support for the Docs post type. Now you can change the doc parent from the single docs edit page.
* **Improved:** Upgrade Vue to 2.5.1 from 1.0.16
* **Improved:** Every user should see the switch to classic UI url

= v1.3.1 (24 August, 2017) =

 * [improve] Added weForms reference

= v1.3 (21 August, 2017) =

 * [fix] Add missing text domains and Qtranslate support on doc feedback email
 * [fix] Moved final breadcrumb echo out of if parent clause and removed resultant excess delimiter. #23
 * [fix] Translate the send button. #38
 * [fix] Printing timeout extended to 2 seconds
 * [fix] Wrong tag post_type linking in edit-tags.php in admin. #40
 * [improve] Added filter on wedocs post type
 * [new] Added Spanish language  (#37)
 * [new] Added docs page settings, removed post archive. Added settings “Docs Home” to use it in breadcrumb as Docs home. Created the docs page on activation if not exits.
 * [new] Added filter <code>wedocs_breadcrumbs_html</code> to customize breadcrumb HTML
 * [new] Added `wedocs_get_publish_cap()` function for dynamic role binding on admin menu, pending post status support. #42


= v1.2.1 (1 November, 2016) =

 * [fix] Auto print dialog missed

= v1.2 (1 November, 2016) =

 * [new] Added print option
 * [new] Contact modal
 * [new] Responsiveness
 * [new] Microdata implementation (schema.org)
 * [new] Last updated date
 * [new] Settings page

= v1.1 (24 October, 2016) =

 * SKIPPED VERSION due to release mistake

= v1.0 (24 October, 2016) =

 * [new] Added Persian language
 * [new] Add french translation, responsiveness and QtranslateX full support
 * [fix] Attach $event object to addArticle method
 * [fix] Typo in the key name (causes a PHP notice on line 111 `$args['after']`).

= v0.1 (2 march, 2016) =

 * Initial release

== Upgrade Notice ==

Nothing here yet
