=== NutsForPress Indexing and SEO ===

Contributors: Christian Gatti
Tags: NutsForPress,SEO,Open Graph,title,description,Twitter Card,noindex,sitemap,analytics,head,script
Donate link: https://www.paypal.com/paypalme/ChristianGatti
Requires at least: 5.3
Tested up to: 6.5
Requires PHP: 7.0.0
Stable tag: 2.3
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

NutsForPress Indexing and SEO a simple and lightweight plugin that improves your site indexing and helps you in your search engine optimization.


== Description ==

*Indexing and SEO* is one of the several NutsForPress plugins providing some essential features that WordPress does not offer itself or offers only partially.

*Indexing and SEO* allows you to:

* define a title and a description for SEO purpose: fill them into every post and page to find them into search engines snippets
* enhance sharing of your content in social networks: featured image, title and description are used every time you share contents from your website, thanks to the Facebook Open Graph and the Twitter Card tags automatically added to your post and pages
* set a backup image to be used for sharing pages and posts that lack of featured image
* replace WordPress sitemap with a better one, customizable, automatically generated and including also links to pages and posts translated with WPML
* set "noindex" to pages and posts that you do not want to be indexed
* get automatically filled in the "description", the "caption" and the "alt title" of any uploaded attachment file 
* bulk rebuild "description", "caption" and "alt title" for all the attachment files
* add Analytics script and other scripts to head, footer or body and prevent from loading them when a logged in admin is browsing the website

Indexing and SEO is full compliant with WPML (you don't need to translate any option value)

Take a look at the others [NutsForPress Plugins](https://wordpress.org/plugins/search/nutsforpress/)

**Whatever is worth doing at all is worth doing well**


== Installation ==

= Installation From Plugin Repository =

* Into your WordPress plugin section, press "Add New"
* Use "NutsForPress" as search term
* Click on *Install Now* on *NutsForPress Indexing and SEO* into result page, then click on *Activate*
* Setup "NutsForPress Indexing and SEO" options by clicking on the link you find under the "NutsForPress" menu
* Enjoy!

= Manual Installation =

* Download *NutsForPress Indexing and SEO* from https://wordpress.org/plugins/nutsforpress
* Into your WordPress plugin section, press "Add New" then press "Load Plugin"
* Choose nutsforpress-smtp-mail.zip file from your local download folder
* Press "Install Now"
* Activate *NutsForPress Indexing and SEO*
* Setup "NutsForPress Indexing and SEO" options by clicking on the link you find under the "NutsForPress" menu
* Enjoy!


== Changelog ==

= 2.3 =
* Fixed a bug that prevented some WPML translated pages to be included into the sitemap

= 2.2 =
* Fixed a bug that prevented "Skip empty terms" options to be effective into sitemap

= 2.1 =
* Fixed a bug that caused pages into sitemap to be duplicated when WPML was active and running
* Fixed a bug that caused (product) categories not to display the description meta tag

= 2.0 =
* Fixed a bug that prevented pages and post created before the installation of NutsForPress Indexing and SEO from being added to the sitemap

= 1.9 =
* Removed the function added with the release 1.3.3 (global style unqueued) since caused problems to WordPress 6.4

= 1.8 =
* Fixed a bug that caused the no-index pages to be added to the sitemap
* Fixed a bug that caused some custom post types (public, but not publicly querable or to be excluded from the search) to be added to the sitemap

= 1.7 =
* Fixed a bug that caused the reset of the options of this plugin when WPML was installed and activated after the configuration of this plugin
* Now, when the website home page matches the blog home page, the title tag value is taken fro the website name and the description meta tag value is taken from the website description, as they are entered in the WordPress options 

= 1.6 =
* Tested up to WordPress 6.2

= 1.5 =
* Fixed a bug the caused the title and the description of the WooCommerce shop page to not being trated correctly

= 1.4 =
* Now translations are provided by translate.wordpress.org, instead of being locally provided: please contribute!

= 1.3.4 =
* Now you can add custom scripts to body and to footer too

= 1.3.3 =
* Now you can prevent from being enqueued: basic WordPress scripts and styles, like emoji, global style and the block editor main style 

= 1.3.2 =
* Preventing 'jet-menu' (the jet elements mega menu post type) from being added to sitemap

= 1.3.1 =
* The "Replace Sitemap" function now has some interesting options, useful to build a more complete and, at the same time, more accurate sitemap

= 1.3 =
* The SEO functions of "NutsForPress Images and Media", plugin that will be soon dismissed, are now included into "NutsForPress Indexing and SEO"

= 1.2.3 =
* Now you can skip the add of the custom scripts into the head when an admin is logged in (useful as an Analytics filter)

= 1.2.2 =
* Fixed a bug that displayed some option messages that should have been kept hidden by a css rule miswritten by an escape rule

= 1.2.1 =
* Fixed a bug that caused to some urls contained into some descriptions in the plugin options were showed as html code, instead of clickable urls 

= 1.2 =
* New root version, in order to welcome a new NutsForPress plugin
* Security improved by escaping echoed variables

= 1.1.5 =
* Added a small style rule to prevent title and description column to be squeezed in WooCommerce product table, on small screens 

= 1.1.4 =
* Fixed a bug that prevented from saving local options when WPML is not active

= 1.1.3 =
* Fixed a bug that prevented sitemap to be acquired, due to a wrong 404 header

= 1.1.2 =
* Fixed a bug that prevented backup featured image to be used into sharing tags (Facebook Open Graph and Twitter Image)

= 1.1.1 =
* Now you can add Analytics script and other head scripts

= 1.1 =
* Just a small style enhancement and some minor bug fix

= 1.0 =
* First full working release


== Translations ==

* English: default language
* Italian: entirely translated


== Credits ==

* Very many thanks to [DkR](https://www.dkr.srl/) and [SviluppoEuropa](https://www.sviluppoeuropa.it/)!