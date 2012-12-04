=== Bootstrap Admin ===
Contributors: aristath
Donate link: http://aristeides.com/bootstrap-admin
Tags: administration, administration theme, admin theme, dashboard, bootstrap
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A clean, minimalistic administration theme based on Twitter's Bootstrap

== Description ==

A clean, minimalistic administration theme implementing Twitter's Bootstrap.
If you want to learn more about bootstrap go ahead and take a look here: http://twitter.github.com/bootstrap

This project was built by http://shoestrap.org

This plugin includes:

* General styling of the wordpress admin area
* Admin menu sub-menus as bootstrap popovers (they're actually very beautiful!)
* Bootstrap Icons for a lot of things (using a bootstrap icon font)
* Default WordPress forms theming
* Buttons theming
* Postboxes theming
* Includes WPMUdev Pro-Sites optimizations
* Includes WPMUdev MarketPress optimizations
* Even more, and a lot more on the way!
* Styling is done using LESS.
* Implements [chosen js](http://harvesthq.github.com/chosen/ "chosen js")

Note: chosen.js is disabled by default. To enable it, open the 'includes/config.php' file and set
`define('BOOTSTRAP_ADMIN_CHOSEN_JS', '1');'
from '1' to '0'.


If you like it and use it on your projects, please consider donating @ http://aristeides.com 

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

1. Fresh wordpress installation with the bootstrap admin enabled
2. The submenu popovers


== Changelog ==

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