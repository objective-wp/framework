<?php
namespace ObjectiveWP\Framework\Enqueue;

use ObjectiveWP\Framework\Contracts\Hooks\CanHandle;

/**
 * Class Enqueue
 *
 * @package ObjectiveWP\EnfoldChild\Enqueues
 */
abstract class EnqueueHook implements CanHandle
{
    /**
     * Enqueue scripts or styles.
     *
     * @param array ...$args The arguments passed
     * @return void
     */
   public abstract function handle(...$args);

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
    protected function enqueueScript($handle, $src = '', $deps = array(), $ver = false, $in_footer = false)
    {
        wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
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
    protected function enqueueStyle($handle, $src = '', $deps = array(), $ver = false, $media = 'all')
    {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
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
    protected function addInlineScript($handle, $data, $position = 'after' )
    {
        wp_add_inline_script($handle, $data, $position);
    }

    /**
     * Inserts an inline script into the head
     * @param string $handle Name of the script. Should be unique.
     * @param string $content The javascript to be added
     */
    protected function enqueueInlineScript(string $handle, string $content) {
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
     */
    protected function enqueueInlineStyle(string $handle, string &$content) {
        add_action('wp_print_styles', function() use (&$content, $handle) {
            ?>
            <style id="<?php echo $handle ?>-css" type="text/css" >
                <?php echo $content ?>
            </style>
            <?php
        });
    }


}