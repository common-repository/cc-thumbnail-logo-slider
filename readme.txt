=== CC Thumbnail Logo Slider ===
Contributors: Codecygnus
Tags: thumbnail slider, logo slider, thumbnail logo slider, responsive slider, image slider, image slideshow, jQuery slider, jQuery slideshow, Photo Slider, wp slider, thumbnail slider in header, slider in footer, widget slider, header logo slider, slider, home page slider, slider,
Donate link: http://www.codecygnus.com/donate
Requires at least: 3.3
Tested up to: 4.6.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CC Thumbnail Logo Slider is a compatible responsive Jquery slider. Use the given shortcode to get the slider or the given php code anywhere on your template.

== Description ==

[CC Thumbnail Logo Slider] (http://www.codecygnus.com/ccslider) is a responsive javascript slider of [slick carousel by Ken Wheeler](http://kenwheeler.github.io/slick/) can be easily integrated into Wordpress. You can add the sliders anywhere at your website. In header, footer, in widgets, in pages and so on. If you are a basic developer you need the php code to insert into the template or just you need to add shortcode in pages where you need. For plugin settings you need to go admin section of the wordpress. Easy way to add images in media library and select the slider image on the plugin settings. At the free version you can edit the some range of settings such as Speed, Height, width, arrows, images to show etc. In this version slider you can create your sliders for more option go for the pro pack. start creating your awesome sliders with CC Thumbnail Logo Slider.

== Features ==
*	Simple and light weight
*	Fully responsive
*	Nice selection of arrow icons
*	Easy to customise (height, width, speed etc)
*	Easy image uploader
*	Auto-slide option
*      Add your slider in Header, footer or anywhere

== How to use CC Slider ==

To add the logo or Thumbnail slider in pages or widgets use this shortcode:
add the below shortcode and preview your slider:

[CC-slider]

To add the logo or thumbnail slider in header and footer:
add the below code in your template: Appearance —> Editor —>header.php or footer.php—> The place you need.

<?php echo do_shortcode('[CC-slider]'); ?>

== Installation ==

1. Upload the `CC-Slider` folder to the `/wp-content/plugins/` directory
2. Activate CC Thumbnail Logo Slider plugin through the 'Plugins' menu in WordPress
3. Configure the plugin by going to the `CC Slider` tab that appears in your admin menu.
4. Add to any page using shortcode `[CC-slider]` or to your theme using `<?php echo do_shortcode('[CC-slider]'); ?>`

== Frequently Asked Questions ==

1. How can I use this in a widget?

Just place the shortcode into a text widget. If that doesn't work (it just renders [CC-slider] in text) then that means your theme isn't 'widgetized' which you can fix easily by adding 1 tiny piece of code to your theme functions.php:

<?php `add_filter('widget_text', 'do_shortcode');` ?>

Add this code above to functions.php. A good place would be either at the very top or the very bottom of the file. Now the slider will show in your widgets.

2. Can I add multiple slideshow?

This Free version allows you 1 slider. If you need multiple sliders [get Pro version here](http://codecygnus.com).

3. Where can I get support?

If you've tried all the obvious stuff and it's still not working please request support via the forum.

== Screenshots ==

1. Demo Thumbnail Slider in slide view.
2. Demo Slider in header and footer.
2. Setting options in Administration panel.

== Changelog ==

= 1.0.0 =
First release