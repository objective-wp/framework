<?php
namespace ObjectiveWP\Framework\Admin\Post\MetaBox;

abstract class MetaBox
{

    public function setPresenter(CustomFieldsPresenter $presenter) {
        $this->presenter = $presenter;
    }

    protected $presenter;

    protected $removeDefaults = false;
    /** @var string $id The id of the Meta Box */
    protected $id = 'my-custom-fields';
    /** @var string $name The name of the Meta Box */
    protected $name = 'Edit';
    /**
     * @var  string  $prefix  The prefix for storing custom fields in the postmeta table
     */
    protected $prefix = '';

    /**
     * @var  array  $postTypes  An array of public custom post types, plus the standard "post" and "page" - add the custom types you want to include here
     */
    protected $postTypes = [];

    /**
     * @var  array  $customFields  Defines the custom fields available
     */
    protected $customFields = [];


    public function register() {
        add_action( 'admin_menu', [&$this, 'createCustomFields']);
        add_action( 'save_post', [&$this, 'saveCustomFields'], 1, 2 );
        if($this->removeDefaults)
            add_action( 'do_meta_boxes', [&$this, 'removeDefaultCustomFields'], 10, 3 );
    }
    /**
     * Remove the default Custom Fields meta box
     */
    function removeDefaultCustomFields( $type, $context, $post ) {
        foreach (['normal', 'advanced', 'side'] as $context )
            foreach ( $this->postTypes as $postType )
                remove_meta_box( 'postcustom', $postType, $context );
    }
    /**
     * Create the new Custom Fields meta box
     */
    function createCustomFields() {
        foreach ( $this->postTypes as $postType )
            add_meta_box( $this->id, $this->name, [&$this, 'displayCustomFields'], $postType, 'normal', 'high' );
    }
    /**
     * Display the new Custom Fields meta box
     */
    function displayCustomFields() {
        global $post;
        if(!isset($this->presenter))
            $this->presenter = new CustomFieldsPresenter(); // default to the built in presenter
        $this->presenter->present($this->prefix, $this->customFields, $post);
    }
    /**
     * Save the new Custom Fields values
     */
    function saveCustomFields( $post_id, $post ) {

        if ( !isset( $_POST[ 'my-custom-fields_wpnonce' ] ) || !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
            return;

        if ( !current_user_can( 'edit_post', $post_id ) )
            return;

        if ( ! in_array( $post->post_type, $this->postTypes ) )
            return;

        foreach ( $this->customFields as $customField ) {

            if ( !current_user_can( $customField['capability'], $post_id ) )
                continue;

            if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
                $value = $_POST[ $this->prefix . $customField['name'] ];
                // Auto-paragraphs for any WYSIWYG
                if ( $customField['type'] == "wysiwyg" ) $value = wpautop( $value );
                update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $value );
            }
            else
                delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
        }
    }
}