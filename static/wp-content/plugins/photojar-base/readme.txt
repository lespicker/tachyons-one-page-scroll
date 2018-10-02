=== Plugin Name ===
Contributors: jarinteractive
Donate link: http://www.jarinteractive.com/code/photojar
Tags: gallery, images, photo, album, lightbox, thickbox, slimbox, shadowbox, exclude, limit, cache, image, columns, thumbnail, resize, photoJAR, JPEG quality
Requires at least: 2.5.1
Tested up to: 2.7 RC1
Stable tag: 1.1

PhotoJAR: Base provides numerous enhancements to the Wordpress gallery and provides a framework for additional PhotoJAR plugins.

== Description ==

PhotoJAR: Base features include:

    * Dynamic resizing and caching of thumbnails - changes to image sizes apply retroactively
    * Support for LightBox, ThickBox, ShadowBox JS, etc.
    * Custom image sizes (beyond "thumbnail" and "medium") - [gallery size="150x200"]
    * Displays gallery of galleries (thumbnails of child galleries) - [gallery showchildren=true]
    * A "linkto" parameter for galleries and images ("viewer", "default", "full", or "none") - [gallery linkto="viewer"]
    * A JPEG quality setting
    * A maximum size setting for full-size images
    * A default gallery columns setting
    * An [image] shortcode.
    * NEW! Limit number of images displayed in a gallery - [gallery offset="3" limit="20"]
    * NEW! Exclude images from a gallery - [gallery exclude="14,65,21"]

For additional info visit [JARinteractive](http://www.jarinteractive.com/code/photojar).

== Installation ==

This section describes how to install the plugin and get it working.
Requires PHP5.

1. Upload the `pj-base` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Adjust settings under the 'Settings -> PhotoJAR' menu in Wordpress.
4. Optional: Install a javascript viewer plugin (Ex: [Lightbox](http://stimuli.ca/lightbox/), [ThickBox](http://mezzomondo.nelblog.it/2007/05/28/thickbox3/), etc.) 
	if you want to make use of that feature.  PhotoJAR: Base will handle the markup to enable this on your images.

== Frequently Asked Questions ==

= What other PhotoJAR plugins are available? =

Current PhotoJAR plugins are listed at the [PhotoJAR webpage](http://www.jarinteractive.com/code/photojar/).  

PhotoJAR: Post Thumbnailer - displays single thumbnails on the blog for each post 
containing a gallery.  It can also display the full gallery in a javascript viewer.  Watch the [JARinteractive Blog](http://www.jarinteractive.com)
for additional PhotoJAR plugins.

= the PhotoJAR cache directory is missing, what do I do? =

Create the directory specified in the error message, and ensure that Wordpress has permission to write in it.

= What if I find a bug? =

Please contact me via the [PhotoJAR website](http://www.jarinteractive.com/code/photojar).  
Include the version of Wordpress you are using, current PhotoJAR settings, and details to recreate the bug if possible.

== Screenshots ==

1. PhotoJAR integrated with Lightbox as seen at http://www.jarinteractive.com
2. PhotoJAR Settings
3. PhotoJAR Advanced Settings
4. Example post creating a gallery and a single image