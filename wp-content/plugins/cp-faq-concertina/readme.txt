=== FAQ Concertina ===
Contributors: mburridge
Donate link: http://www.zyriab.co.uk/faqconc/
Tags: accessible, accordion, faq, faqs, frequently asked questions, frequently, asked, question, questions, concertina, faq concertina, faq accordion, responsive, category, categories, hidden, hidden section, hidden sections, expanding, expanding section, expanding sections, expandable, expandable section, expandable sections, css, jQuery, custom, custom post type, dashboard, admin, administration, simple, easy, free, free faq plugin, free faqs plugin, plugin, mobile friendly, shortcode, order, customise, customize, customisable, customizable, accessibility, assistive, assistive technologies, screen-reader, wai-aria, wai, web accessibility initiative, aria 
Author URI: http://www.zyriab.co.uk/
Plugin URI: http://www.zyriab.co.uk/faqconc/
Requires at least: 3.5
Tested up to: 4.8
Stable tag: 1.4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display FAQs in an expandable concertina or accordion section. FAQs can be ordered and categorised, and their appearance can be customised.

== Description ==

**FAQ Concertina** is a plugin for WordPress that enables you to easily display a list of FAQs *(Frequently Asked Questions)* on your page or blog post in an attractive and presentable fashion. 

This is achieved by using the following simple shortcode in your WordPress page or blog post:

	[faq-concertina]

When the list of FAQs appears on your page the answers are initially hidden with only the questions visible. This makes efficient use of the space available on the page and avoids large tracts of text which can be difficult for the reader to take in, especially on small screen devices such as smartphones.

The answer can be made to appear as an expandable section, concertina-style, by clicking on the question. The answer can be hidden again by clicking anywhere on either the question or answer.

With **FAQ Concertina** you can:

* have any number of FAQs,
* define the order in which the FAQs appear on the page,
* determine whether or not more than one answer can be visible at any one time,
* categorise FAQs so that FAQs from different categories can appear in separate lists, either on the same page or on separate pages,
* customise the appearance of the FAQ listing to fit in with the style of your theme.

Although primarily intended for FAQs **FAQ Concertina** is, of course, not limited to just FAQs and can be used for any content with a heading where the content is initially hidden and can be expanded by clicking on the heading. Feel free to use your imagination to come up with all kinds of creative uses for **FAQ Concertina**!

