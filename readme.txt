=== BNS Corner Logo ===
Contributors: cais
Donate link: http://buynowshop.com/
Tags: image, logo, multiple widgets, gravatar
Requires at least: 2.8
Tested up to: 2.9
Stable tag: 1.2.2

Widget to display a logo; or, used as a plugin displays image fixed in one of the four corners.

== Description ==

Widget to display a user selected image as a logo; or, used as a plugin that displays the image fixed in one of the four corners of the display.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `bns-corner-logo.php` to the `/wp-content/plugins/` directory.
2. Activate through the 'Plugins' menu.
3. Place the BNS Corner Logo widget appropriately in the Appearance | Widgets section of the dashboard.
4. Enter the Title for the widget area if you do not want to use the default "My Logo Image"
5. Enter the complete URL to the image, including the `http://`; Optional: Enter `ALT` text for the image; Enter the URL for the image to link to, the "default" URL will be the page the image appears on.
6. Optional: Check the box to use the default admin (user-ID 1) gravatar; change the default gravatar display size (in pixels)
7. Click "Save"

-- or -

1. Go to 'Plugins' menu under your Dashboard
2. Click on the 'Add New' link
3. Search for bns-featured-category
4. Install.
5. Activate through the 'Plugins' menu.
6. Place the BNS Corner Logo widget appropriately in the Appearance | Widgets section of the dashboard.
7. Enter the Title for the widget area if you do not want to use the default "My Logo Image"
8. Enter the complete URL to the image, including the `http://`; Optional: Enter `ALT` text for the image; Enter the URL for the image to link to, the "default" URL destination will be "_self" (the page the image appears on).
9. Optional: Check the box to use the default admin (user-ID 1) gravatar; change the default gravatar display size (in pixels)
10. Click "Save"

* To use like a "fixed position" plugin:
1. Use the checkbox beside "Use like a Plugin?"
2. Choose the corner of the display from the dropdown box.
3. Click "Save"

NB: This plugin will not resize your images, please make sure you use an appropriate sized image for the area you are placing it in. For the "fixed position" it is strongly recommended to use an image that is at least partially transparent for those readers with smaller screens.

== Frequently Asked Questions ==

= Can I use this in more than one widget area? =

Yes, this plugin has been made for multi-widget compatibility. Each instance of the widget will display, if wanted, differently than every other instance of the widget.

== Screenshots ==

1. The Options Panel.
2. A sample logo image in the sidebar widget area of the [Shades](http://wordpress.org/extend/themes/shades/) theme.
3. An image in the sidebar and an image "fixed" in the bottom-right corner showing multiple instances of the widget.

== Changelog ==
= 1.2.2 =
* addressed a few minor Gravatar display issues
* stopped "ALT" text from displaying when using the Gravatar option
* addressed image borders around the Gravatar image with CSS

= 1.2.1 =
* corrected issue with plugin selection drop-down list, it now maintains the option chosen as the displayed value
* updated installation instructions to reflect addition of Gravatar support

= 1.2 =
* completed Gravatar implementaion - displays Gravatar associated with user-ID 1 (main administrator)
* added plugin specific style sheet (required by Gravatar implementation)
* noted suggested maximum pixel size of Gravatar but no restrictions set
* updated screenshot of option panel

= 1.1.1 =
* compatibility check for WP2.9 completed
* increased the width of the option panel
* beginning of code to implement gravatars included (but not complete or visually apparent)

= 1.1 =
* added version checking using $wp_version
* improved readability of code

= 1.0.1 =
* code clean up and error trapping
* minor improvement in IE6 compatibility

= 1.0 =
* Initial Release