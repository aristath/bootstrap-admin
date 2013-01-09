=== Bootstrap Admin ===
Contributors: aristath, fovoc
Donate link: http://aristeides.com/bootstrap-admin
Tags: administration, administration theme, admin theme, dashboard, bootstrap
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1.12
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A clean, minimalistic administration theme based on Twitter's Bootstrap

== Description ==

A clean, minimalistic administration theme implementing Twitter's Bootstrap.
Project was built by http://shoestrap.org

You can contribute by helping out in github: https://github.com/aristath/bootstrap-admin

This plugin will completely re-style your WordPress admin area, offering a cleaner experience.
We 've included theming for most of the things that we could think of.
If however you find something missing, don't hesitate to tell us about it @ http://bootstrap-commerce.com/forums/forum/bootstrap-admin/
We welcome all suggestions!

We 've included icons for all core menus as well as a few extras, but if you find yourself wanting more, you can make a suggestion at the link mentioned above.

If you like this plugin and use it on your projects, please consider donating @ http://aristeides.com 

== Installation ==

Just copy to your plugins folder and activate (or Network activate) it.

Styling is done using less. This Plugin includes phpless http://leafo.net/lessphp/ 
If you want to use less when theming this plugin, you should open the `includes/config.php` file and
change this line

`define('BOOTSTRAP_ADMIN_LESS_MODE', '0');`

from '0' to '1'. 
This will tell the less preprocessor to re-compile the stylesheet 
every time a change is detected on our less file.
When you're done theming, please change it back to '0' to speed-up your admin section.
(though it's not resources-heavy, phpless is still one more script that runs).
If you are not theming using less, keep this option to '0'.

To enable chosen js, you can change
`define('BOOTSTRAP_ADMIN_CHOSEN_JS', '0');'
from '0' to '1'.

== Screenshots ==

1. The Dashboard with the submenu popovers visible
2. New Post screenshot


== Changelog ==

= 1.12 =
* Updated the [Elusive-Icons](http://aristath.github.com/elusive-iconfont/) webfont
* Bugfixes

= 1.11 =
* Fixes the remove tags symbol on the posts editing page

= 1.10 =
* Replacing [Font-Awesome](http://fortawesome.github.com/Font-Awesome/) with [Elusive-Icons](http://aristath.github.com/elusive-iconfont/) due to [licencing issues](http://make.wordpress.org/plugins/2012/12/20/gpl-and-the-repository/)
* Added menu icon for [easy-digital-downloads](http://wordpress.org/extend/plugins/easy-digital-downloads/)
* Fixed conflict with the [WPMU DEV Dashboard](http://premium.wpmudev.org/project/wpmu-dev-dashboard/) plugin

= 1.05 =
* Better styling for buttons
* override WordPress's wp_default_styles function
* tags as labels
* set featured image link as large button
* the "add new category" link is now a button
* fixes thumbnails in media browser

= 1.03 =
* Supports collapsed mode
* Added icons for bbpress

= 1.02 =
* Bugfixes

= 1.0 =
* CAUTION: ONLY UPDATE TO 1.0 IF YOU ARE USING WORDPRESS 3.5 AND ABOVE
* Bugfixes
* Compatibility with WordPress 3.5
* Moved icons from jquery to css implementation
* The width of the admin menu is now identical to the one in WordPress core
* Less obstrusive

= 0.5 =
* The left menu is now 150px wide, close to the original wordpress menu width (narrower than on the previous version)
* Labels are now inline-blocks instead of blocks
* Using the [Awesome Font](http://fortawesome.github.com/Font-Awesome/) for icons
* Other minor bugfixes

= 0.3 =
* Minor bug fixes
* Chosen.js is now disabled by default. This can be changed in the `includes/config.php` file.

= 0.2.2 =
* Implemented [chosen js](http://harvesthq.github.com/chosen/ "chosen js")

= 0.2.1 =
* Bugfix. Some users reported css was not being applied on 0.2

= 0.2 =
* Implementing phpless and re-styling everything using less.

= 0.1.2 =
* Lots of styling
* ProSites "hacks"
* MarketPress "hacks"

= 0.1.1 =
* Small styling bugfixes

= 0.1 =
* First version
