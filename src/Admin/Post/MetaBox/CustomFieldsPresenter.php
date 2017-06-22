<?php
namespace ObjectiveWP\Framework\Admin\Post\MetaBox;

use WP_Post;

/**
 * Class CustomFieldsPresenter
 * @package LouisvilleGeek\MapLocations\Meta
 */
class CustomFieldsPresenter
{

    /**
     * Presents the custom fields as html
     * @param string $prefix
     * @param array $customFields
     * @param WP_Post $post
     */
    public function present($prefix, $customFields, $post) {
        ?>
        <div class="form-wrap">
            <?php
            wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
            foreach ( $customFields as $customField ) {
                // Check scope
                $scope = $customField[ 'scope' ];
                $output = false;
                foreach ( $scope as $scopeItem ) {
                    switch ( $scopeItem ) {
                        default: {
                            if ( $post->post_type == $scopeItem )
                                $output = true;
                            break;
                        }
                    }
                    if ( $output ) break;
                }
                // Check capability
                if ( !current_user_can( $customField['capability'], $post->ID ) )
                    $output = false;
                // Output if allowed
                if ( $output ) { ?>
                    <div class="form-field form-required">
                        <?php
                        switch ( $customField[ 'type' ] ) {
                            case "checkbox": {
                                $this->outputCheckBox($post, $prefix, $customField);
                                break;
                            }
                            case "textarea":
                            case "wysiwyg": {
                                $this->outputTextAreaOrWysiwyg($post, $prefix, $customField);
                                break;
                            }
                            case "datepicker": {
                                $this->outputDatePicker($post, $prefix, $customField);
                                break;
                            }
                            default: {
                                $this->outputDefault($post, $prefix, $customField);
                                break;
                            }
                        }
                        if ( $customField[ 'description' ] )
                            echo '<p>' . $customField[ 'description' ] . '</p>';
                        ?>
                    </div>
                    <?php
                }
            } ?>
        </div>
        <?php
    }


    protected function outputDatePicker($post, $prefix, $customField) {
        $class = "";
        if(isset($customField[ 'class' ]))
            $class = $customField[ 'class' ];
        // Plain text field
        echo '<label for="' . $prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
        echo '<input type="text" class="' . $class . ' datepicker" name="' . $prefix . $customField[ 'name' ] . '" id="' . $prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $prefix . $customField[ 'name' ], true ) ) . '" />';
    }

    protected function outputCheckBox($post, $prefix, $customField) {
        // Checkbox
        echo '<label for="' . $prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
        echo '<input type="checkbox" name="' . $prefix . $customField['name'] . '" id="' . $prefix . $customField['name'] . '" value="yes"';
        if ( get_post_meta( $post->ID, $prefix . $customField['name'], true ) == "yes" )
            echo ' checked="checked"';
        echo '" style="width: auto;" />';

    }



    protected function outputTextAreaOrWysiwyg($post, $prefix, $customField) {
        // Text area
        echo '<label for="' . $prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
        echo '<textarea name="' . $prefix . $customField[ 'name' ] . '" id="' . $prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $prefix . $customField[ 'name' ], true ) ) . '</textarea>';
        // WYSIWYG
        if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
            <script type="text/javascript">
                jQuery( document ).ready( function() {
                    jQuery( "<?php echo $prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
                    if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
                        tinyMCE.execCommand( "mceAddControl", false, "<?php echo $prefix . $customField[ 'name' ]; ?>" );
                    }
                });
            </script>
        <?php }
    }

    protected function outputDefault($post, $prefix, $customField) {
        $class = "";
        if(isset($customField[ 'class' ]))
            $class = $customField[ 'class' ];
        // Plain text field
        if($customField[ 'type' ] != 'hidden')
            echo '<label for="' . $prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
        echo '<input type="' . $customField[ 'type' ] . '" class="' . $class . '" name="' . $prefix . $customField[ 'name' ] . '" id="' . $prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $prefix . $customField[ 'name' ], true ) ) . '" />';
    }
}