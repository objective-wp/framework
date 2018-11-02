<?php

namespace ObjectiveWP\Framework\Enqueue;

/**
 * Class EnqueueManager
 * @package ObjectiveWP\Framework\Enqueue
 */
class EnqueueManager
{

    /**
     *Enqueue a javascript
     *
     * @param string           $handle    Name of the script. Should be unique.
     * @param string           $src       Path of the script relative to the WordPress root directory.
     * @param array            $deps      Optional. An array of registered script handles this script
     *                                    depends on. Default empty array.
     * @param string|bool|null $ver       Optional. String specifying script version number,
     *                                    if it has one, which is added to the URL
     *                                    as a query string for cache busting purposes.
     *                                    If version is set to false, a version
     *                                    number is automatically added equal to current
     *                                    installed WordPress version.
     *                                    If set to null, no version is added.
     * @param bool             $in_footer Optional. Whether to enqueue the script before
     *                                    </body> instead of in the <head>.
     *                                    Default 'false'.
     */
    public function enqueueScript($handle, $src = '', $deps = array(), $ver = false, $in_footer = false)
    {
        wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
    }

    /**
     * Register a new script.
     *
     * Registers a script to be enqueued later using the wp_enqueue_script() function.
     *
     * @see WP_Dependencies::add()
     * @see WP_Dependencies::add_data()
     *
     * @since 2.1.0
     * @since 4.3.0 A return value was added.
     *
     * @param string           $handle    Name of the script. Should be unique.
     * @param string           $src       Full URL of the script, or path of the script relative to the WordPress root directory.
     * @param array            $deps      Optional. An array of registered script handles this script depends on. Default empty array.
     * @param string|bool|null $ver       Optional. String specifying script version number, if it has one, which is added to the URL
     *                                    as a query string for cache busting purposes. If version is set to false, a version
     *                                    number is automatically added equal to current installed WordPress version.
     *                                    If set to null, no version is added.
     * @param bool             $in_footer Optional. Whether to enqueue the script before </body> instead of in the <head>.
     *                                    Default 'false'.
     * @return bool Whether the script has been registered. True on success, false on failure.
     */
    public function registerScript($handle, $src, $deps = array(), $ver = false, $in_footer = false) {
       return wp_register_script($handle, $src, $deps, $ver, $in_footer);
    }

    /**
     * Remove a registered script.
     *
     * Note: there are intentional safeguards in place to prevent critical admin scripts,
     * such as jQuery core, from being unregistered.
     *
     * @see WP_Dependencies::remove()
     *
     * @since 2.1.0
     *
     * @param string $handle Name of the script to be removed.
     */
    public function deregisterScript($handle) {
        wp_deregister_script($handle);
    }

    /**
     * Remove a previously enqueued script.
     *
     * @see WP_Dependencies::dequeue()
     *
     * @since 3.1.0
     *
     * @param string $handle Name of the script to be removed.
     */
    public function dequeueScript($handle) {
        wp_dequeue_script($handle);
    }

    /**
     * Enqueue a CSS stylesheet.
     *
     * @param string           $handle Name of the stylesheet. Should be unique.
     * @param string           $src    Full URL of the stylesheet, or path of the
     *                                 stylesheet relative to the WordPress root directory. Default empty.
     * @param array            $deps   Optional. An array of registered stylesheet
     * handles this stylesheet depends on. Default empty array.
     * @param string|bool|null $ver    Optional. String specifying stylesheet version number,
     *                                 if it has one, which is added to the URL
     *                                 as a query string for cache busting purposes.
     *                                 If version is set to false, a version
     *                                 number is automatically added equal to
     *                                 current installed WordPress version.
     *                                 If set to null, no version is added.
     * @param string           $media  Optional. The media for which this stylesheet
     *                                 has been defined.
     *                                 Default 'all'. Accepts media types like 'all', 'print'
     *                                 and 'screen', or media queries like
     *                                 '(orientation: portrait)' and '(max-width: 640px)'.
     */
    public function enqueueStyle($handle, $src = '', $deps = array(), $ver = false, $media = 'all')
    {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }

    /**
     * Remove a registered stylesheet.
     *
     * @see WP_Dependencies::remove()
     *
     * @since 2.1.0
     *
     * @param string $handle Name of the stylesheet to be removed.
     */
    public function deregisterStyle(string $handle) {
        wp_deregister_style($handle);
    }

    /**
     * Remove a previously enqueued CSS stylesheet.
     *
     * @see WP_Dependencies::dequeue()
     *
     * @since 3.1.0
     *
     * @param string $handle Name of the stylesheet to be removed.
     */
    public function dequeueStyle($handle) {
        wp_dequeue_style($handle);
    }

    /**
     * Register a CSS stylesheet.
     *
     * @see WP_Dependencies::add()
     * @link https://www.w3.org/TR/CSS2/media.html#media-types List of CSS media types.
     *
     * @since 2.6.0
     * @since 4.3.0 A return value was added.
     *
     * @param string           $handle Name of the stylesheet. Should be unique.
     * @param string           $src    Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
     * @param array            $deps   Optional. An array of registered stylesheet handles this stylesheet depends on. Default empty array.
     * @param string|bool|null $ver    Optional. String specifying stylesheet version number, if it has one, which is added to the URL
     *                                 as a query string for cache busting purposes. If version is set to false, a version
     *                                 number is automatically added equal to current installed WordPress version.
     *                                 If set to null, no version is added.
     * @param string           $media  Optional. The media for which this stylesheet has been defined.
     *                                 Default 'all'. Accepts media types like 'all', 'print' and 'screen', or media queries like
     *                                 '(orientation: portrait)' and '(max-width: 640px)'.
     * @return bool Whether the style has been registered. True on success, false on failure.
     */
    public function registerStyle($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {
        return wp_register_style($handle, $src, $deps, $ver, $media);
    }



    /**
     * Adds extra code to a registered script.
     *
     * Code will only be added if the script in already in the queue.
     * Accepts a string $data containing the Code. If two or more code blocks
     * are added to the same script $handle, they will be printed in the order
     * they were added, i.e. the latter added code can redeclare the previous.
     *
     * @since 4.5.0
     *
     * @see WP_Scripts::add_inline_script()
     *
     * @param string $handle   Name of the script to add the inline script to.
     * @param string $data     String containing the javascript to be added.
     * @param string $position Optional. Whether to add the inline script before the handle
     *                         or after. Default 'after'.
     * @return bool True on success, false on failure.
     */
    public function addInlineScript($handle, $data, $position = 'after' )
    {
        return wp_add_inline_script($handle, $data, $position);
    }

    /**
     * Inserts an inline script into the head
     * @param string $handle Name of the script. Should be unique.
     * @param string $content The javascript to be added
     */
    public function enqueueInlineScript(string $handle, string $content) {
        add_action('wp_print_scripts', function() use ($content, $handle) {
            ?>
            <script id="<?php echo $handle ?>-js" type="text/javascript" >
                <?php echo $content ?>
            </script>
            <?php
        });
    }

    /**
     * Inserts an inline style into the head
     * @param string $handle Name of the stylesheet. Should be unique.
     * @param string $content The css to be added
     * @param int $priority
     */
    public function enqueueInlineStyle(string $handle, string &$content, int $priority = 10) {
        add_action('wp_print_styles', function() use (&$content, $handle) {
            ?>
            <style id="<?php echo $handle ?>-css" type="text/css" >
                <?php echo $content ?>
            </style>
            <?php
        }, $priority);
    }
}