= WHAT'S NEW? = 
* As of version 1.4.0 **FAQ Concertina** is WAI-ARIA compliant. This means that **FAQ Concertina** is fully accessible and compatible with screen readers and other assistive technologies. Thanks to Tim Kaye [@kts915](https://profiles.wordpress.org/kts915) for contributing JavaScript code to make this possible.
* As of version 1.3.0. an option is offered on the Settings page to choose whether one answer or many is visible at a time.
* As of version 1.2.0 the Settings page includes *colorpicker* fields to enable you to choose a custom colour scheme.
* As of version 1.1.2 FAQs are publicly queryable which means that FAQ content now contributes to your SEO.

The **FAQ Concertina** download includes a fully illustrated 19 page manual in `.pdf` format to help you get the most from the plugin. The manual can also be downloaded from the website:

<http://www.zyriab.co.uk/faqconc/>

<http://twitter.com/michaelburridge>

== Installation ==

To install **FAQ Concertina** simply upload the `faq-concertina` directory to the `wp-content/plugins` directory of your WordPress website.

Log-in to the dashboard of your WordPress website and select ‘Plugins’ from the lefthand sidebar. FAQ Concertina should appear in your list of plugins. Click on ‘Activate’ to, err..., activate it!

For a simple FAQ list add this shortcode to your page or post: 

    [faq-concertina]

If you are using categories use this version of the shortcode:  

    [faq-concertina category="category-slug"]

== Frequently Asked Questions ==

= Will FAQ Concertina work with my theme? = 
**FAQ Concertina** is a plugin that works independently from the theme and is theme agnostic. It will work with any theme. Just put the shortcode `[faq-concertina]` in your page or post.

= My theme is responsive, will FAQ Concertina work with it? =
**FAQ Concertina** is fully responsive, and will adapt to the width of the device viewport. Furthermore, the width setting can be over-ridden so that FAQs appear at full width on narrow viewport devices such as smartphones, whatever the width has been set to for larger screens.

= Can I change the appearance of my FAQ listing? =
**FAQ Concertina** includes a settings page which allows you to customise colour schemes, animation speed, width, and other appearance settings.

= What if I don't like the included colour schemes? =
Appearance settings can be disabled so that you can customise the included `.css` file for full control over the appearance of your FAQs. As of version 1.2.0 the settings page also includes *colorpicker* fields to enable you to choose a custom colour scheme.

= Is FAQ Concertina compatible with assistive technologies? =
**FAQ Concertina** is WAI-ARIA compliant and fully accessible. It will work with screen readers and other assistive technologies. Furthermore FAQs can be navigated using the keyboard as well as with the mouse/trackpad.

= Can I decide what order FAQs appear in on my website? =
**FAQ Concertina** provides options on the settings page to order your FAQs alphabetically, chronologically (i.e. by when they were created), or numerically according to the ‘Order’ attribute.

= Can more than one FAQ be open at a time? =
Yes, this is the default behaviour of **FAQ Concertina**. However, if you want the site visitor to only be able to see one answer at a time then, as of version 1.3.0, there is a ‘Hide Others’ option that can be accessed on the Settings page.

= What if I need different FAQs on separate pages? =
**FAQ Concertina** allows you to categorise FAQs and pull FAQs into a specific list using the `category` parameter in the shortcode. See the full `.pdf` manual for complete instructions.

= Can I style different categories of FAQs differently? =
The settings page allows you to define a single appearance for all FAQ listings. However, if you have categorised your FAQs then **FAQ Concertina** adds the category slug as a class allowing you to style different category listings differently in the `.css` file.

= What is the maximum number of FAQs I can have? =
There is no limit to the number of FAQs you can have. Likewise there is no limit to the number of FAQ categories that you can use.

= Does the content of my FAQs contribute to my SEO? =
Yes. As of version 1.1.2 FAQs are publicly queryable which means that the content in the questions and answers can be crawled by search engine spiders. It also means that FAQs can each have their own page addressable by slug.

= Can I embed other shortcodes in my FAQs? =
Yes. As of version 1.4.3 you can include shortcodes as part of your answer. **FAQ Concertina** will ensure that the shortcode is parsed and the generated content included as part of the answer.

= Is FAQ Concertina just for FAQs? =
Although primarily intended for FAQs **FAQ Concertina** is, of course, not limited to just FAQs and can be used for any content with a heading where the content is initially hidden and can be expanded by clicking on the heading.

= Can I translate FAQ Concertina into my language? =
FAQ content can be entered in any language. Furthermore, **FAQ Concertina** is fully internationalised *(i18n)* and a `.pot` file is provided. You can produce localised *(l10n)* `.po` and `.mo` files in your language using a translation tool such as Poedit <http://poedit.net>.

= Where can I find documentation? =
A fully illustrated 19 page .pdf manual is included with each **FAQ Concertina** download, or you can download it directly from <http://www.zyriab.co.uk/faqconc/>.

= What if I don't like FAQ Concertina? =
If you are not happy with **FAQ Concertina** after trying it out you can deactivate it and delete it. **FAQ Concertina** plays nicely with your WordPress installation when it is deleted and cleans up after itself by removing all data and settings leaving no trace of its former existence in your WordPress database. 

== Screenshots ==

1. A list of FAQs as they appear on your site. The colour and appearance can be customised to suite your theme.
2. Click on a question and the answer expands below in a concertina/accordion fashion.
3. More than one answer can be displayed at a time.
4. Answers can be closed by clicking anywhere on the panel.
5. FAQs are managed using a familiar listing in the WordPress dashboard. You can sort on any column for easy management of your FAQs.
6. FAQs are entered and edited using a familiar post entry/edit screen in the WordPress dashboard.
7. The appearance of the FAQs in your site can be configured on the settings page.

== Changelog ==

= 1.4.3 =
Added the category to the ID. If more than one category of FAQs is included in a single page or post HTML validators will no longer produce a Duplicate ID error.
Removed the <strong>..</strong> tags around the question. If the question is required in bold text style .faq_q in css/faq-concertina-styles.css.
Added support for shortcodes in the answers. The shortcode will be parsed and the generated content included as part of the answer.

= 1.4.2 =
Ensured that all text strings are translation ready, and updated .pot file.

= 1.4.1 =
Fixed bug that prevented access to more than one FAQ category on a page when navigating with the keyboard or assistive technologies - with thanks to Tim Kaye for this fix.

= 1.4.0 =
WAI-ARIA compliance added for accessibility (with thanks to Tim Kaye for JavaScript contributions)

= 1.3.2 =
Rewrite of JavaScript file that fixes a bug which caused show/hide indicators to behave inconsistently.

= 1.3.1 =
Fixed bug that prevented links in answers from opening.

= 1.3.0 =
Added an option to the Settings page to hide the previously opened answer when a new answer is opened, i.e. the option to have only one answer visible at a time.

= 1.2.3 = 
Minor code tweaks. Confirmed compatibility with Wordpress 4.5.

= 1.2.2 =
Fixed a bug that would load styles if the text 'faq-concertina' appeared in a page or post even if it wasn't a shortcode.

= 1.2.1 =
Minor code tweaks.

= 1.2.0 =
Added *colorpicker* fields to Settings page for custom colour selection.

= 1.1.3 = 
Fixed bugs (i) Undefined variable: faq_css (ii) Trying to get property of non-object

= 1.1.2 = 
FAQs are now publicly queryable - FAQ content now counts toward SEO. Category column in list view is now sortable.

= 1.1.1 =
Fixed problem with images

= 1.1 =
Added user-requested features: 
 i. The option to order the FAQs alphabetically, chronologically, or numerically.
ii. The option to add show/hide indicators to the questions.

= 1.0.2 =
Changed i18n text domain. 
Removed extraneous duplication of files caused by SVN error.

= 1.0.1 =
Updates to .pot file and to .pdf manual.

= 1.0 =
Initial release.

== Upgrade Notice ==

= 1.4.3 =
Added the category to the ID. If more than one category of FAQs is included in a single page or post HTML validators will no longer produce a Duplicate ID error.
Removed the <strong>..</strong> tags around the question. If the question is required in bold text style .faq_q in css/faq-concertina-styles.css.
Added support for shortcodes in the answers. The shortcode will be parsed and the generated content included as part of the answer.

= 1.4.2 =
Ensured that all text strings are translation ready, and updated .pot file.

= 1.4.1 =
Fixed bug that prevented access to more than one FAQ category on a page when navigating with the keyboard or assistive technologies - with thanks to Tim Kaye for this fix.

= 1.4.0 =
WAI-ARIA compliance added for accessibility (with thanks to Tim Kaye for JavaScript contributions)

= 1.3.2 =
Rewrite of JavaScript file (faq-concertina-script.js) that fixes a bug which caused show/hide indicators to behave inconsistently.

= 1.3.1 =
Fixed bug that prevented links in answers from opening.

= 1.3.0 =
Added an option to the Settings page to hide the previously opened answer when a new answer is opened, i.e. the option to have only one answer visible at a time.

= 1.2.3 = 
Minor code tweaks. Confirmed compatibility with Wordpress 4.5.

= 1.2.2 =
Fixed a bug that would load styles if the text 'faq-concertina' appeared in a page or post even if it wasn't a shortcode.

= 1.2.1 =
Minor code tweaks.

= 1.2.0 =
Added *colorpicker* fields to Settings page for custom colour selection.

= 1.1.3 = 
Bug fixes.

= 1.1.2 = 
FAQs are now publicly queryable - FAQ content now counts toward SEO. Category column in list view is now sortable.

= 1.1.1 =
The following user-requested features have been added: (i.) The option to order the FAQs alphabetically, chronologically, or numerically; (ii.) The option to add show/hide indicators to the questions. NOTE: if you have customised faq-concertina-styles.css make a backup of it before updating, otherwise it will be overwritten!

= 1.1 =
The following user-requested features have been added: 
 i. The option to order the FAQs alphabetically, chronologically, or numerically.
ii. The option to add show/hide indicators to the questions.
NOTE: if you have customised faq-concertina-styles.css make a backup of it before updating, otherwise it will be overwritten! 

= 1.0.2 =
Changed i18n text domain. 
Removed extraneous duplication of files caused by SVN error.
NOTE: if you have customised faq-concertina-styles.css make a backup of it before updating, otherwise it will be overwritten! 

= 1.0.1 =
Updates to .pot file and to .pdf manual.

= 1.0 =
Initial release.